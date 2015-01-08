<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:14 AM
 */

namespace WeLiMe\Controllers;

use WeLiMe\Exceptions\DatabaseExceptions\DatabaseConnectionException;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Models\Entities\Conversation;
use WeLiMe\Models\HTMLFormData\CreateConversationContainer;
use WeLiMe\Repositories\ConversationRepository;
use WeLiMe\Repositories\UserRepository;

class ConversationController
{
    private $conversationRepository;
    private $userRepository;

    function __construct()
    {
        try {
            $this->conversationRepository = new ConversationRepository();
            $this->userRepository = new UserRepository();
        } catch (DatabaseConnectionException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param CreateConversationContainer $createConversationContainer
     * @return Conversation
     */
    public function createConversation(CreateConversationContainer $createConversationContainer)
    {
        $usernames = preg_replace('/\s+/', '', $createConversationContainer->getInitiatorUsername() . ", " . $createConversationContainer->getUsernames());

        $usernamesArray = explode(",", $usernames);

        $users = array();

        foreach ($usernamesArray as $username) {
            try {
                $user = $this->userRepository->findOneByUsername($username);
                array_push($users, $user);
            } catch (UserNotFoundException $e) {
                // Do nothing...
            }
        }

        $conversation = $this->conversationRepository->checkIfConversationExists($users);

        if (!$conversation) {

            $conversation = $this->conversationRepository->save(new Conversation());

            foreach ($users as $user) {
                try {
                    $this->conversationRepository->addUserToConversation($user, $conversation);
                } catch (UserNotFoundException $e) {
                    // Do nothing...
                }
            }
        }

        return $conversation;
    }

    /**
     * @param int $id
     * @return Conversation[]
     */
    public function getConversationsByUserId($id)
    {
        try {
            $conversations = $this->conversationRepository->findAllByUserId($id);
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }

        return $conversations;
    }
}

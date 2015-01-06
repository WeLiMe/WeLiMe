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
     */
    public function createConversation(CreateConversationContainer $createConversationContainer)
    {
        $usernames = preg_replace('/\s+/', '', $createConversationContainer->getInitiatorUsername() . ", " . $createConversationContainer->getUsernames());

        $usernamesArray = explode(",", $usernames);

        $conversation = $this->conversationRepository->save(new Conversation());

        $user = null;

        foreach ($usernamesArray as $username) {
            try {
                $user = $this->userRepository->findByUsername($username);
                $this->conversationRepository->addUserToConversation($user, $conversation);
            } catch (UserNotFoundException $e) {
                // Do nothing...
            }
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function getConversationsOfUserById($id)
    {
        try {
            $conversations = $this->conversationRepository->findConversationsOfUserById($id);
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }

        return $conversations;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/6/15
 * Time: 1:12 AM
 */

namespace WeLiMe\Controllers;

use WeLiMe\Exceptions\DatabaseExceptions\DatabaseConnectionException;
use WeLiMe\Exceptions\RepositoryExceptions\ConversationNotFoundException;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Models\Entities\Message;
use WeLiMe\Models\HTMLFormData\GetMessageContainer;
use WeLiMe\Models\HTMLFormData\SendMessageContainer;
use WeLiMe\Repositories\MessageRepository;
use WeLiMe\Repositories\UserRepository;

class MessageController
{
    private $messageRepository;
    private $userRepository;

    function __construct()
    {
        try {
            $this->messageRepository = new MessageRepository();
            $this->userRepository = new UserRepository();
        } catch (DatabaseConnectionException $e) {
            die($e->getMessage());
        }
    }

    public function createMessage(SendMessageContainer $messageContainer)
    {
        $message = new Message(
            0,
            $messageContainer->getUserId(),
            $messageContainer->getConversationId(),
            $messageContainer->getContent(),
            date('Y-m-d H:i:s')
        );

        $this->messageRepository->save($message);
    }

    /**
     * @param int $id
     * @param $messageId
     * @return GetMessageContainer[]
     */
    public function getMessagesOfConversation($id, $messageId)
    {
        try {
            $messages = $this->messageRepository->findAllInConversationByIdWithMessageIdGreaterThan($id, $messageId);
        } catch (ConversationNotFoundException $e) {
            die($e->getMessage());
        }

        $messagesContainers = array();

        foreach ($messages as $message) {
            try {
                $user = $this->userRepository->findOneById($message->getUserId());
            } catch (UserNotFoundException $e) {
                die($e->getMessage());
            }

            $messageContainer = new GetMessageContainer(
                $message->getId(),
                $user->getFirstName(),
                $user->getLastName(),
                $message->getContent(),
                $message->getSentTime()
            );

            array_push($messagesContainers, $messageContainer);
        }

        return $messagesContainers;
    }
}

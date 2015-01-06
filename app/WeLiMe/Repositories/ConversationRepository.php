<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:34 AM
 */

namespace WeLiMe\Repositories;

use PDO;
use WeLiMe\Exceptions\RepositoryExceptions\ConversationNotFoundException;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Models\Entities\Conversation;
use WeLiMe\Models\Entities\User;
use WeLiMe\PDOConnection;

class ConversationRepository
{
    private $db;

    function __construct()
    {
        $this->db = PDOConnection::getConnection();
    }

    /**
     * @param Conversation $conversation
     * @return Conversation
     */
    public function save(Conversation $conversation)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO conversation(`name`) " .
            "VALUES (:name)"
        );

        $stmt->bindParam(':name', $conversation->getName(), PDO::PARAM_STR);

        $stmt->execute();

        $conversation->setId($this->db->lastInsertId());

        return $conversation;
    }

    /**
     * @param User $user
     * @param Conversation $conversation
     * @return bool
     */
    public function addUserToConversation(User $user, Conversation $conversation)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO user_conversation(user_id, conversation_id) " .
            "VALUES (:userId, :conversationId)"
        );

        $stmt->bindParam(':userId', $user->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':conversationId', $conversation->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * @param int $id
     * @return Conversation
     * @throws ConversationNotFoundException
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM conversation WHERE `id` = :id LIMIT 1");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new ConversationNotFoundException("Conversation not found with id: " . $id . ".");

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $conversation = new Conversation(
            $row->id,
            $row->name
        );

        return $conversation;
    }

    /**
     * @param int $id
     * @return Conversation[]
     */
    public function findConversationsOfUserById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM user WHERE `id` = :id LIMIT 1"
        );

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount()) throw new UserNotFoundException("User not found with username: " . $id . ".");

        $stmt = $this->db->prepare(
            "SELECT * FROM conversation WHERE `id` IN (SELECT `conversation_id` FROM user_conversation WHERE `user_id` = :id)"
        );

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $conversations = array();

        $conversation = new Conversation();

        foreach ($results as $row) {
            $conversation->setId($row->id);
            $conversation->setName($row->name);

            array_push($conversations, $conversation);
        }

        return $conversations;
    }
}

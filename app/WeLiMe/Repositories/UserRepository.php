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
use WeLiMe\Models\Entities\User;
use WeLiMe\PDOConnection;

class UserRepository
{
    private $db;

    function __construct()
    {
        $this->db = PDOConnection::getConnection();
    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO user(`username`, `first_name`, `last_name`, `email`, `password`) " .
            "VALUES (:username, :firstName, :lastName, :email, :pass)"
        );

        $stmt->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(':pass', $user->getPassword(), PDO::PARAM_STR);

        $stmt->execute();

        $user->setId($this->db->lastInsertId());

        return $user;
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findOneById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE `id` = :id LIMIT 1");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new UserNotFoundException("User not found with id: " . $id . ".");

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $user = new User(
            $row->id,
            $row->username,
            $row->first_name,
            $row->last_name,
            $row->email,
            $row->password
        );

        return $user;
    }

    /**
     * @param string $username
     * @return User
     * @throws UserNotFoundException
     */
    public function findOneByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE `username` = :username LIMIT 1");

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new UserNotFoundException("User not found with username: " . $username . ".");

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $user = new User(
            $row->id,
            $row->username,
            $row->first_name,
            $row->last_name,
            $row->email,
            $row->password
        );

        return $user;
    }

    /**
     * @param int $id
     * @return User[]
     * @throws ConversationNotFoundException
     */
    public function findAllInConversationById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM conversation WHERE `id` = :id LIMIT 1"
        );

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new ConversationNotFoundException("Conversation not found with id: " . $id . ".");

        $stmt = $this->db->prepare(
            "SELECT * FROM user WHERE `id` IN (SELECT `user_id` FROM user_conversation WHERE `conversation_id` = :conversationId)"
        );

        $stmt->bindParam(':conversationId', $id, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $users = array();

        foreach ($results as $row) {
            $user = new User(
                $row->id,
                $row->username,
                $row->first_name,
                $row->last_name,
                $row->email,
                $row->password
            );

            array_push($users, $user);
        }

        return $users;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function updateTimestampByUsername($username)
    {
        $stmt = $this->db->prepare(
            "UPDATE user SET `last_updated_time` = NOW() WHERE `username` = :username"
        );

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new UserNotFoundException("User not found with username: " . $username . ".");

        return true;
    }

    /**
     * @param int $id
     * @return User[]
     */
    public function getActiveUsers($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM user WHERE `id` = :id LIMIT 1"
        );

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new ConversationNotFoundException("Conversation not found with id: " . $id . ".");

        $stmt = $this->db->prepare(
            "SELECT * FROM user WHERE TIMESTAMPDIFF(SECOND, `last_updated_time`, NOW()) <= 5 AND `id` != :id"
        );

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $users = array();

        foreach ($results as $row) {
            $user = new User(
                $row->id,
                $row->username,
                $row->first_name,
                $row->last_name,
                $row->email,
                $row->password
            );

            array_push($users, $user);
        }

        return $users;
    }
}

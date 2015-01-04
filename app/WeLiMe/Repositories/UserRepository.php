<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:34 AM
 */

namespace WeLiMe\Repositories;

use PDO;
use WeLiMe\PDOConnection;
use WeLiMe\Models\Entities\User;

class UserRepository {
    private $db;

    function __construct()
    {
        $this->db = PDOConnection::getConnection();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO User(`username`, `first_name`, `last_name`, `email`, `password`) " .
            "VALUES (:username, :firstName, :lastName, :email, :pass)"
        );

        $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':pass', $user->getPassword(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * @param $id
     * @return User
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM User WHERE `id` = :id LIMIT 1");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch();

        $user = new User();

        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setFirstName($row['first_name']);
        $user->setLastName($row['last_name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);

        return $user;
    }
}

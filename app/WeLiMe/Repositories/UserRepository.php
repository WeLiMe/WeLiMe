<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:34 AM
 */

namespace WeLiMe\Repositories;

use PDO;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
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
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM User WHERE `id` = :id LIMIT 1");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new UserNotFoundException();

        $row = $stmt->fetch();

        $user = new User(
            $row['id'],
            $row['username'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['password']
        );

        return $user;
    }

    /**
     * @param string $username
     * @return User
     * @throws UserNotFoundException
     */
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM User WHERE `username` = :username LIMIT 1");

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new UserNotFoundException;

        $row = $stmt->fetch();

        $user = new User(
            $row['id'],
            $row['username'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['password']
        );

        return $user;
    }
}

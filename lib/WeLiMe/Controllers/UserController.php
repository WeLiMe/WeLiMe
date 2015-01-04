<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:14 AM
 */

namespace WeLiMe\Controllers;

use WeLiMe\Models\Entities\User;
use WeLiMe\Repositories\UserRepository;

class UserController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createUser(User $user)
    {
        $this->userRepository->save($user);
    }

    public function deleteUser(User $user)
    {
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:14 AM
 */

namespace WeLiMe\Controllers;

use WeLiMe\Models\Entities\User;
use WeLiMe\Models\HTMLFormData\RegistrationForm;
use WeLiMe\Repositories\UserRepository;

class UserController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createUser(RegistrationForm $registrationForm)
    {
        $user = new User();

        $user->setUsername($registrationForm->getUsername());
        $user->setFirstName($registrationForm->getFirstName());
        $user->setLastName($registrationForm->getLastName());

        $emailOrigin = $registrationForm->getEmail();
        $emailConfirm = $registrationForm->getEmailConfirm();

        if ($emailOrigin == $emailConfirm) {
            $user->setEmail($emailOrigin);
        }

        $passwordOrigin = $registrationForm->getPassword();
        $passwordConfirm = $registrationForm->getPasswordConfirm();

        if ($passwordOrigin == $passwordConfirm) {
            $user->setPassword($passwordOrigin);
        }

        $this->userRepository->save($user);
    }
}

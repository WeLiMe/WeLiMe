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
use WeLiMe\Validators\RegistrationFormValidator;

class UserController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createUser(RegistrationForm $registrationForm)
    {
        $registrationFormValidator = new RegistrationFormValidator();

        $formDataIsValid = $registrationFormValidator->validate($registrationForm);

        if ($formDataIsValid == true) {
            $user = new User();

            $user->setUsername($registrationForm->getUsername());
            $user->setFirstName($registrationForm->getFirstName());
            $user->setLastName($registrationForm->getLastName());
            $user->setEmail($registrationForm->getEmail());
            $user->setPassword($registrationForm->getPassword());

            $this->userRepository->save($user);

            return true;
        } else {
            return false;
        }
    }
}

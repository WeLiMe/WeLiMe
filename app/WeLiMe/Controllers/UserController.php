<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:14 AM
 */

namespace WeLiMe\Controllers;

use WeLiMe\Exceptions\SecurityExceptions\AuthenticationException;
use WeLiMe\Exceptions\DatabaseExceptions\DatabaseConnectionException;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Exceptions\ValidationExceptions\ValidationException;
use WeLiMe\Models\Entities\User;
use WeLiMe\Models\HTMLFormData\LoginForm;
use WeLiMe\Models\HTMLFormData\RegistrationForm;
use WeLiMe\Repositories\UserRepository;
use WeLiMe\Validators\RegistrationFormValidator;

class UserController
{
    private $userRepository;

    function __construct()
    {
        try {
            $this->userRepository = new UserRepository();
        } catch (DatabaseConnectionException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param RegistrationForm $registrationForm
     */
    public function createUser(RegistrationForm $registrationForm)
    {
        $registrationFormValidator = new RegistrationFormValidator();

        try {
            $registrationFormValidator->validate($registrationForm);

            $user = new User();

            $user->setUsername($registrationForm->getUsername());
            $user->setFirstName($registrationForm->getFirstName());
            $user->setLastName($registrationForm->getLastName());
            $user->setEmail($registrationForm->getEmail());
            $user->setPassword($registrationForm->getPassword());

            $this->userRepository->save($user);
        } catch (ValidationException $e) {
            die($e->getMessage() . '\n' . $e->getTraceAsString());
        }
    }

    /**
     * @param LoginForm $loginForm
     * @return bool
     * @throws AuthenticationException
     */
    public function checkLogin(LoginForm $loginForm)
    {
        try {
            $user = $this->userRepository->findByUsername($loginForm->getUsername());

            if ($user->getPassword() != $loginForm->getPassword()) {
                throw new AuthenticationException();
            }

            return true;
        } catch (UserNotFoundException $e) {
            echo($e->getMessage() . '\n' . $e->getTraceAsString());
            return false;
        }
    }
}

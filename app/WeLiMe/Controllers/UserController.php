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
use WeLiMe\Exceptions\SecurityExceptions\AuthenticationException;
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

            $user = new User(
                0,
                $registrationForm->getUsername(),
                $registrationForm->getFirstName(),
                $registrationForm->getLastName(),
                $registrationForm->getEmail(),
                password_hash($registrationForm->getPassword(), PASSWORD_BCRYPT)
            );

            $this->userRepository->save($user);
        } catch (ValidationException $e) {
            die($e->getMessage());
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

            if (!password_verify($loginForm->getPassword(), $user->getPassword())) {
                throw new AuthenticationException("Authentication failed.");
            }
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }
    }
}

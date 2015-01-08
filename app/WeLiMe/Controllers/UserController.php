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
use WeLiMe\Models\Entities\Conversation;
use WeLiMe\Models\Entities\User;
use WeLiMe\Models\HTMLFormData\GetUserContainer;
use WeLiMe\Models\HTMLFormData\LoginFormContainer;
use WeLiMe\Models\HTMLFormData\RegistrationFormContainer;
use WeLiMe\Repositories\ConversationRepository;
use WeLiMe\Repositories\UserRepository;
use WeLiMe\Validators\RegistrationFormValidator;

class UserController
{
    private $userRepository;
    private $conversationRepository;

    function __construct()
    {
        try {
            $this->userRepository = new UserRepository();
            $this->conversationRepository = new ConversationRepository();
        } catch (DatabaseConnectionException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param RegistrationFormContainer $registrationForm
     */
    public function createUser(RegistrationFormContainer $registrationForm)
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

            $user = $this->userRepository->save($user);

            $this->conversationRepository->addUserToConversation($user, new Conversation(1));
        } catch (ValidationException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param LoginFormContainer $loginForm
     * @return User
     * @throws AuthenticationException
     */
    public function checkLogin(LoginFormContainer $loginForm)
    {
        try {
            $user = $this->userRepository->findOneByUsername($loginForm->getUsername());

            if (!password_verify($loginForm->getPassword(), $user->getPassword())) {
                throw new AuthenticationException("Authentication failed.");
            }
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }

        return $user;
    }

    /**
     * @param $username
     * @return bool
     */
    public function updateTimestamp($username) {
        try {
            $updated = $this->userRepository->updateTimestampByUsername($username);
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }

        return $updated;
    }

    /**
     * @param int $userId
     * @return \WeLiMe\Models\HTMLFormData\GetUserContainer[]
     */
    public function getActiveUsers($userId) {
        try {
            $users = $this->userRepository->getActiveUsers($userId);
        } catch (UserNotFoundException $e) {
            die($e->getMessage());
        }

        $usersContainers = array();

        foreach ($users as $user) {

            $userContainer = new GetUserContainer(
                $user->getUsername(),
                $user->getFirstName(),
                $user->getLastName()
            );

            array_push($usersContainers, $userContainer);
        }

        return $usersContainers;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/2/15
 * Time: 1:15 AM
 */

namespace WeLiMe\Validators;

use WeLiMe\Exceptions\ValidationExceptions\ValidationException;
use WeLiMe\Models\HTMLFormData\RegistrationFormContainer;

class RegistrationFormValidator
{
    /**
     * @param RegistrationFormContainer $registrationForm
     * @return bool
     * @throws ValidationException
     */
    public function validate(RegistrationFormContainer $registrationForm)
    {
        if ($this->validateUsername($registrationForm->getUsername()) == false) {
            throw new ValidationException("Username validation failed.");
        }

        if ($this->validateName($registrationForm->getFirstName()) == false) {
            throw new ValidationException("First Name validation failed.");
        }

        if ($this->validateName($registrationForm->getLastName()) == false) {
            throw new ValidationException("Last Name validation failed.");
        }

        if ($this->validateEmails($registrationForm->getEmail(), $registrationForm->getEmailConfirm()) == false) {
            throw new ValidationException("Email validation failed.");
        }

        if ($this->validatePasswords($registrationForm->getPassword(), $registrationForm->getPasswordConfirm()) == false) {
            throw new ValidationException("Password validation failed.");
        }

        return true;
    }

    /**
     * @param string $data
     * @return bool
     */
    private function validateUsername($data)
    {
        $isValid = false;

        $pattern = '/^[a-zA-Z0-9_]+$/';

        if (preg_match($pattern, $data) == 1) {
            $isValid = true;
        }

        return $isValid;
    }

    /**
     * @param string $data
     * @return bool
     */
    private function validateName($data)
    {
        $isValid = false;

        $pattern = '/^[a-zA-Z]+$/';

        if (preg_match($pattern, $data) == 1) {
            $isValid = true;
        }

        return $isValid;
    }

    /**
     * @param string $data
     * @return bool
     */
    private function validateEmail($data)
    {
        $isValid = false;

        $pattern = '/^[^@]+@[^@]+$/';

        if (preg_match($pattern, $data) == 1) {
            $isValid = true;
        }

        return $isValid;
    }

    /**
     * @param $emailOne
     * @param $emailTwo
     * @return bool
     */
    private function validateEmails($emailOne, $emailTwo)
    {
        $emailIsValid = $this->validateEmail($emailOne);
        $emailIsTheSame = false;

        if ($emailOne == $emailTwo) {
            $emailIsTheSame = true;
        }

        return $emailIsValid and $emailIsTheSame;
    }

    /**
     * @param string $data
     * @return bool
     */
    private function validatePassword($data)
    {
        $isValid = false;

        if (preg_match('/.+/', $data) == 1) {
            $isValid = true;
        }

        return $isValid;
    }

    /**
     * @param $passwordOne
     * @param $passwordTwo
     * @return bool
     */
    private function validatePasswords($passwordOne, $passwordTwo)
    {
        $passwordIsValid = $this->validatePassword($passwordOne);
        $passwordIsTheSame = false;

        if ($passwordOne == $passwordTwo) {
            $passwordIsTheSame = true;
        }

        return $passwordIsValid and $passwordIsTheSame;
    }
}

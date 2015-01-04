<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/2/15
 * Time: 1:15 AM
 */

namespace WeLiMe\Validators;

use WeLiMe\Models\HTMLFormData\RegistrationForm;

class RegistrationFormValidator
{
    /**
     * @param RegistrationForm $registrationForm
     * @return bool
     */
    public function validate(RegistrationForm $registrationForm) {
        $usernameIsValid = $this->validateUsername($registrationForm->getUsername());
        $firstNameIsValid = $this->validateName($registrationForm->getFirstName());
        $lastNameIsValid = $this->validateName($registrationForm->getLastName());
        $emailIsValid = $this->validateEmails($registrationForm->getEmail(), $registrationForm->getEmailConfirm());
        $passwordIsValid = $this->validatePasswords($registrationForm->getPassword(), $registrationForm->getPasswordConfirm());

        return $usernameIsValid and $firstNameIsValid and $lastNameIsValid and $emailIsValid and $passwordIsValid;
    }

    /**
     * @param string $data
     * @return bool
     */
    private function validateUsername($data) {
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
    private function validateName($data) {
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
        $hasCharacter = false;
        $hasNumber = false;
        $hasSymbol = false;

        if (preg_match('/[a-zA-Z]/', $data) == 1) {
            $hasCharacter = true;
        }

        if (preg_match('/[0-1]/', $data) == 1) {
            $hasNumber = true;
        }

        if (preg_match('/[~!@#\$%\^&\*\(\)]/', $data) == 1) {
            $hasNumber = true;
        }

        return $hasCharacter and $hasNumber and $hasSymbol;
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

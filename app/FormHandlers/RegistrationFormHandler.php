<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:18 AM
 */

require_once __DIR__ . '/../../bootstrap.php';

use WeLiMe\Controllers\UserController;
use WeLiMe\Models\HTMLFormData\RegistrationForm;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registrationForm = new RegistrationForm(
        $_POST['txtUsername'],
        $_POST['txtFirstName'],
        $_POST['txtLastName'],
        $_POST['txtEmail'],
        $_POST['txtEmailConfirm'],
        $_POST['txtPassword'],
        $_POST['txtPasswordConfirm']
    );

    $userController = new UserController();

    $userController->createUser($registrationForm);

    $_SESSION['login_user'] = $registrationForm->getUsername();
}

header("Location: ../../public/index.php");

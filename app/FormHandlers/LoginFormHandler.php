<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 8:22 PM
 */

use WeLiMe\Controllers\UserController;
use WeLiMe\Exceptions\SecurityExceptions\AuthenticationException;
use WeLiMe\Models\HTMLFormData\LoginForm;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginForm = new LoginForm(
        $_POST['txtUsername'],
        $_POST['txtPassword']
    );

    $userController = new UserController();

    try {
        $userController->checkLogin($loginForm);
        $_SESSION['login_user'] = $loginForm->getUsername();
    } catch (AuthenticationException $e) {
        die($e->getMessage());
    }
}

header("Location: ../../public/index.php");
<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 8:22 PM
 */

use WeLiMe\Controllers\UserController;
use WeLiMe\Exceptions\SecurityExceptions\AuthenticationException;
use WeLiMe\Models\HTMLFormData\LoginFormContainer;

require_once __DIR__ . '/../../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginForm = new LoginFormContainer(
        $_POST['txtUsername'],
        $_POST['txtPassword']
    );

    $userController = new UserController();

    try {
        $user = $userController->checkLogin($loginForm);
        $_SESSION['UserUsername'] = $user->getUsername();
        $_SESSION['UserId'] = $user->getId();
    } catch (AuthenticationException $e) {
        die($e->getMessage());
    }
}

header("Location: ../../index.php");

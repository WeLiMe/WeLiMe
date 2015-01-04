<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 12:18 AM
 */

require_once __DIR__ . '/../../bootstrap.php';

use WeLiMe\Models\Entities\User;
use WeLiMe\Controllers\UserController;

$user = new User();

$user->setUsername($_POST['txtUsername']);
$user->setFirstName($_POST['txtFirstName']);
$user->setLastName($_POST['txtLastName']);
$user->setEmail($_POST['txtEmail']);
$user->setPassword($_POST['txtPassword']);

$userController = new UserController();

$userController->createUser($user);

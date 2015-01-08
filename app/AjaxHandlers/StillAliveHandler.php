<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/8/15
 * Time: 1:29 AM
 */

use WeLiMe\Controllers\UserController;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['UserUsername'])) {
        $userController = new UserController();

        $userController->updateTimestamp($_SESSION['UserUsername']);
    }
}

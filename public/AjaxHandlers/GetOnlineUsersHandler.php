<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/8/15
 * Time: 12:18 AM
 */

use WeLiMe\Controllers\UserController;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["UserId"])) {
        $userController = new UserController();

        $users = $userController->getActiveUsers($_SESSION["UserId"]);

        foreach ($users as $user) {
            echo("<a href=\"javascript:void(0);\" onclick=\"startConversation('" . $user->getUsername() . "');\">\n");
            echo("\t<div class=\"Friend\">\n");
            echo("\t\t<div class=\"FriendName\">" . $user->getFirstName() . " " . $user->getLastName() . "</div>\n");
            echo("\t\t<div class=\"FriendUsername\" hidden=\"hidden\">" . $user->getUsername() . "</div>\n");
            echo("\t</div>\n");
            echo("</a>\n");
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 10:11 PM
 */

use WeLiMe\Controllers\ConversationController;
use WeLiMe\Models\HTMLFormData\CreateConversationContainer;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['txtUsernames'])) {
        $createConversationContainer = new CreateConversationContainer(
            $_SESSION['login_user'],
            $_POST['txtUsernames']
        );

        $conversationController = new ConversationController();

        $conversationController->createConversation($createConversationContainer);
    }
}

header("Location: ../../public/chat.php");
<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 8:34 PM
 */

use WeLiMe\Controllers\MessageController;
use WeLiMe\Models\HTMLFormData\SendMessageContainer;

require_once __DIR__ . '/../../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['UserUsername'])) {
        $sendMessageContainer = new SendMessageContainer(
            $_SESSION['UserId'],
            $_POST['ConversationId'],
            $_POST['ChatInput']
        );

        $messageController = new MessageController();

        $messageController->createMessage($sendMessageContainer);
    }
}

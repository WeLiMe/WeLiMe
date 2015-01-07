<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 8:34 PM
 */

use WeLiMe\Controllers\MessageController;
use WeLiMe\Models\HTMLFormData\SendMessageContainer;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ConversationId'])) {
        $messageController = new MessageController();

        $messages = $messageController->getMessagesOfConversation($_POST['ConversationId'], $_POST['LastMessageId']);

        foreach ($messages as $message) {
            echo("<div class=\"ChatMessage\">");
            echo("\t<div class=\"ChatMessageName\">" . $message->getFirstName() . " " . $message->getLastName() . ":</div>\n");
            echo("\t<div class=\"ChatMessageSentTime\">" . $message->getSentTime() . "</div>\n");
            echo("\t<div class=\"ChatMessageContent\">" . $message->getContent() . "</div>\n");
            echo("\t<input type=\"hidden\" class=\"ChatMessageId\" value=\"" . $message->getId() . "\"/>\n");
            echo("</div>");
        }
    }
}

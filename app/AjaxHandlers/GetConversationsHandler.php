<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/8/15
 * Time: 12:19 AM
 */

use WeLiMe\Controllers\ConversationController;
use WeLiMe\Repositories\UserRepository;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["UserId"])) {
        $conversationController = new ConversationController();
        $userRepository = new UserRepository();

        $conversations = $conversationController->getConversationsByUserId($_SESSION["UserId"]);

        foreach ($conversations as $conversation) {
            echo("<div class=\"Conversation\">");

            if (!$conversation->getName()) {
                $users = $userRepository->findAllInConversationById($conversation->getId());

                $conversationName = "";

                foreach ($users as $user) {
                    $conversationName .= $user->getFirstName() . " " . $user->getLastName() . ", ";
                }

                $conversationName = trim($conversationName, ", ");
            } else {
                $conversationName = $conversation->getName();
            }

            echo("\t<div class=\"ConversationName\">" . $conversationName . "</div>\n");
            echo("\t<div class=\"ConversationId\" hidden>" . $conversation->getId() . "</div>\n");
            echo("</div>\n");
        }
    }
}

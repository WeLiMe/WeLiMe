<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/8/15
 * Time: 12:19 AM
 */

use WeLiMe\Controllers\ConversationController;
use WeLiMe\Models\HTMLFormData\CreateConversationContainer;
use WeLiMe\Repositories\UserRepository;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['UserUsername']) && isset($_POST['Usernames'])) {
        $createConversationContainer = new CreateConversationContainer(
            $_SESSION['UserUsername'],
            $_POST['Usernames']
        );

        $conversationController = new ConversationController();

        $conversation = $conversationController->createConversation($createConversationContainer);

        echo($conversation->getId());
    }
}

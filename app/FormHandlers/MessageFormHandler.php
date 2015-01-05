<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 8:34 PM
 */

use WeLiMe\Models\HTMLFormData\MessageForm;

require_once __DIR__ . '/../../bootstrap.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messageForm = new MessageForm(
        $_POST['txtInput']
    );
}

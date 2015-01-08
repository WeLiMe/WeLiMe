<?php require_once __DIR__ . '/../bootstrap.php'; session_start();

if (!isset($_SESSION['UserUsername'])) {
    header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Chat</title>

    <?php require_once __DIR__ . "/parts/head.php"; ?>

    <link rel="Stylesheet" href="css/chat.css"/>

    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>

    <script type="text/javascript" src="js/chat.js"></script>
</head>

<body>
<?php require_once __DIR__ . "/parts/header.php"; ?>

<?php require_once __DIR__ . "/parts/nav.php"; ?>

<main>
    <section id="App">
        <aside id="FriendList"></aside>

        <!--<aside id="ConversationList"></aside>-->

        <main id="Chat">
            <div id="ChatMessages"></div>
            <input type="text" id="ChatInput" name="ChatInput" title="ChatInput" readonly/>
            <div class="ChatConversationId" hidden></div>
        </main>

        <div class="clearDiv"></div>
    </section>
</main>

<?php require_once __DIR__ . "/parts/footer.php"; ?>
</body>

</html>

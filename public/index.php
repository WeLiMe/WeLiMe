<?php require_once __DIR__ . '/../bootstrap.php'; session_start(); ?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Home</title>

    <?php require_once __DIR__ . "/parts/head.php"; ?>

    <link rel="Stylesheet" href="css/index.css"/>

    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>

    <script type="text/javascript" src="js/chat.js"></script>
</head>

<body>
<?php require_once __DIR__ . "/parts/header.php"; ?>

<?php require_once __DIR__ . "/parts/nav.php"; ?>

<main>
    <h2>Welcome to your WebLiveMessenger!</h2>

    <?php if (isset($_SESSION['UserUsername'])) { ?>
    <div id="Chat">
        <div id="ChatMessages"></div>
        <input type="text" id="ChatInput" name="ChatInput" title="ChatInput"/>
        <div id="ChatConversationId" hidden>1</div>
    </div>
    <?php } ?>
</main>

<?php require_once __DIR__ . "/parts/footer.php"; ?>
</body>

</html>

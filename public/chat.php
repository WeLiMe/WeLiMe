<?php require_once __DIR__ . '/../bootstrap.php'; session_start(); ?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Chat</title>

    <?php require_once __DIR__ . "/parts/head.php"; ?>

    <link rel="Stylesheet" href="css/chat.css"/>
</head>

<body>
<?php require_once __DIR__ . "/parts/header.php"; ?>

<?php require_once __DIR__ . "/parts/nav.php"; ?>

<main>
    <aside id="friendList">
        <ul>
            <li><a href="#">All</a></li>
        </ul>
    </aside>

    <div class="chat">
        <label for="txtHistory"></label>
        <textarea class="history" id="txtHistory"></textarea>

        <br/>

        <label for="txtInput"></label>
        <input type="text" class="input" id="txtInput"/>

        <input type="submit" class="btnSend" value="Send"/>
    </div>

    <div class="clearDiv"></div>
</main>

<?php require_once __DIR__ . "/parts/footer.php"; ?>
</body>

</html>

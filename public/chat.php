<?php require_once __DIR__ . '/../bootstrap.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Chat</title>

    <?php require_once __DIR__ . "/templates/head.php"; ?>

    <link rel="Stylesheet" href="css/chat.css"/>
</head>

<body>
<?php require_once __DIR__ . "/templates/header.php"; ?>

<?php require_once __DIR__ . "/templates/nav.php"; ?>

<main id="mainSection">
    <aside id="friendList">
        <ul>
            <li><a href="#">All</a></li>
        </ul>
    </aside>

    <div id="chat">
        <label for="txtHistory"></label>
        <textarea class="history" id="txtHistory"></textarea>

        <br/>

        <label for="txtInput"></label>
        <input type="text" class="input" id="txtInput"/>

        <button class="btnSend">Send</button>
    </div>

    <div class="clearDiv"></div>
</main>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
</body>

</html>

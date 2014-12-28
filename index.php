<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>WeLiMe</title>

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<header>
    <h1>WiLiMe</h1>
</header>

<nav>
    <a href="./index.php">Home</a>&emsp;|&emsp;
    <a href="#">About</a>
</nav>

<main id="mainSection">
    <aside>
        <ul>
            <li><a href="#">All</a></li>
        </ul>
    </aside>

    <div id="chat">
        <label for="txtHistory"></label>
        <textarea rows="5" cols="30" id="txtHistory"></textarea>

        <br/>

        <label for="txtInput"></label>
        <input type="text" id="txtInput"/>

        <button class="btnSend">Send</button>
    </div>

    <div class="clearDiv"></div>
</main>

<footer>
    Copyright &copy; 2014, All Rights Reserved
</footer>
</body>

</html>

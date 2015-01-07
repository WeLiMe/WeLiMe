<nav>
    <div id="navigation">
        <a href="index.php">Home</a>
<?php if (isset($_SESSION['UserUsername'])) {
    echo("\t&emsp;|&emsp;<a href=\"chat.php\">Chat</a>\n");
} ?>
    </div>
    <div id="actions">
<?php if (isset($_SESSION['UserUsername'])) {
    echo("\tHi, <a href=\"\">" . $_SESSION['UserUsername'] . "</a>!&emsp;|&emsp;\n");
    echo("\t<a href=\"logout.php\">Logout</a>\n");
 } else {
    echo("\t<a href=\"login.php\">Login</a>&emsp;|&emsp;\n");
    echo("\t<a href=\"registration.php\">Registration</a>\n");
} ?>
    </div>
    <div class="clearDiv"></div>
</nav>

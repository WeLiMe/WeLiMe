<nav>
    <div id="navigation">
        <a href="index.php">Home</a>&emsp;|&emsp;
        <a href="chat.php">Chat</a>
    </div>
    <div id="actions">
<?php
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Repositories\UserRepository;

if (isset($_SESSION['UserUsername'])) {
    $username = $_SESSION['UserUsername'];

    $userRepository = new UserRepository();

    try {
        $userRepository->findByUsername($username);

        echo("\tHi, <a href=\"\">" . $_SESSION['UserUsername'] . "</a>!&emsp;|&emsp;\n");
        echo("\t<a href=\"logout.php\">Logout</a>\n");
    } catch (UserNotFoundException $e) {
        header("Location: logout.php");
    }
} else {
    echo("\t<a href=\"login.php\">Login</a>&emsp;|&emsp;\n");
    echo("\t<a href=\"registration.php\">Registration</a>\n");
}
?>
    </div>
    <div class="clearDiv"></div>
</nav>

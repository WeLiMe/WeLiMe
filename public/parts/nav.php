<nav>
    <div id="navigation">
        <a href="index.php">Home</a>
<?php
use WeLiMe\Controllers\UserController;
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Repositories\UserRepository;

if (isset($_SESSION['UserUsername'])) {
    echo("\t&emsp;|&emsp;<a href=\"chat.php\">Private Chat</a>\n");
} ?>
    </div>
    <div id="actions">
<?php if (isset($_SESSION['UserUsername'])) {
    $userRepository = new UserRepository();

    try {
        $user = $userRepository->findOneByUsername($_SESSION['UserUsername']);
    } catch (UserNotFoundException $e) {
        die($e->getMessage());
    }

    echo("\tLogged in as <a href=\"\">" . $user->getFirstName() . " " . $user->getLastName() . "</a>&emsp;|&emsp;\n");
    echo("\t<a href=\"logout.php\">Logout</a>\n");
 } else {
    echo("\t<a href=\"login.php\">Login</a>&emsp;|&emsp;\n");
    echo("\t<a href=\"registration.php\">Registration</a>\n");
} ?>
    </div>
    <div class="clearDiv"></div>
</nav>

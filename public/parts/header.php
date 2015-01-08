<?php
use WeLiMe\Exceptions\RepositoryExceptions\UserNotFoundException;
use WeLiMe\Repositories\UserRepository;

if (isset($_SESSION['UserUsername'])) {
    $username = $_SESSION['UserUsername'];

    $userRepository = new UserRepository();

    try {
        $userRepository->findOneByUsername($username);

        $loggedIn = true;
    } catch (UserNotFoundException $e) {
        header("Location: logout.php");
    }
}
?>
<header>
    <div id="logo">We<span style="color: #36F;">.</span>Li<span style="color: #36F;">.</span>Me</div>
</header>

<?php require_once __DIR__ . '/../bootstrap.php'; session_start();

if (!isset($_SESSION['UserUsername'])) {
    header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Login</title>

    <?php require_once __DIR__ . "/parts/head.php"; ?>

    <link rel="Stylesheet" href="css/login.css"/>
</head>

<body>
<?php require_once __DIR__ . "/parts/header.php"; ?>

<?php require_once __DIR__ . "/parts/nav.php"; ?>

<main>
    <h3>Login...</h3>

    <form name="loginForm" id="loginForm" action="FormHandlers/LoginFormHandler.php" method="post">
        <table>
            <tr>
                <td><label for="txtUsername">Username:</label></td>
                <td><input type="text" name="txtUsername" id="txtUsername"/></td>
            </tr>
            <tr>
                <td><label for="txtPassword">Password:</label></td>
                <td><input type="password" name="txtPassword" id="txtPassword"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"/></td>
            </tr>
        </table>
    </form>
</main>

<?php require_once __DIR__ . "/parts/footer.php"; ?>
</body>

</html>

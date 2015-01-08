<?php require_once __DIR__ . '/../bootstrap.php'; session_start();

if (isset($_SESSION['UserUsername'])) {
    header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>WeLiMe : Registration</title>

    <?php require_once __DIR__ . "/parts/head.php"; ?>

    <link rel="Stylesheet" href="css/registration.css"/>
</head>

<body>
<?php require_once __DIR__ . "/parts/header.php"; ?>

<?php require_once __DIR__ . "/parts/nav.php"; ?>

<main>
    <h3>Registration...</h3>

    <form name="registrationForm" id="registrationForm" action="handlers/formHandlers/RegistrationFormHandler.php" method="post">
        <table>
            <tr>
                <td><label for="txtUsername">Username:</label></td>
                <td><input type="text" name="txtUsername" id="txtUsername"/></td>
            </tr>
            <tr>
                <td><label for="txtFirstName">First Name:</label></td>
                <td><input type="text" name="txtFirstName" id="txtFirstName"/></td>
            </tr>
            <tr>
                <td><label for="txtLastName">Last Name:</label></td>
                <td><input type="text" name="txtLastName" id="txtLastName"/></td>
            </tr>
            <tr>
                <td><label for="txtEmail">Email:</label></td>
                <td><input type="text" name="txtEmail" id="txtEmail"/></td>
            </tr>
            <tr>
                <td><label for="txtEmailConfirm">Email Confirm:</label></td>
                <td><input type="text" name="txtEmailConfirm" id="txtEmailConfirm"/></td>
            </tr>
            <tr>
                <td><label for="txtPassword">Password:</label></td>
                <td><input type="password" name="txtPassword" id="txtPassword"/></td>
            </tr>
            <tr>
                <td><label for="txtPasswordConfirm">Password Confirm:</label></td>
                <td><input type="password" name="txtPasswordConfirm" id="txtPasswordConfirm"/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="btnSubmit" id="btnSubmit" value="Register"/>
                    <input type="reset" name="btnReset" id="btnReset" value="Clear Form"/>
                </td>
            </tr>
        </table>
    </form>
</main>

<?php require_once __DIR__ . "/parts/footer.php"; ?>
</body>

</html>

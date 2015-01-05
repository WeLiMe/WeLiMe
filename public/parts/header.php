<header>
    <div id="logo">We<span style="color: #36F;">.</span>Li<span style="color: #36F;">.</span>Me</div>
    <?php if (isset($_SESSION['login_user'])) { ?>
    <div id="createConversationForm">
        <form name="conversationForm" id="conversationForm" action="../app/FormHandlers/ConversationFormHandler.php" method="post">
            <table>
                <tr>
                    <td><label for="txtUsernames">Users to invite:</label></td>
                    <td><input type="text" name="txtUsernames" id="txtUsernames" title="Separator(,)"/></td>
                    <td><input type="submit" value="Invite"/></td>
                </tr>
            </table>
        </form>
    </div>
    <?php } ?>
</header>

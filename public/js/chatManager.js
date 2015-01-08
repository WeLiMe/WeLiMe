/**
 * Created by a4i on 1/8/15.
 */
function updateFriendList() {
    var friendListElement = $("#FriendList");

    $.ajax({
        type: 'POST',
        async: true,
        url: '../app/AjaxHandlers/GetOnlineUsersHandler.php',
        success: function (respose) {
            if (respose.trim()) {
                friendListElement.html(respose);
            }
        }
    });
}

function startConversation(username) {
    var chatMessagesElement = $("#ChatMessages");
    var chatConversationIdElement = $("#Chat").find(".ChatConversationId");
    var chatInputElement = $("#ChatInput");

    $.ajax({
        type: 'POST',
        async: true,
        url: '../app/AjaxHandlers/GetConversationHandler.php',
        data: {Usernames: username},
        success: function (respose) {
            if (respose.trim()) {
                chatMessagesElement.html("");
                chatConversationIdElement.html(respose);
                chatInputElement.prop("readonly", false);
                updateHistory();
            }
        }
    });
}

$(document).ready(function () {
    updateFriendList();

    setInterval(function () {
            updateFriendList();
    }, 1000);
});

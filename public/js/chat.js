/**
 * Created by a4i on 1/6/15.
 */
function updateHistory() {
    var chatMessagesElem = $("#ChatMessages");

    var conversationId = $("#Chat").find(".ChatConversationId").html();
    var lastMessageId = chatMessagesElem.find(".ChatMessage:last-child .ChatMessageId").html();

    if (!lastMessageId) {
        lastMessageId = 0;
    }

    $.ajax({
        type: 'POST',
        async: true,
        url: 'AjaxHandlers/GetMessagesHandler.php',
        data: {
            ConversationId: conversationId,
            LastMessageId: lastMessageId
        },
        success: function (respose) {
            var newLastMessageId = chatMessagesElem.find(".ChatMessage:last-child .ChatMessageId").html();

            if (!newLastMessageId) {
                newLastMessageId = 0;
            }

            if (respose.trim() && (newLastMessageId == lastMessageId)) {
                chatMessagesElem.html(chatMessagesElem.html() + respose);
                chatMessagesElem.scrollTop(chatMessagesElem.prop("scrollHeight"));
            }
        }
    });
}

function updateFriendList() {
    var friendListElement = $("#FriendList");

    $.ajax({
        type: 'POST',
        async: true,
        url: 'AjaxHandlers/GetOnlineUsersHandler.php',
        success: function (respose) {
            if (respose.trim()) {
                if (friendListElement.html().trim() != respose.trim()) {
                    friendListElement.html(respose);
                }
            } else {
                friendListElement.html("<div class=\"Friend\">Forever alone...</div>");
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
        url: 'AjaxHandlers/GetConversationHandler.php',
        data: {Usernames: username},
        success: function (respose) {
            if (respose.trim()) {
                chatMessagesElement.html("");
                chatConversationIdElement.html(respose);
                chatInputElement.prop("readonly", false);
                $("#ChatConversationName").html($('.FriendUsername:contains("' + username + '")').parent().find(".FriendName").html());
                updateHistory();
            }
        }
    });
}

function updateTimestamp() {
    $.ajax({
        type: 'POST',
        async: true,
        url: 'AjaxHandlers/StillAliveHandler.php'
    });
}

$(document).ready(function () {
    var chatInputElement = $("#ChatInput");
    var chatConversationIdElement = $("#Chat").find(".ChatConversationId");

    chatInputElement.keyup(function (e) {
        if (e.keyCode == 13 && chatConversationIdElement.html().trim() && chatInputElement.val().trim()) {
            var chatInput = chatInputElement.val();
            var conversationId = chatConversationIdElement.html().trim();

            $.ajax({
                type: 'POST',
                async: true,
                url: 'AjaxHandlers/SendMessageHandler.php',
                data: {
                    ConversationId: conversationId,
                    ChatInput: chatInput
                },
                success: function () {
                    chatInputElement.val("");
                    updateHistory()
                }
            });
        }
    });

    if ($("#FriendList").length) {
        updateFriendList();
    }

    if (chatConversationIdElement.html().trim()) {
        updateHistory();
    }

    setInterval(function () {
        if ($("#FriendList").length) {
            updateFriendList();
        }

        if (chatConversationIdElement.html().trim()) {
            updateHistory();
        }

        updateTimestamp();
    }, 1000);
});

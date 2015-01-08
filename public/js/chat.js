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
        url: '../app/AjaxHandlers/GetMessagesHandler.php',
        data: {
            ConversationId: conversationId,
            LastMessageId: lastMessageId
        },
        success: function (respose) {
            if (respose.trim()) {
                chatMessagesElem.html(chatMessagesElem.html() + respose);
                chatMessagesElem.scrollTop(chatMessagesElem.prop("scrollHeight"));
            }
        }
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
                url: '../app/AjaxHandlers/SendMessageHandler.php',
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

    if (chatConversationIdElement.html().trim()) {
        updateHistory();
    }

    setInterval(function () {
        if (chatConversationIdElement.html().trim()) {
            updateHistory();
        }
    }, 1000);
});

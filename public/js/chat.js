function updateHistory() {
    var chatMessagesElem = $("#ChatMessages");

    var conversationId = $("#ChatConversationId").html();
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

    chatInputElement.keyup(function (e) {
        if (e.keyCode == 13 && chatInputElement.val().trim()) {
            var conversationId = $("#ChatConversationId").html();
            var chatInput = chatInputElement.val();

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

    updateHistory();

    setInterval(function () {
        updateHistory()
    }, 1000);
});

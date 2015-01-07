function updateHistory() {
    var chatMessagesElem = $("#ChatMessages");
    var conversationId = $("#ChatConversationId").val();

    var lastMessageId = chatMessagesElem.find(".ChatMessage:last-child .ChatMessageId:last-child").val();

    $.ajax({
        type: 'POST',
        async: true,
        url: '../app/FormHandlers/GetMessagesFormHandler.php',
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
        if (e.keyCode == 13 && chatInputElement.val()) {
            var conversationId = $("#ChatConversationId").val();
            var chatInput = chatInputElement.val();

            $.ajax({
                type: 'POST',
                async: true,
                url: '../app/FormHandlers/SendMessageFormHandler.php',
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

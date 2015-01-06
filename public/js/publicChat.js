$(document).ready(function () {
    function updateHistory () {
        $.ajax({
            type: 'POST',
            async: true,
            url: '../app/FormHandlers/GetMessagesFormHandler.php',
            data: {ConversationId:1},
            success:function (respose) {
                $("#ChatMessages").html(respose);
            }
        });
    }

    $("#ChatInput").keyup(function (e) {
        if (e.keyCode == 13) {
            var ConversationId = $("#txtConversationId").val();
            var ChatInput = $("#ChatInput").val();

            $.ajax({
                type: 'POST',
                async: true,
                url: '../app/FormHandlers/SendMessageFormHandler.php',
                data: {
                    ConversationId:ConversationId,
                    ChatInput:ChatInput
                },
                success:function () {
                    $("#ChatInput").val("");
                    updateHistory()
                }
            });
        }
    });

    setInterval(function () {
        updateHistory()
    }, 1500);

    updateHistory();
});

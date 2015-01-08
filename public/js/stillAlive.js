/**
 * Created by a4i on 1/8/15.
 */
function updateTimestamp() {
    $.ajax({
        type: 'POST',
        async: true,
        url: '../app/AjaxHandlers/StillAliveHandler.php'
    });
}

$(document).ready(function () {
    updateTimestamp();

    setInterval(function () {
        updateTimestamp()
    }, 1000);
});

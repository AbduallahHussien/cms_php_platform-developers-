export const sendTxtMsg = (chat_id, message,instance, token, referenceId) => {
    var settings = {
        async: true,
        crossDomain: true,
        url: "https://api.ultramsg.com/" + instance + "/messages/chat",
        method: "POST",
        headers: {},
        success: function (response) {
            if (response.error) {
                $("#notification").show().text("Mobile Number Is Valid");
                setTimeout(function () {
                    $("#notification").fadeOut("slow");
                }, 2000);
            } else {
                $("#exampleModal").modal("hide");
            }
        },
        data: {
            token: token,
            to: chat_id,
            body: message,
            priority: "10",
            referenceId: referenceId,
        },
    };
    $.ajax(settings).done();
};

import toastr from "toastr";
class MediaUploadHandler {
    init() {
        $("#OpenImgUpload").on("click", function () {
            if (
                $("#conversation").data("receiver_id") &&
                $("#conversation").data("receiver_id") != ""
            ) {
                $("#imgupload").trigger("click");
            } else {
                return false;
            }
        });

        $("#imgupload").on("change", function () {
            const chat_id = $("#conversation").data("receiver_id");
            if (!chat_id) return;
            const file = this.files[0];
            if (!file) return;

            const fileType = file.type.split("/")[0];
            const reader = new FileReader();
            reader.onload = function (event) {
                const fileData = event.target.result;
                if (!fileData) return;

                if (fileType === "image") {
                    $("#imagePreview").attr("src", fileData);
                    $("#_modal_image_preview")
                        .data("fileData", fileData)
                        .data("chatId", chat_id)
                        .modal("show");
                    // console.log('fileData',fileData)
                    // console.log('chatId',chat_id)
                } else if (fileType === "audio") {
                    $.ajax({
                        url: send_audio_route,
                        type: "POST",
                        data: { path: fileData, to: chat_id },
                        success: function (response) {
                            // Handle success if needed
                        },
                        error: function (error) {
                            // Handle error if needed
                        },
                    });
                } else if (fileType === "text" || fileType === "application") {
                    send_document(fileData, chat_id);
                } else if (fileType === "video") {
                    send_video(fileData, chat_id);
                } else {
                    return false;
                }
            };

            reader.readAsDataURL(file);
        });

        $("#_modal_image_preview #sendImageBtn").on("click", function () {
            const file = $("#_modal_image_preview").data("fileData"); // store file object earlier
            const chatId = $("#_modal_image_preview").data("chatId");

            if (!file || !chatId) {
                toastr.error("Missing image", "Error", {
                    timeOut: 5000,
                    closeButton: true,
                    progressBar: true,
                });
                return;
            }

            let formData = new FormData();
            formData.append("image", file);
            formData.append("to", chatId); 

            $.ajax({
                url: send_img_route,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message,"Success");
                        $("#_modal_image_preview").modal("hide");
                    }
                    else{
                        toastr.error(response.message, "Faild");
                    }

                },
                error: function (jqXHR) {
                    if (jqXHR.status === 422) {
                        const errors = jqXHR.responseJSON.errors;
                        let errorMessages = "";
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key].join(", ") + "\n";
                            }
                        }
                        toastr.error(
                            "Validation errors:\n" + errorMessages,
                            "Error",
                            {
                                timeOut: 5000,
                                closeButton: true,
                                progressBar: true,
                            },
                        );
                    } else {
                        toastr.error(
                            "Something went wrong. Please try again.",
                            "Error",
                            {
                                timeOut: 5000,
                                closeButton: true,
                                progressBar: true,
                            },
                        );
                    }
                },
            });

            $("#conversation").scrollTop(
                $("#conversation").prop("scrollHeight"),
            );
        });

        function send_video(file, chat_id) {
            var settings = {
                async: true,
                crossDomain: true,
                url: "https://api.ultramsg.com/" + instance + "/messages/video",
                method: "POST",
                headers: {},
                data: {
                    token: token,
                    to: chat_id,
                    video: file,
                    caption: "",
                    referenceId: referenceId,
                    nocache: "",
                },
            };

            $.ajax(settings).done(function (response) {
                $("#conversation").scrollTop(
                    $("#conversation").prop("scrollHeight"),
                );
            });
        }
        function send_document(file, chat_id) {
            var settings = {
                async: true,
                crossDomain: true,
                url:
                    "https://api.ultramsg.com/" +
                    instance +
                    "/messages/document",
                method: "POST",
                headers: {},
                data: {
                    token: token,
                    to: chat_id,
                    filename: "File",
                    document: file,
                    referenceId: referenceId,
                    nocache: "",
                },
            };

            $.ajax(settings).done(function (response) {
                $("#conversation").scrollTop(
                    $("#conversation").prop("scrollHeight"),
                );
            });
        }
    }
}

$(function () {
    new MediaUploadHandler().init();
});

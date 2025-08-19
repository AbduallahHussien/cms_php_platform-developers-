import toastr from "toastr";
class MediaUploadHandler {
    init() 
    {
        $('#_modal_image_preview').on('hidden.bs.modal', function () {
            $("#imagePreview").attr("src", ""); // clear image
        });

        $('#_modal_video_preview').on('hidden.bs.modal', function () {
            const video = $("#videoPreview")[0];
            video.pause();
            video.currentTime = 0; // reset playback
            video.src = "";           // clear video source
            video.load(); 
        });
        
        $("#OpenImgUpload").on("click", function () {
            if (
                $("#conversation").data("receiver_id") &&
                $("#conversation").data("receiver_id") != ""
            ) {
                $("#photoInput").trigger("click");
            } else {
                return false;
            }
        });

        let fileBase64Data = null;
        let fileName = null;
        let chat_id = null;
        let fileSize = null;
        let fileType = null;

        $("#photoInput").on("change", function () 
        {
            chat_id = $("#conversation").data("receiver_id");
            
            if (!chat_id) return;
            const file = this.files[0];
            if (!file) return;

            // Validate file size (30 MB limit)
            if (file.size > 16 * 1024 * 1024) {
                toastr.error("File is too large! Max size is 30MB.");
                $(this).val(""); // Reset input
                return;
            }
          

            fileName = file.name;
            if(!fileName){
                const randomString = Math.random().toString(36).substring(2, 10); // random 8 chars
                const timestamp = Date.now(); // current timestamp
                fileName = `file_${timestamp}_${randomString}`;
            }
            fileSize = (file.size / 1024).toFixed(2) + " KB";
            fileType = file.type;


            // Allowed extensions
            const imageExt = ["jpg", "jpeg", "gif", "png", "webp", "bmp"];
            const videoExt = ["mp4", "3gp", "mov"];

            // Extract file extension (lowercase)
            const extension = fileName.split(".").pop().toLowerCase();

            if (![...imageExt, ...videoExt].includes(extension)) 
            {
                toastr.error("Invalid file type! Only images (jpg, jpeg, gif, png, webp, bmp) and videos (mp4, 3gp, mov) are allowed.");
                $(this).val(""); // Reset input
                return;
            }

              // ✅ Differentiate image vs video
            let fileCategory;
            if (imageExt.includes(extension)) 
            {
                fileCategory = "image";
            } 
            else if (videoExt.includes(extension)) 
            {
                fileCategory = "video";
            }

            // const fileType = file.type.split("/")[0];
            const reader = new FileReader();
            reader.onload = function (event) {
                fileBase64Data = event.target.result;

                if (!fileBase64Data) {
                    toastr.error("Failed to read file. Please try again.");
                    return;
                }

                 // Validate Base64 length (max 10,000,000 characters)
                 if (fileBase64Data.length > 10000000) {
                    toastr.error(
                        "Encoded file is too large! Max Base64 length is 10,000,000 characters.",
                    );
                    $("#documentInput").val("");
                    return;
                }

                if (fileCategory === "image") 
                {
                    $("#imagePreview").attr("src", fileBase64Data);
                    $("#_modal_image_preview")
                        .data("fileData", fileBase64Data)
                        .data("chatId", chat_id)
                        .modal("show");
                } 
                // else if (fileType === "audio") 
                // {
                //     $.ajax({
                //         url: send_audio_route,
                //         type: "POST",
                //         data: { path: fileData, to: chat_id },
                //         success: function (response) {
                //             // Handle success if needed
                //         },
                //         error: function (error) {
                //             // Handle error if needed
                //         },
                //     });
                // } 
                else if (fileCategory === "video") 
                {
                    const videoUrl = URL.createObjectURL(file);
                    // Set video src
                    const video = $("#videoPreview")[0];
                    video.src = videoUrl;  // set directly on video element
                    video.load();          // reload the video
                    // Show modal
                    $("#_modal_video_preview").modal("show");
                } else {
                    return false;
                }
            };
            
            $(this).val("");
            reader.readAsDataURL(file);
        });

        // Send video button click
        $("#sendVideoBtn").on("click", function () {
            if (!fileBase64Data) { // This should contain your Base64 or Blob URL
                toastr.error("No video selected!");
                return;
            }
            const { instance, token } = window.ultraMsgConfig;
            $.ajax({
                url: `https://api.ultramsg.com/${instance}/messages/video`,
                type: "POST",
                data: {
                    token: token,
                    to: chat_id,
                    video: fileBase64Data,  // Base64 video or URL depending on UltraMsg
                    filename: fileName,    // Optional, name of the video file
                },
                beforeSend: function () {
                    $("#sendVideoBtn").css("pointer-events", "none");
                    $("#sendVideoBtn").text("Sending ...");
                },
                success: function (response) {
                    if (response.sent === true || response.sent === "true") {
                        toastr.success("Video sent!");
                    } else {
                        toastr.error(response.error || "Failed to send video");
                    }
                    $("#_modal_video_preview").modal("hide");
                },
                error: function (xhr) {
                    console.error("Error sending video:", xhr.responseText);
                    toastr.error("Failed to send video.");
                },
                complete: function () {
                    $("#sendVideoBtn").css("pointer-events", "auto");
                    $("#sendVideoBtn").text("Send");
                    $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                },
            });
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
                beforeSend:function(){
                    $('#sendImageBtn').css('pointer-events','none');
                    $('#sendImageBtn').text('Sending ...');
                },
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
                complete:function(){
                    $('#sendImageBtn').css('pointer-events','auto');
                    $('#sendImageBtn').text('Send');
                }
            });

            $("#conversation").scrollTop(
                $("#conversation").prop("scrollHeight"),
            );
        });
    }
}

$(function () {
    new MediaUploadHandler().init();
});

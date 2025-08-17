class AudioUploadHandler {
    init() {

        $('#modal_preview_audio').on('hidden.bs.modal', function () {
            // Clear file info
            $('#audioName').text('');
            $('#audioSize').text('');
        
            // Stop audio playback & reset
            const audio = $('#audioPlayer').get(0);
            if (audio) {
                audio.pause();
                audio.currentTime = 0;
                audio.src = '';
            }
        
            // Reset file input if you want
            $('#audioInput').val('');
        });

        
        $("#openAudioUpload").on("click", function () {
            if (
                $("#conversation").data("receiver_id") &&
                $("#conversation").data("receiver_id") !== ""
            ) {
                $("#audioInput").trigger("click");
            } else {
                return false;
            }
        });

        let fileBase64Data = null;
        let fileName = null;
        let chat_id = null;
        let fileSize = null;
        let fileType = null;

        $("#audioInput").on("change", function () {
            chat_id = $("#conversation").data("receiver_id");
            if (!chat_id) return;

            const file = this.files[0];
            if (!file) return;

            // Validate file size (30 MB limit)
            if (file.size > 30 * 1024 * 1024) {
                toastr.error("Audio file is too large! Max size is 30MB.");
                $(this).val(""); // Reset input
                return;
            }

            fileName = file.name || `audio_${Date.now()}_${Math.random().toString(36).substring(2, 10)}.mp3`;
            fileSize = (file.size / 1024).toFixed(2) + " KB";
            fileType = file.type;

            // Allowed audio MIME types
            const allowedTypes = [
                "audio/mpeg",  // MP3
                "audio/aac",   // AAC
                "audio/ogg"    // OGG
            ];

            if (!allowedTypes.includes(file.type)) {
                toastr.warning("Please upload a valid audio file (MP3, WAV, OGG, M4A, etc.)");
                $(this).val("");
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                fileBase64Data = event.target.result;

                if (!fileBase64Data) {
                    toastr.error("Failed to read audio file.");
                    return;
                }

                // Validate Base64 length (max 10,000,000 characters)
                if (fileBase64Data.length > 10000000) {
                    toastr.error("Encoded audio is too large! Max Base64 length is 10,000,000 characters.");
                    $("#audioInput").val("");
                    return;
                }

                // Show preview
                $("#audioName").text(fileName);
                $("#audioSize").text(fileSize);
                $("#audioPlayer").attr("src", fileBase64Data);
                $("#audioPreview").show();

                $("#modal_preview_audio").modal("show");
            };
            reader.readAsDataURL(file);
        });

        // Send button click
        $("#sendAudio").on("click", function () {
            if (!fileBase64Data) {
                toastr.error("No audio selected!");
                return;
            }

            $.ajax({
                url: `https://api.ultramsg.com/${instance}/messages/audio`,
                type: "POST",
                data: {
                    token: token,
                    to: chat_id,
                    audio: fileBase64Data,
                    filename: fileName,
                },
                beforeSend: function () {
                    $("#sendAudio").css("pointer-events", "none");
                    $("#sendAudio").text("Sending ...");
                },
                success: function (response) {
                    if (response.sent === true || response.sent === "true") {
                        toastr.success("Audio sent!");
                    } else {
                        toastr.error(response.error || "Failed to send audio.");
                    }
                    $("#modal_preview_audio").modal("hide");
                },
                error: function (xhr) {
                    console.error("Error sending audio:", xhr.responseText);
                    toastr.error("Failed to send audio.");
                },
                complete: function () {
                    $("#sendAudio").css("pointer-events", "auto");
                    $("#sendAudio").text("Send");
                    $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                },
            });
        });
    }
}

$(function () {
    new AudioUploadHandler().init();
});

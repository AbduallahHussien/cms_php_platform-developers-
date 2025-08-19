class DocumentUploadHandler {
    init() {

        $('#modal_preview_file').on('hidden.bs.modal', function () {
            // Hide & clear the PDF iframe
            $('#docPreview').hide().attr('src', '');
        
            // Hide & clear generic file info
            $('#fileInfo').hide();
            $('#fileName').text('');
            $('#fileSize').text('');
        
            // Reset file input so user can re-upload
            $('#documentInput').val('');
        
            // Reset Send button state
            $('#sendDocument').css('pointer-events', 'auto').text('Send');
        });

        
        $("#openDocumetUpload").on("click", function () {
            if (
                $("#conversation").data("receiver_id") &&
                $("#conversation").data("receiver_id") != ""
            ) {
                $("#documentInput").trigger("click");
            } else {
                return false;
            }
        });

        let fileBase64Data = null;
        let fileName = null;
        let chat_id = null;
        let fileSize = null;
        let fileType = null;
        $("#documentInput").on("change", function () {
            chat_id = $("#conversation").data("receiver_id");

            if (!chat_id) return;
            const file = this.files[0];
            if (!file) return;


            // Validate file size (30 MB limit)
            if (file.size > 30 * 1024 * 1024) {
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
            // Allowed document MIME types
            const allowedTypes = [
                "application/pdf", // PDF
                "application/msword", // DOC
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document", // DOCX
                "application/vnd.ms-excel", // XLS
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // XLSX
                "text/plain", // TXT
                "application/vnd.ms-powerpoint", // PPT
                "application/vnd.openxmlformats-officedocument.presentationml.presentation", // PPTX
            ];

            if (!allowedTypes.includes(file.type)) {
                toastr.warning(
                    "Please upload a valid document file (PDF, Word, Excel, PPT, TXT).",
                );
                $(this).val(""); // reset file input
                return;
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

                
                // Reset preview sections
                $("#docPreview").hide();
                $("#fileInfo").hide();

                if (fileType === "application/pdf") {
                    $("#docPreview").attr("src", fileBase64Data).show();
                } else {
                    $("#fileName").text(fileName);
                    $("#fileSize").text(fileSize);
                    $("#fileInfo").show();
                }

                $("#modal_preview_file").modal("show");
            };
            reader.readAsDataURL(file);
        });

        // Send button click
        $("#sendDocument").on("click", function () {
             
            if (!fileBase64Data) {
                toastr.error("No file selected!");
                return;
            }

            const { instance, token } = window.ultraMsgConfig;

            $.ajax({
                url: `https://api.ultramsg.com/${instance}/messages/document`,
                type: "POST",
                data: {
                    token: token,
                    to: chat_id,
                    document: fileBase64Data, // Base64 document
                    filename: fileName,
                },
                beforeSend: function () {
                    $("#sendDocument").css("pointer-events", "none");
                    $("#sendDocument").text("Sending ...");
                },
                success: function (response) {
                    if (response.sent === true || response.sent === "true") {
                        toastr.success("Document sent!");
                    } else {
                        toastr.error(resp.error || "Failed to send document");
                    }

                    $("#modal_preview_file").modal("hide");
                },
                error: function (xhr) {
                    console.error("Error sending document:", xhr.responseText);
                    toastr.error("Failed to send document.");
                },
                complete: function () {
                    $("#sendDocument").css("pointer-events", "auto");
                    $("#sendDocument").text("Send");
                    $("#conversation").scrollTop(
                        $("#conversation").prop("scrollHeight"),
                    );
                },
            });
        });
    }
}

$(function () {
    new DocumentUploadHandler().init();
});

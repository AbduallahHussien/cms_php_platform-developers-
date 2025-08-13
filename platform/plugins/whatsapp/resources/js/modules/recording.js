class Recording {
    init() {
        (function () {
            let mediaRecorder = null;
            let mediaStream = null;
            let chunks = [];
            let timerId = null;
            let startAt = 0;
            let finalBlob = null;
            let mimeType = null;

            function pickMimeType() {
                const candidates = [
                    "audio/ogg;codecs=opus", // Preferred for WhatsApp
                    "audio/webm;codecs=opus", // Chrome fallback
                    "audio/mp4", // Safari fallback
                ];
                for (const t of candidates) {
                    if (
                        window.MediaRecorder &&
                        MediaRecorder.isTypeSupported &&
                        MediaRecorder.isTypeSupported(t)
                    ) {
                        return t;
                    }
                }
                
                return ""; // Let browser choose if none matched
            }

            function formatTime(ms) {
                const s = Math.floor(ms / 1000);
                const m = Math.floor(s / 60);
                const ss = String(s % 60).padStart(2, "0");
                const mm = String(m).padStart(2, "0");
                return `${mm}:${ss}`;
            }

            function setUIRecording() {
                // $("#voice-preview").hide().attr("src", "");
                $("#voice-hint").text("Recording…");
                // $("#voice-stop").show();
                // $("#voice-restart").hide();
                // $("#voice-send").prop("disabled", true);
                $("#voice-error").hide().text("");
            }

            function setUIStopped(blobUrl) {
                $("#voice-hint").text("Preview ready");
                $("#voice-preview").attr("src", blobUrl).show();
                $("#voice-stop").hide();
                $("#voice-restart").show();
                $("#voice-send").prop("disabled", false);
            }

            async function startRecording() {
                if (
                    !navigator.mediaDevices ||
                    !navigator.mediaDevices.getUserMedia
                ) {
                    showError(
                        "Your browser does not support audio recording. Use a modern browser over HTTPS.",
                    );
                    return;
                }
                try {
                    mimeType = pickMimeType();
                    console.log('Recording mime type:', mimeType);

                    mediaStream = await navigator.mediaDevices.getUserMedia({
                        audio: true,
                    });

                    const options = mimeType ? { mimeType } : {};
                    mediaRecorder = new MediaRecorder(mediaStream, options);
                    chunks = [];
                    finalBlob = null;

                    mediaRecorder.addEventListener("dataavailable", (e) => {
                        if (e.data && e.data.size > 0) chunks.push(e.data);
                    });

                    mediaRecorder.addEventListener("stop", () => {
                        stopTimer();
                        if (mediaStream) {
                            mediaStream.getTracks().forEach((t) => t.stop());
                            mediaStream = null;
                        }
                        finalBlob = new Blob(chunks, {
                            type: mimeType || "audio/ogg",
                        });
                        console.log('Blob type:', finalBlob.type);

                        // const url = URL.createObjectURL(finalBlob);
                        // setUIStopped(url);
                    });

                    setUIRecording();
                    startTimer();
                    mediaRecorder.start();
                } catch (err) {
                    showError(
                        err?.message ||
                            "Microphone permission denied or not available.",
                    );
                }
            }

            // function stopRecording() {
            //     if (mediaRecorder && mediaRecorder.state !== "inactive") {
            //         mediaRecorder.stop();
            //     }
            // }

            // function restartRecording() {
            //     const el = document.getElementById("voice-preview");
            //     if (el.src) {
            //         try {
            //             URL.revokeObjectURL(el.src);
            //         } catch {}
            //         el.removeAttribute("src");
            //     }
            //     startRecording();
            // }

            function startTimer() {
                startAt = Date.now();
                $("#voice-timer").text("00:00");
                clearInterval(timerId);
                timerId = setInterval(() => {
                    const elapsed = Date.now() - startAt;
                    $("#voice-timer").text(formatTime(elapsed));
                }, 200);
            }

            function stopTimer() {
                clearInterval(timerId);
                timerId = null;
            }

            function showModal() {
                $("#voice-modal").fadeIn(100);
                startRecording();
            }

            function closeModal() {
                if (mediaRecorder && mediaRecorder.state === "recording") {
                    mediaRecorder.onstop = null;
                    mediaRecorder.stop();
                }
                if (mediaStream) {
                    mediaStream.getTracks().forEach((t) => t.stop());
                    mediaStream = null;
                }
                stopTimer();
                // const el = document.getElementById("voice-preview");
                // if (el.src) {
                //     try {
                //         URL.revokeObjectURL(el.src);
                //     } catch {}
                //     el.removeAttribute("src");
                // }
                $("#voice-modal").fadeOut(100);
                $("#voice-error").hide().text("");
                $("#voice-timer").text("00:00");
                $("#voice-hint").text("Recording…");
                // $("#voice-send").prop("disabled", true);
                // $("#voice-stop").show();
                // $("#voice-restart").hide();
                chunks = [];
                finalBlob = null;
            }

            function showError(msg) {
                $("#voice-error").text(msg).show();
            }

            // async function blobToBase64(blob) {
            //     return new Promise((resolve, reject) => {
            //         const reader = new FileReader();
            //         reader.onloadend = () => resolve(reader.result);
            //         reader.onerror = reject;
            //         reader.readAsDataURL(blob);
            //     });
            // }

            async function sendAudio() {
              
                if (mediaRecorder && mediaRecorder.state === "recording") {
                    await new Promise((resolve) => {
                        mediaRecorder.addEventListener("stop", resolve, { once: true });
                        mediaRecorder.stop();
                    });
                }
            
                if (!finalBlob) {
                    showError("No audio to send.");
                    return;
                }

                try { 
                    const formData = new FormData();
                    formData.append('to', $("#conversation").data("receiver_id"));

                    // Derive extension from mime type: e.g. audio/webm -> webm
                    const ext = (finalBlob.type.match(/audio\/(\w+)/) || [null, 'webm'])[1];
                    formData.append('audio', finalBlob, `voice.${ext}`);
              
                    $.ajax({
                        url: send_voice_route,
                        method: "POST",
                        data: formData,
                        processData: false,  // Important for FormData
                        contentType: false,  // Important for FormData
                        beforeSend:function(){
                            $("#voice-send").prop("disabled", true);
                            $("#voice-send").text('Sending ...');

                        },
                        success: function (data) {
                            if (data.success) {
                                toastr.success("Audio sent successfully!");
                            } else {
                                showError(data.message || "Failed to send audio.");
                            }
                        },
                        error: function () {
                            showError("Failed to send audio.");
                        },
                        complete:function(){ 
                            $("#voice-send").prop("disabled", false);
                            $("#voice-send").text('Send'); 
                            closeModal(); 
                            $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                        }
                    }); 
                    
                } catch (err) {
                    showError(err?.message || "Failed to send audio.");
                } 
            }


            $(document).on("click", ".voice-message-button", showModal);
            // $(document).on("click", "#voice-stop", stopRecording);
            // $(document).on("click", "#voice-restart", restartRecording);
            $(document).on("click", "#voice-send", sendAudio);
            $(document).on("click", "#voice-cancel, .voice-close", closeModal);
            $(document).on("click", "#voice-modal", function (e) {
                if (e.target === this) closeModal();
            });
        })();
    }
}

$(function () {
    new Recording().init();
});

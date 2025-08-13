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
            
           
            // $(".voice-message-button").on("click", showModal());

            // Choose a MIME type that works in the current browser
            function pickMimeType() {
                const candidates = [
                    "audio/webm;codecs=opus", // Chrome/Edge
                    "audio/ogg;codecs=opus", // Firefox
                    "audio/mp4", // Safari (MediaRecorder in Safari prefers mp4/aac)
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
                $("#voice-preview").hide().attr("src", "");
                $("#voice-hint").text("Recording…");
                $("#voice-stop").show();
                $("#voice-restart").hide();
                $("#voice-send").prop("disabled", true);
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
                    mediaStream = await navigator.mediaDevices.getUserMedia({
                        audio: true,
                    });
                    mediaRecorder = new MediaRecorder(
                        mediaStream,
                        mimeType ? { mimeType } : {},
                    );
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
                            type: mimeType || "audio/webm",
                        });
                        const url = URL.createObjectURL(finalBlob);
                        setUIStopped(url);
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

            function stopRecording() {
                if (mediaRecorder && mediaRecorder.state !== "inactive") {
                    mediaRecorder.stop();
                }
            }

            function restartRecording() {
                // Revoke old preview URL
                const el = document.getElementById("voice-preview");
                if (el.src) {
                    try {
                        URL.revokeObjectURL(el.src);
                    } catch {}
                    el.removeAttribute("src");
                }
                startRecording();
            }

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
                startRecording(); // start immediately like WhatsApp
            }

            function closeModal() {
                // If still recording, stop and discard result
                if (mediaRecorder && mediaRecorder.state === "recording") {
                    mediaRecorder.onstop = null; // prevent UI switch to preview
                    mediaRecorder.stop();
                }
                if (mediaStream) {
                    mediaStream.getTracks().forEach((t) => t.stop());
                    mediaStream = null;
                }
                stopTimer();
                // Cleanup preview URL
                const el = document.getElementById("voice-preview");
                if (el.src) {
                    try {
                        URL.revokeObjectURL(el.src);
                    } catch {}
                    el.removeAttribute("src");
                }
                $("#voice-modal").fadeOut(100);
                $("#voice-error").hide().text("");
                $("#voice-timer").text("00:00");
                $("#voice-hint").text("Recording…");
                $("#voice-send").prop("disabled", true);
                $("#voice-stop").show();
                $("#voice-restart").hide();
                chunks = [];
                finalBlob = null;
            }

            function showError(msg) {
                $("#voice-error").text(msg).show();
            }


            async function blobToBase64(blob) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onloadend = () => resolve(reader.result);
                    reader.onerror = reject;
                    reader.readAsDataURL(blob);
                });
            }

            async function sendAudio() {
              
                // Ensure we have a final blob
                if (mediaRecorder && mediaRecorder.state === "recording") {
                    await new Promise((resolve) => {
                        mediaRecorder.addEventListener("stop", resolve, {
                            once: true,
                        });
                        mediaRecorder.stop();
                    });
                }
                if (!finalBlob) {
                    showError("No audio to send.");
                    return;
                }
                
                try {

                    const base64Audio = await blobToBase64(finalBlob);
               
                  
                    $.ajax({
                        url: send_voice_route,
                        method: "POST",
                        data: {
                            to: $("#conversation").data("receiver_id"),
                            audio: base64Audio, // base64 string
                        },
                        success: function (data) {
                            console.log(1111);
                            if(data.success)
                            {
                                toastr.success('wow');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            
                        }
                    });
                    
                
                    closeModal();
                    // Optionally add the audio message to chat UI here
                
                } catch (err) {
                    showError(err?.message || "Failed to send audio.");
                }
                
            }

            // Wire up your existing button
            $(document).on("click", ".voice-message-button", showModal);

            // Modal controls
            $(document).on("click", "#voice-stop", stopRecording);
            $(document).on("click", "#voice-restart", restartRecording);
            $(document).on("click", "#voice-send", sendAudio);
            $(document).on("click", "#voice-cancel, .voice-close", closeModal);

            // Close on backdrop click (not on dialog)
            $(document).on("click", "#voice-modal", function (e) {
                if (e.target === this) closeModal();
            });
        })();
    }
}

$(function () {
    new Recording().init();
});

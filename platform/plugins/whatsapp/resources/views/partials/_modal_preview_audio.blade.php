<div class="modal fade" id="modal_preview_audio" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Audio Preview</h5> 
            </div>

            <div class="modal-body text-center">
                <p><strong>File name:</strong> <span id="audioName"></span></p>
                <p><strong>File size:</strong> <span id="audioSize"></span></p>
                <audio id="audioPlayer" controls style="width:100%;"></audio>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="sendAudio" class="btn btn-primary">Send</button>
            </div>

        </div>
    </div>
</div>

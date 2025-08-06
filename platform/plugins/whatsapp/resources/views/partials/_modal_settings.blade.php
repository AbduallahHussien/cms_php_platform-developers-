<div class="modal fade" id="modalSettings" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h2 class="modal-title" id="modalToggleLabel">Check settings please!</h2>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Token</label>
                    <input type="text" class="form-control" id="token" placeholder="Token">
                </div>
                <div class="mb-3">
                    <label class="form-label">Instance</label>
                    <input type="text" class="form-control" id="instance" placeholder="Instance">
                </div>
                <div class="mb-3">
                    <label class="form-label">FIREBASE DATABASE URL</label>
                    <input type="text" class="form-control" id="firebase_database_url" value="{{env('FIREBASE_DATABASE_URL')}}" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" id="settings_save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
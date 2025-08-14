<div class="modal fade" id="modal_preview_file" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Document Preview</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
        </div>
  
        <div class="modal-body">
          <iframe id="docPreview" style="width:100%; height:400px; display:none;" frameborder="0"></iframe>
          <!-- Name & size preview -->
          <div id="fileInfo" style="display:none;">
            <p><strong>File name:</strong> <span id="fileName"></span></p>
            <p><strong>File size:</strong> <span id="fileSize"></span></p>
          </div>
        </div>

  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="sendDocument" class="btn btn-primary">Send</button>
        </div>
  
      </div>
    </div>
  </div>
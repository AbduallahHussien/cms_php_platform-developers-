<div class="modal fade" id="new-message" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                
    <div class="modal-dialog">
    <div class="modal-content">
        
        <div class="modal-header p-3 text-bg-success">
        <h1 class="modal-title fs-5" id="NewMessageLabel">New Chat</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="alert alert-danger" id="notification" style="display:none" role="alert">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" placeholder="Phone number with international format e.g. +14155552671">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="3"></textarea>
        </div>
        </div>
        <div class="modal-footer mt-3 mb-3">
        <button type="button" class="btn btn-success" id="AddNewChat">Send</button>
        </div>
    </div>
    </div>

</div>
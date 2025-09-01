<div class="modal fade" id="EditModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="p-5 modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row g-2">

                    <div class="col mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                        <input type="hidden" id="id" name="id">
                    </div>

                    <div class="col mb-2">
                        <label for="channel" class="form-label">Channel</label>
                        <input type="text" id="channel" class="form-control" name="channel" placeholder="channel">
                    </div>

                </div>

                <div class="row g-2">

                    <div class="col mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="email">
                    </div>

                    <div class="col mb-2">
                        <label for="phone" class="form-label">PHONE</label>
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="phone">
                    </div>

                </div>

                <div class="row g-2">

                    <div class="col mb-2">
                        <label for="tags" class="form-label">TAGS</label>
                        <input type="text" id="tags" class="form-control" name="tags" placeholder="tags">
                    </div>

                    <div class="col mb-2">
                        <label for="country" class="form-label">COUNTRY</label>
                        <input type="text" id="country" class="form-control" name="country"  placeholder="country">
                    </div>

                </div>

                <div class="row g-2">

                    <div class="col mb-2">
                        <label for="language" class="form-label">LANGUAGE</label>
                        <input type="text" id="language" class="form-control" name="language" placeholder="language">
                    </div>

                    <div class="col mb-2">
                        <label for="conversation_status" class="form-label">CONVERSATION STATUS</label>
                        <input type="text" id="conversation_status" class="form-control" name="conversation_status" placeholder="conversation_status">
                    </div>

                </div>

                <div class="row g-2">

                    <div class="col mb-2">
                        <label for="assignee" class="form-label">ASSIGNEE</label>
                        <input type="text" id="assignee" class="form-control" name="assignee" placeholder="assignee">
                    </div>

                </div>
                
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="EditContact" class="btn btn-primary">Edit</button>

            </div>

        </div>
    </div>
</div>
            
@extends('plugins/whatsapp::layout')
@section('title','Contacts')
@section('page')
<style>
    .card {
        min-height: 618px;
    }
    .table-responsive.text-nowrap {
         min-height: inherit;
    }   
    div#spinner {
    position: absolute;
    top: 50%;
    left: 39%;
    z-index: 88888888888;
}
</style>

    <!-- container --> 
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-danger" style="display:none" role="alert">There's a mistake ,Please try again later!</div>
            <div class="alert alert-success" style="display:none" role="alert"></div>
            <div class="col">

                <div class="card">
                    <div class="col" id="spinner">

                        <div class="demo-inline-spacing">
                        <div class="spinner-grow" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h5 class="card-header">All Contacts</h5>
                    <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Display</th>
                            <th scope="col">Name</th>
                            <th scope="col">Channel</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Country</th>
                            <th scope="col">Language</th>
                            <th scope="col">Conversation Status</th>
                            <th scope="col">Assignee</th>
                            <th scope="col">Last message</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0"  id="contactsResults">
                           
                        </tbody>
                    </table>
                    </div>
                </div>
                        
            </div>
        </div>                            
    </div>
    <!-- End container -->

    <!-- Modal edit -->
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
    <!-- Modal edit -->

    <script src="{{ asset('vendor/core/plugins/whatsapp/plugins/custom/whatsapp/contacts.js') }}"></script>

@stop

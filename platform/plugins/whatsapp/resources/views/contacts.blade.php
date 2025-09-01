            
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
        @include('plugins/whatsapp::partials.header_actions._modal_edit_contact')
    <!-- Modal edit -->

    {{-- <script src="{{ asset('vendor/core/plugins/whatsapp/plugins/custom/whatsapp/contacts.js') }}"></script> --}}

@stop

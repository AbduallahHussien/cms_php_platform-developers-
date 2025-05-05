@extends('plugins/whatsapp::layout')

@section('page')
<!-- container --> 
<div class="container-fluid">
    
    <div class="alert alert-danger" style="display:none" role="alert"></div>
    <div class="alert alert-success" style="display:none" role="alert">Broadcast created successfully</div>

    <div class="row buttons">
        <div class="col"><a type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Create"><i class='bx bx-plus' ></i> &nbsp;Create New Group</a></div>
        <div class="col"><a href="<?php echo site_url("/Reports/index")?>" type="button" class="btn btn-outline-primary"><i class='bx bxs-report'></i> &nbsp; Reports</a></div>
        <div class="col"><a href="<?php echo site_url("/BusinessTools/index")?>" type="button" class="btn btn-outline-primary"><i class='bx bxs-business'></i> &nbsp; Business Tools</a></div>
    </div>

    <div class="row">
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

            <h5 class="card-header">Groups</h5>

            <div class=" text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Counter</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="GroupResults">
                    <tr>
                    
                        
                        <td> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        
                        <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                        
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                        </td>
                    </tr>
                
                    </tbody>
                </table>
            </div>
                                        
        </div>
    </div>
                             
</div>
<!-- End container -->



<!-- modal--create -->

    <div class="modal fade" id="Create" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Brodcast Name</label>
                        <input type="text" class="form-control" id="brodcastName" >
                        <input type="hidden" class="form-control" id="brodcastId" >
                    </div>
                    <div class="divider divider-primary">
                        <div class="divider-text">Select Country Code</div>
                    </div>
                    <div>
                        <select name="items" class="form-select" id="pincode" required="required">
                                                             
                        </select>
                    </div>
                    <div class="divider divider-primary">
                        <div class="divider-text">Enter Numbers</div>
                    </div>
                    <div>
                        <textarea class="form-control" id="recipients"  rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add_broadcast">Add New</button>
                </div>
                </div>
            </div>
    </div>

<!-- End modal--create -->
@stop
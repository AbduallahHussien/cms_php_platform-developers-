
@extends('plugins/whatsapp::layout')

@section('page')

         <!-- container --> 
            <div class="container-fluid app ">

                
                <!-- Image Preview Modal -->
               @include('plugins/whatsapp::partials._modal_image_preview')
               @include('plugins/whatsapp::partials._modal_video_preview')
               @include('plugins/whatsapp::partials._modal_preview_document')
               @include('plugins/whatsapp::partials._modal_preview_audio')
               @include('plugins/whatsapp::partials._modal_recording_voice')
                <!-- APP ROW -->
                    <div class="row app-one">

                    <!-- LEFT SIDES -->

                        <div class="col-xs-12 col-md-4 side">
                            <!-- SIDE ONE => CONTACTS -->
                                <div class="side-one">
                                    @include('plugins/whatsapp::partials._heading_actions')

                                    <div class="row searchBox">
                                        <!-- <div class="col-12 searchBox-inner">
                                        <div class="form-group has-feedback">
                                            <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>
                                        </div> -->
                                            <div class=" col-4 mt-1 ">
                                                <select class="form-select" id="conversations_types" aria-label="Default select example">
                                                    <option value="all" selected>All</option>
                                                    <option value="open">Open</option>
                                                    <option value="close">Close</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="row sideBar">
                                
                                    </div>
                                </div>
                            <!-- SIDE CONTACTS -->

                            <!-- SIDE TWO => NEW CHAT -->
                                <div class="side-two">
                                    <div class="row newMessage-heading">
                                        <div class="row newMessage-main">
                                            <div class="col-2 newMessage-back">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </div>
                                            <div class="col-10  newMessage-title">New Chat</div>
                                        </div>
                                    </div>

                                    <div class="row composeBox">
                                        <div class="col-12 composeBox-inner">
                                            <div class="new-chat">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#new-message">
                                                    New Chat
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row compose-sideBar">

                                    </div>
                                </div>
                            <!-- END SIDE TWO  -->

                            <!-- SIDE TEMPLATES -->
                                <div class="side-templates">
                                    <div class="row newtemplate-heading">
                                        <div class="row newtemplate-main">
                                            <div class="col-2 newtemplate-back">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </div>
                                            <div class="col-10  newtemplate-title">Templates</div>
                                        </div>
                                    </div>

                                    <div class="row composeBox">
                                        <div class="col-12 composeBox-inner">
                                            <div class="new-chat">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#saveTemplate">
                                                    New Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body" id="templates" >
                                    </div>
                                </div>
                            <!--END  SIDE TEMPLATES -->

                            <!-- SIDE GROUPS -->
                                <div class="side-groups">
                                    <div class="row newgroup-heading">
                                        <div class="row newgroup-main">
                                            <div class="col-2 newgroup-back">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </div>
                                            <div class="col-10  newgroup-title">Groups</div>
                                        </div>
                                    </div>

                                    <div class="row composeBox">
                                        <div class="col-12 composeBox-inner">
                                            <div class="new-chat">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#CreateGroup">
                                                    New group
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body" id="groups" >
                                    </div>
                                </div> 
                            <!-- END SIDE GROUPS -->

                            <!-- SIDE REPORTS -->
                                <div class="side-reports">
                                    <div class="row reports-heading">
                                        <div class="row reports-main">
                                            <div class="col-2 reports-back">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </div>
                                            <div class="col-10  reports-title">reports</div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="reports" >
                                        <div class="card p-3 report-card">
                                            <div class="row">
                                                <div class="col">
                                                            <figure class="p-3 mb-0">
                                                                <span>
                                                                    <figcaption class=" mb-0 text-muted"><i class='bx bxs-group' ></i> group name</figcaption>
                                                                </span>
                                                            </figure>
                                                            <figure class="p-3 mb-0">
                                                                <span>
                                                                    <figcaption class=" mb-0 text-muted"><i class='bx bxs-layout'></i>template title</figcaption>
                                                                </span>
                                                            </figure>
                                                        
                                                    </figure>
                                                </div>
                                                <div class="col">
                                                    <figure class="p-3 mb-0">
                                                        <span><figcaption class=" mb-0 text-muted"><i class='bx bxs-calendar'></i>date</figcaption></span>
                                                    </figure>
                                                    <figure class="p-3 mb-0">
                                                        <span><figcaption class=" mb-0 text-muted"><i class='bx bxs-timer'></i>count</figcaption></span>  
                                                    </figure>

                                                </div>
                                            </div>
                                            <button type="button" class="btn rounded-pill btn-icon btn-outline-primary view-report" data-bs-toggle="modal" data-bs-target="#view-report">
                                            <span class="tf-icons bx bx-show"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <!-- END SIDE REPORTS -->

                        </div>
                    <!-- LEFT SIDES -->

                    <!-- CONVERSATION -->
                        <div class="col-xs-12 col-md-8 conversation d-none">



                            <!-- CONVERSATION HEADING -->
                            <div class="row heading">

                                <!-- ARROW BACK TO CHAT  THIS SHOW ONLY MOBILE SCREEN -->
                                    <div class="col-1 heading-avatar" id="backChat">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="50" fill="#54656f" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                        </svg>
                                    </div>
                                <!-- ARROW BACK TO CHAT -->

                                <!-- CONVERSATION AVATAR -->
                                    <div class="col-2  heading-avatar">
                                        <div class="heading-avatar-icon">
                                        </div>
                                    </div>
                                <!-- CONVERSATION AVATAR -->

                                <!-- CONVERSATION NAME -->
                                    <div class="col-6 heading-name">
                                        <a class="heading-name-meta">
                                        </a>
                                    </div>
                                <!-- END CONVERSATION NAME -->

                                <!-- CONVERSATION TYPE -->
                                <div class="col-3 conversation-type">
                                    <button type="button" 
                                            class="btn btn-secondary d-none" 
                                            id="conversation-type" 
                                            data-action="" 
                                            data-chat_id="" 
                                            data-chat_img="" 
                                            data-chat_title="">Open Conversation</button>
                                </div>
                                {{-- @include('plugins/whatsapp::partials._btn_conversation_type') --}}
                                
                                <!-- END CONVERSATION TYPE -->
                            </div>
                            <!-- END CONVERSATION HEADING -->



                            
                            @include('plugins/whatsapp::partials._btn_view_more')
                              
                            
                            
                                <div class="row message" id="conversation" data-receiver_id="">  </div>
                            <!-- CONVERSATION FOOTER -->
                            
                                <div class="row reply"> 
                                    @include('plugins/whatsapp::partials._btn_attachment')
                                    <div class="col-10  reply-main">
                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                    </div>
                                    <div class="col-1 reply-recording text-center">
                                        <button class="voice-message-button">
                                            <i class="fas fa-microphone" style="font-size: 1.25rem;"></i>
                                        </button>
                                    </div>
                                </div>
                            <!-- END CONVERSATION FOOTER -->

                        </div>
                    <!--END CONVERSATION -->
                      <div class=" col-xs-12 col-md-8 conversation start-bg" >

                      </div>
                    </div>
                <!--END APP ROW -->
            </div>
        <!-- End container -->

        <!-- Modals -->
        
            <!-- Modal Add new message -->
                @include('plugins/whatsapp::partials._modal_new_message')
            <!-- Modal Add new message -->

            <!-- Modal Location -->
               @include('plugins/whatsapp::partials._modal_location')
            <!-- End Modal Location --> 

            <!-- modal--send -->
                <div class="modal fade" id="Send" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                        <div class="modal-header p-3">
                            <h5 class="modal-title" id="modalScrollableTitle">Send</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="SelectGroup" class="form-label">Choice Group</label>
                                <select multiple="" class="form-select" id="SelectGroup" aria-label="Multiple select example">
                                    <option value="0">select group</option>
                                </select>
                                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-template" aria-controls="navs-top-template" aria-selected="false">Template</button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-message" aria-controls="navs-top-message" aria-selected="false">New message</button>
                                        </li>
                                    
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane text-start fade active show" id="navs-top-template" role="tabpanel">
                                                <div class="mb-3 ">
                                                    <label for="SelectTemplate" class="form-label">Template name</label>
                                                    <select multiple="" class="form-select" id="SelectTemplates" aria-label="Multiple select example">
                                                        
                                                    </select>
                                                </div>
                                                <div class="mb-3 ">
                                                    <label for="time-selection" class="form-label">Time Interval (to avoid being banned)</label>
                                                    <p> <span>from</span> <input type="number" min="0" id="from" value="5"> <span>To</span> <input type="number" id="to"  min="0" value="10"> <span>Second</span> </p>
                                                </div>
                                            </div>
                                            <div class="tab-pane text-start fade" id="navs-top-message" role="tabpanel">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label class="form-label d-block">Type</label>
                                                        <div class="form-check form-check-inline mt-3">
                                                            <input class="form-check-input " type="checkbox" id="message-box" value="option1" checked>
                                                            <label class="form-check-label" for="message-box">Text</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="video-box" value="option2" disabled="">
                                                            <label class="form-check-label" for="video-box">Video</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input file-box" type="checkbox"  value="option3">
                                                            <label class="form-check-label" for="file-box">File</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="vacrds-box" value="option4" disabled="">
                                                            <label class="form-check-label" for="vcards-box">vCards</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="row row-file d-none" >
                                                    <div class="col mb-3">
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="TempAudio" aria-label="Upload">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control" id="TempMessage" rows="3"></textarea>
                                                </div>

                                                <div class="form-check form-check-inline mb-3">
                                                    <input class="form-check-input " type="checkbox" id="SaveAsTemplate" value="option1">
                                                    <label class="form-check-label" for="SaveAsTemplate">Save as template</label>
                                                </div>
                                                <div class="SaveReply d-none">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input class="form-control" id="TempTitle">
                                                    </div>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input " type="checkbox" id="quickReply" value="option1" >
                                                        <label class="form-check-label" for="quickReply">Save as quick reply</label>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="SendToGroup" class="btn btn-primary">Send</button>
                        </div>
                        <!-- <div class="modal-footer mt-3 mb-3">
                            <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                            
                        </div> -->
                        </div>
                    </div>
                </div>
            <!-- End modal--send -->

            <!-- modal new message -->
            <div class="modal fade" id="saveTemplate" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                    <h5 class="modal-title" id="TemplateTitle">New Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="TempTitle" class="form-control" placeholder="Enter Template Title">
                            </div>
                        </div>
                        <input type="hidden" id="TempId">

                        <div class="row">
                
                            <div class="col mb-3">
                                <label class="form-label d-block">Types</label>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input " type="checkbox" id="message-box" value="option1" checked>
                                    <label class="form-check-label" for="message-box">Text</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="video-box" value="option3" disabled="">
                                    <label class="form-check-label" for="video-box">Video</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input file-box" type="checkbox"  value="option2">
                                    <label class="form-check-label" for="file-box">File</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="vacrds-box" value="option3" disabled="">
                                    <label class="form-check-label" for="vcards-box">vCards</label>
                                </div>
                            </div>
                            
                        </div> 
                    
                        <div class="row row-file d-none" >
                            <div class="col mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="TempAudio" aria-label="Upload">
                                </div>
                            </div>
                        </div>
                        <div class="row row-message" >
                            <div class="col mb-3" >
                                <label for="TempMessage" class="form-label">Message</label>
                                <div class="input-group">
                                    <textarea id="TempMessage" class="form-control" placeholder="Message" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input " type="checkbox" id="quickReply" value="option1" >
                            <label class="form-check-label" for="quickReply">Save as quick reply</label>
                        </div>
                    </div>
                    
                
                
                    <div class="modal-footer mt-3 mb-3">
                    <button type="button" class="btn btn-primary" id="AddTemplate">Save</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End modal new message -->

            <!-- modal--new group -->
                <div class="modal fade" id="CreateGroup" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header p-3">
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
                                <div class="divider-text">Enter Numbers</div>
                            </div>
                            <div>
                                <textarea class="form-control" id="recipients"  rows="3"></textarea>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" id="cleanNumbers" value="option1">
                                <label class="form-check-label" for="cleanNumbers">Check the correct numbers</label>
                            </div>
                            <div class="divider divider-danger">
                                <div class="divider-text">Wrong Numbers</div>
                            </div>
                            <div class="demo-inline-spacing mt-3" id="WrongNumbers">
                                <ul class="list-group">
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer mt-3 mb-3  ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add_broadcast">Add New</button>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- End modal--new group -->

            <!-- modal--new group -->
                <div class="modal fade" id="view-report" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header p-3">
                                <h5 class="modal-title" id="report_title"> Report Name</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="demo-inline-spacing mt-3">
                                    <ul class="list-group">
                                    <li class="list-group-item d-flex align-items-center" id="R-Date">
                                        <i class="bx bxs-calendar me-2"></i>
                                        <span></span>
                                        
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" id="R-GroupName">
                                        <i class="bx bxs-group me-2"></i>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" id="R-TemplateName">
                                        <i class="bx bxs-layout me-2"></i>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" id="R-message">
                                        <i class="bx bxs-message-rounded-dots me-2"></i>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" id="R-CountSender">
                                        <i class="bx bxs-timer me-2"></i>
                                        <span></span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" id="R-CountSeen">
                                        <i class="bx bxs-show me-2"></i>
                                        <span></span>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        
                            </div>
                        </div>
                </div>
            <!-- End modal--new group -->
            <!-- modal settings -->
            @include('plugins/whatsapp::partials._modal_settings')
            <!-- end modal settings -->
        <!-- End  Modals -->

        @stop

        






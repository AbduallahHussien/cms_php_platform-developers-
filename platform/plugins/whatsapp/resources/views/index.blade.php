
@extends('plugins/whatsapp::layout')

@section('page')

         <!-- container --> 
            <div class="container-fluid app ">

                
                                
                <!-- APP ROW -->
                    <div class="row app-one">

                    <!-- LEFT SIDES -->

                        <div class="col-xs-12 col-md-4 side">
                            <!-- SIDE ONE => CONTACTS -->
                                <div class="side-one">
                                    <div class="row heading">
                                        <div class="col-4  heading-avatar">
                                            <div class="heading-avatar-icon" id="profile_image" data-current_id="{{(isset($user['id']))?$user['id']:''}}">
                                                <img src="{{(isset($user['profile_picture']))?$user['profile_picture']:''}}">
                                            </div>
                                        </div>
                                        <div class="col-1 pull-right">
                                            <a href="{{route('dashboard.index')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#54656f" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        @if (Auth::user()->hasPermission('contacts.index'))
                                        <div class="col-1  heading-contacts  pull-right">
                                            <a href="{{route('whatsapp.contacts.index')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#54656f"class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        @endif
                                        @if (Auth::user()->hasPermission('whatsapp.settings'))
                                        <div class="col-1  heading-broadcast  pull-right">
                                            <a href="javascript:void(0);" id="configurations">
                                                <i style="color:#54656f;" class='menu-icon tf-icons bx bx-cog'></i>
                                            </a>
                                        </div>
                                        @endif
                                        
                                        @if (Auth::user()->hasPermission('whatsapp.send_to_group'))
                                        <div class="col-1  heading-Sendbroadcast  pull-right">
                                            <a type="button"  id="sendMessage" data-bs-toggle="modal" data-bs-target="#Send"><i class='bx bxs-send'></i></a>
                                        </div>
                                        @endif

                                        @if (Auth::user()->hasPermission('whatsapp.new_chat'))
                                        <div class="col-1  heading-NewChat  pull-right"><i class='bx bxs-message-rounded-add'></i></div>
                                        @endif
                                        
                                        @if (Auth::user()->hasPermission('whatsapp.templates'))
                                        <div class="col-1  heading-templates  pull-right"><i class='bx bxs-layout'></i></div>
                                        @endif

                                        @if (Auth::user()->hasPermission('whatsapp.groups'))
                                        <div class="col-1  heading-groups  pull-right"><i class='bx bx-group'></i></div>
                                        @endif   

                                        @if (Auth::user()->hasPermission('whatsapp.reports'))
                                        <div class="col-1  heading-reports  pull-right"><i class='bx bxs-report' ></i></div>
                                        @endif

                                        
                                    </div>

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
                                <div class="col-4 conversation-type">
                                    <button type="button" class="btn btn-success d-none" id="conversation-type" data-action="" data-chat_id="" data-chat_img="" data-chat_title="">Open Conversation</button>
                                </div>
                                <!-- END CONVERSATION TYPE -->
                            </div>
                            <!-- END CONVERSATION HEADING -->

                                <div class="col text-center d-none" id="view-more">
                                    <span class="view-more">
                                        view more 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                                        </svg>
                                    </span>
                                </div>
                            
                                <div class="row message" id="conversation" data-receiver_id="">  </div>
                            <!-- CONVERSATION FOOTER -->
                                <div class="row reply">
                                    <div class="col-1  reply-emojis">
                                        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#location">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#54656f" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-1  reply-emojis">
                                        <input type="file" id="imgupload" style="display:none"/> 
                                        <button id="OpenImgUpload"><svg viewBox="0 0 28 20" height="30" width="30" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 24 24" xml:space="preserve"><path fill="#54656f" d="M1.816,15.556v0.002c0,1.502,0.584,2.912,1.646,3.972s2.472,1.647,3.974,1.647 c1.501,0,2.91-0.584,3.972-1.645l9.547-9.548c0.769-0.768,1.147-1.767,1.058-2.817c-0.079-0.968-0.548-1.927-1.319-2.698 c-1.594-1.592-4.068-1.711-5.517-0.262l-7.916,7.915c-0.881,0.881-0.792,2.25,0.214,3.261c0.959,0.958,2.423,1.053,3.263,0.215 c0,0,3.817-3.818,5.511-5.512c0.28-0.28,0.267-0.722,0.053-0.936c-0.08-0.08-0.164-0.164-0.244-0.244 c-0.191-0.191-0.567-0.349-0.957,0.04c-1.699,1.699-5.506,5.506-5.506,5.506c-0.18,0.18-0.635,0.127-0.976-0.214 c-0.098-0.097-0.576-0.613-0.213-0.973l7.915-7.917c0.818-0.817,2.267-0.699,3.23,0.262c0.5,0.501,0.802,1.1,0.849,1.685 c0.051,0.573-0.156,1.111-0.589,1.543l-9.547,9.549c-0.756,0.757-1.761,1.171-2.829,1.171c-1.07,0-2.074-0.417-2.83-1.173 c-0.755-0.755-1.172-1.759-1.172-2.828l0,0c0-1.071,0.415-2.076,1.172-2.83c0,0,5.322-5.324,7.209-7.211 c0.157-0.157,0.264-0.579,0.028-0.814c-0.137-0.137-0.21-0.21-0.342-0.342c-0.2-0.2-0.553-0.263-0.834,0.018 c-1.895,1.895-7.205,7.207-7.205,7.207C2.4,12.645,1.816,14.056,1.816,15.556z"></path></svg>
                                        </button>
                                    </div>
                                    <div class="col-8  reply-main">
                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                    </div>
                                    <div class="col-2  reply-recording">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#54656f" class="bi bi-mic-fill" viewBox="0 0 16 16">
                                        <path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z"/>
                                        <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
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
            <!-- Modal Add new message -->

            <!-- Modal Location -->
                <div class="modal fade" id="location" tabindex="-1" role="dialog" aria-labelledby="locationLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header p-3">
                        <h5 class="modal-title" id="locationLabel">Select Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">   
                            <div id="map-canvas"></div>
                        </div>
                        <div class="modal-footer mt-3 mb-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
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

        






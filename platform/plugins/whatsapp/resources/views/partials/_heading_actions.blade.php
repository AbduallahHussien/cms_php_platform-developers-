<div class="row heading">
    <div class="col-4  heading-avatar">
        <div class="heading-avatar-icon" 
             id="profile_image" 
             data-current_id="{{(isset($user['id']))?$user['id']:''}}">

            @if(isset($user['profile_picture']) && !empty($user['profile_picture']))
                <img src="{{ $user['profile_picture'] }}">
            @else   
            <span class="default-avatar">
                <i class="fa fa-user-circle fa-3x text-muted"></i>
            </span> 
            @endif

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
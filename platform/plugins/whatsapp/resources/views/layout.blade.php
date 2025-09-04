<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title','Whatsapp')</title>

    <meta name="robots" content="noindex,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (setting('admin_logo') || config('core.base.general.logo'))
        <meta property="og:image" content="{{ setting('admin_logo') ? RvMedia::getImageUrl(setting('admin_logo')) : url(config('core.base.general.logo')) }}">
    @endif
    <meta name="description" content="{{ strip_tags(trans('core/base::layouts.copyright', ['year' => now()->format('Y'), 'company' => setting('admin_title', config('core.base.general.base_name')), 'version' => get_cms_version()])) }}">
    <meta property="og:description" content="{{ strip_tags(trans('core/base::layouts.copyright', ['year' => now()->format('Y'), 'company' => setting('admin_title', config('core.base.general.base_name')), 'version' => get_cms_version()])) }}">

    @if (setting('admin_favicon') || config('core.base.general.favicon'))
        <link rel="icon shortcut" href="{{ setting('admin_favicon') ? RvMedia::getImageUrl(setting('admin_favicon'), 'thumb') : url(config('core.base.general.favicon')) }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    {!! Assets::renderHeader(['core']) !!}

    @if (BaseHelper::adminLanguageDirection() == 'rtl')
        <link rel="stylesheet" href="{{ asset('vendor/core/core/base/css/rtl.css') }}">
    @endif

    @yield('head')

    @stack('header')
</head>
<body @if (BaseHelper::adminLanguageDirection() == 'rtl') dir="rtl" @endif class="@yield('body-class', 'page-sidebar-closed-hide-logo page-content-white page-container-bg-solid') {{ session()->get('sidebar-menu-toggle') ? 'page-sidebar-closed' : '' }}" style="@yield('body-style')">
    {!! apply_filters(BASE_FILTER_HEADER_LAYOUT_TEMPLATE, null) !!}

    @yield('page')

    @include('core/base::elements.common')

    {!! Assets::renderFooter() !!}
    
    <?php $sett = whatsapp_settings();?>
    @yield('javascript')


@php
    $whatsappToken = isset($sett[0]) ? $sett[0]->ultramsg_whatsapp_token : ''; 
    $instanceId = isset($sett[0]) ? $sett[0]->ultramsg_whatsapp_instance_id : ''; 
    $whatsappId = isset($sett[0]) ? $sett[0]->whatsapp_id : ''; 
@endphp

<script>
  var get_temp_route =    "{{route('whatsapp.get.templates')}}";
  var get_Grou_route =    "{{route('whatsapp.get.groups')}}";
  var get_SGrou_route =   "{{route('whatsapp.get.group')}}";
  var del_Grou_route =    "{{route('whatsapp.delete.group')}}";
  var get_rep_route =     "{{route('whatsapp.get.reports')}}";
  var get_Srep_route =    "{{route('whatsapp.get.report')}}";
  var send_audio_route =  "{{route('whatsapp.send.audio')}}";
  var view_more_route =   "{{route('whatsapp.view.more')}}";
  var send_voice_route =  "{{route('whatsapp.send.voice')}}";
  var send_img_route =    "{{route('whatsapp.send.image')}}";
  var get_con_route  =    "{{route('whatsapp.conversation.type')}}";
  var set_con_route  =    "{{route('whatsapp.set.conversation.type')}}";
  var get_chat_route =    "{{route('whatsapp.get.chat')}}";
  var GetConByType   =    "{{route('whatsapp.Get.conByType')}}";
  var add_template_route   =    "{{route('whatsapp.add.template')}}";
  var get_template_route   =    "{{route('whatsapp.get.template')}}";
  var edit_template_route   =    "{{route('whatsapp.edit.template')}}";
  var delete_template_route   =    "{{route('whatsapp.delete.template')}}";
  var Add_QuickReply_route   =    "{{route('whatsapp.add.QuickReply')}}";
  var add_broadcast_route   =    "{{route('whatsapp.add.broadcast')}}";
  var edit_broadcast_route   =    "{{route('whatsapp.edit.broadcast')}}";
  
  var send_group_route   =    "{{route('whatsapp.send.group.message')}}";
  var send_group_templates_route   =    "{{route('whatsapp.send.group.templtes')}}";
  //contacts route 
  var get_contacts_route  =    "{{route('whatsapp.get.contacts')}}";
  var get_contact_route  =    "{{route('whatsapp.get.contact')}}";
  var edit_contact_route  =    "{{route('whatsapp.edit.contact')}}";
  var delete_contact_route  =    "{{route('whatsapp.delete.contact')}}";

  var save_settings_route  =    "{{route('whatsapp.save.settings')}}";
  var save_chat_route  =    "{{route('whatsapp.save.chat')}}";

//   var token="{{($sett && $sett !='')? $sett[0]->ultramsg_whatsapp_token : ''}}";
//   var instance = "{{($sett && $sett !='')? $sett[0]->ultramsg_whatsapp_instance_id : '' }}";

//     instance = 'instance137692';
// token = 'm8b9c155gr43zwdk';
window.ultraMsgConfig = {
        token: @json($whatsappToken),
        instance: @json($instanceId),
        referenceId : @json(Auth::user()->id),
        whatsappId:@json($whatsappId)
};

// const token = 'instance137692';
// const instance = 'm8b9c155gr43zwdk';

</script>
    <div id="stack-footer">
        @stack('footer')
    </div>

    {!! apply_filters(BASE_FILTER_FOOTER_LAYOUT_TEMPLATE, null) !!}

    <script src="{{ asset('vendor/core/plugins/whatsapp/js/app.js') }}"></script>
</body>
</html>

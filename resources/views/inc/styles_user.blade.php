<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
<link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
@endif
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<link rel="stylesheet" href="{{asset('assets/css/global.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/user.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/kinoshita.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/users/swiper.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/users/all.min.css')}}">
<link rel="stylesheet" href="/plugins/loaders/custom-loader.css">
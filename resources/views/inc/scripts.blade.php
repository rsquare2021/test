<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/treeview/custom-jstree.js')}}"></script>


@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
<!-- <script src="{{asset('assets/js/app.js')}}"></script> -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<!-- <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script> -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="{{asset('assets/js/admin/common.js')}}"></script>
<script src="{{asset('assets/js/users/swiper.min.js')}}"></script>
<script src="{{asset('plugins/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="{{asset('assets/js/users/common.js')}}"></script>
<script src="{{asset('assets/js/users/snap.js')}}?01"></script>
<script src="{{asset('assets/js/users/jquery.matchHeight.js')}}"></script>
<script src="{{asset('assets/js/jquery.elevatezoom.min.js')}}"></script>

@endif
<!-- END GLOBAL MANDATORY SCRIPTS -->
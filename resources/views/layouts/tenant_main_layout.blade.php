
<!doctype html>

<html lang="{{ config('app.locale') }}" class="no-js">
<head>

    @include('admin.common.meta')

    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>



<body>

<div id="page-wrapper" class=" @if($result['template_settings'][1]->value == 'true') page-loading @endif">

    @include('admin.common.preloader')

        <!-- Page Container -->
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

            <!-- Alternative Sidebar -->
            @include('admin.common.alternative_sidebar')
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
             @include('admin.common.main_sidebar')
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">

                <!-- Header -->
                    @include('admin.common.header')
                 <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">


                    @yield('content')


                </div>
                <!-- END Page Content -->

                <!-- Footer -->

                @include('admin.common.footer')


                 <!-- END Footer -->

            </div>
            <!--END Main Container -->

        </div>
        <!-- END Page Container -->

</div>
<!-- END Page Wrapper -->


<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
@include('admin.common.modal_user_settings')
<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
@include('admin.common.template_scripts')
<!-- ./end of all vital js scripts -->

<!--  custom js -->
@yield('ext_js')
<!-- ./end of custom js scripts -->

<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
<script src="https://maps.googleapis.com/maps/api/js?key="></script>
<script src="{!! asset('public/tenant_template_assets/js/helpers/gmaps.min.js') !!}"></script>


<!-- Load and execute javascript code used only in this page -->
<script src="{!! asset('public/tenant_template_assets/js/pages/index.js') !!}"></script>
<script>$(function(){ Index.init(); });</script>

</body>

</html>



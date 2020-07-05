<!DOCTYPE html>
<html style="background-image: url('{{asset('').$result['template_settings'][2]->value}}')">

<!-- meta contains meta taga, css and fontawesome icons etc -->
@include('admin.common.meta_login')
<!-- ./end of meta -->

<body style="background-image: url('{{asset('').$result['template_settings'][2]->value}}')">

        <!-- dynamic content -->
        @yield('content');
        <!-- ./end of dynamic content -->

	<!-- all js scripts including custom js -->
	@include('admin.common.scripts_login')
    <!-- ./end of js scripts -->

	</body>
</html>

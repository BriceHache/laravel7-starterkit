

    <meta charset="utf-8">

    <title>
        @hasSection('template_title')
            @yield('template_title') |
        @endif
        {{ config('app.name', trans('admin.name')) }}
    </title>

    <meta name="description" content="Responsive Bootstrap Admin Template created by Brice Hache.">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{!! asset('public/tenant_template_assets/img/favicon.png') !!} ">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon57.png') !!} " sizes="57x57">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon72.png') !!} " sizes="72x72">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon76.png') !!} " sizes="76x76">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon114.png') !!} " sizes="114x114">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon120.png') !!} " sizes="120x120">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon144.png') !!} " sizes="144x144">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon152.png') !!} " sizes="152x152">
    <link rel="apple-touch-icon" href="{!! asset('public/tenant_template_assets/img/icon180.png') !!} " sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/bootstrap.min.css') !!} ">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/plugins.css') !!} ">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/main.css') !!} ">

    <!-- The custom stylesheet of this template. -->
    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/custom.css') !!} ">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
    {{-- 'night', 'amethyst', 'modern', 'autumn', 'flatie', 'spring', 'fancy', 'fire', 'coral', 'lake',
     'forest', 'waterlily', 'emerald', 'blackberry' or '' leave empty for the Default Blue theme--}}
    @if($result['template_settings'][0]->value != 'default')
        <link id="theme-link" rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/themes/'. $result['template_settings'][0]->value .'.css') !!} ">
    @endif

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/themes.css') !!} ">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="{!! asset('public/tenant_template_assets/js/vendor/modernizr.min.js') !!}"></script>



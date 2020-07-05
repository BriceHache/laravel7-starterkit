<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>  @hasSection('template_title')
          @yield('template_title') |
      @endif
      {{ config('app.name', trans('admin.name')) }}
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="BriceHache" content="http://africansolutionslab.com">

   {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
    <link href="{!! asset('public/login_assets/css/bootstrap.min.css') !!} " rel="stylesheet" id="bootstrap-css">

    {{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
    <script src="{!! asset('public/login_assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('public/login_assets/js/jquery.min.js') !!}"></script>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}


    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

   {{-- <link href="{!! asset('public/login_assets/css/all.css') !!}">--}}

    <link rel="stylesheet" href="{!! asset('public/tenant_template_assets/css/themes.css') !!} ">

    <!-- custom styles -->
  <link href="{!! asset('public/login_assets/css/style_login.css') !!}" media="all" rel="stylesheet" type="text/css" />

</head>

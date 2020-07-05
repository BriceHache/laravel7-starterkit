@extends('layouts.tenant_main_layout')
@section('content')
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
     @include('dashboards.tenant.tenant_dashboard_header')
    <!-- END Dashboard Header -->

    <!-- Mini Top Stats Row -->
    @include('dashboards.tenant.tenant_dashboard_top_stats')
    <!-- END Mini Top Stats Row -->
@endsection

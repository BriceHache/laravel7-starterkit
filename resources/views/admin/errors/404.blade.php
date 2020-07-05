@extends('admin.layouts.layoutErrorPage')

@section('template_title')
    {{ __('error.name_404') }}
@endsection
@section('content')

    <div class="error-options">
        <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="page_ready_search_results.html">{{ __('error.GoBack') }}</a></h3>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h1 class="animation-pulse"><i class="fa fa-exclamation-circle text-warning"></i> {{ __('error.error_404') }}</h1>
            <h2 class="h3">{{ __('error.notFound404') }}<br> {{ __('error.wewillsee') }} </h2>
        </div>
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <form action="page_ready_search_results.html" method="post">
                <input type="text" id="search-term" name="search-term" class="form-control input-lg" placeholder="{{ __('error.search_404') }}">
            </form>
        </div>
    </div>

@endsection

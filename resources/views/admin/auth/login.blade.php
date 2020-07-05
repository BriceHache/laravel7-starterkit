@extends('admin.layouts.layoutLlogin')

@section('template_title')
    {{ __('auth.loginprocess') }}
@endsection

@section('content')

<div class="container h-100">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span class="logo_title mt-5"><b>
                    @if(!empty($result['template_settings'][3]->value) and $result['template_settings'][3]->value != null)
                        {{str_replace('\\', "", $result['template_settings'][3]->value) }}
                    @else
                        {{ trans('auth.welcome_message') }}</b>{{ trans('auth.welcome_message_to')  }}
                    @endif

            </span>
        </div>
    </div>
   {{-- <div class="row my-3">
        <div class="col-12 mx-auto">
            <div id="notific">
                @include('admin.common.notifications')
            </div>
        </div>
    </div>--}}
    <div class="d-flex justify-content-center h-100" style="margin-top: -60px;">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="{{asset('/resources/assets/images/logos/logo_type.png')}}" class="brand_logo" alt="Logo">
                </div>
            </div>
            <!-- if email or password are not correct -->
            @if( count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert" id="flash-alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">{{ trans('auth.Error') }}:</span>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if(Session::has('loginError'))
                <div class="alert alert-danger" role="alert" id="flash-alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">{{ trans('auth.Error') }}:</span>
                    {!! session('loginError') !!}
                </div>
            @endif

            <div class="d-flex justify-content-center form_container">
                {!! Form::open(array('route' =>'signin', 'method'=>'post', 'class'=>'form-validate','id'=>'login_form')) !!}
                {{ csrf_field() }}

               {{-- <p class="login-box-msg" style="color: #003cb1; font-size: 15px;">{{ trans('auth.login_text') }}</p>--}}
                <p class="login-box-msg themed-color-dark-{{$result['template_settings'][0]->value}}" style="font-size: 15px;">{{ trans('auth.login_text') }}</p>

                    <div class="input-group mb-3 form-group">
                        <div class="input-group-append">
                            <span class="input-group-text themed-background-dark-{{$result['template_settings'][0]->value}}"><i class="fas fa-user"></i></span>
                        </div>
                        {!! Form::email('email', old('email'), array('class'=>'form-control email-validate', 'id'=>'email', 'style' => 'width:auto')) !!}

                        <div class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('auth.AdminEmailText') }}</div>
                        <div class="help-block hidden"> {{ trans('auth.AdminEmailText') }}</div>
                    </div>

                    <div class="input-group mb-2 form-group">
                        <div class="input-group-append">
                            <span class="input-group-text themed-background-dark-{{$result['template_settings'][0]->value}}"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name='password' class="form-control field-validate" value="" style="width: auto;">

                        <div class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                            {{ trans('auth.AdminPasswordText') }}</div>
                        <div class="help-block hidden">{{ trans('auth.textRequiredFieldMessage') }}</div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="remember-me" id="remember-me" value="remember-me"
                                   class="square-blue" />
                           {{__('auth.rememberMe')}}
                        </label>
                    </div>


                    <div class="d-flex justify-content-center mt-3 login_container">

                        <button id="login" class="btn login_btn themed-background-dark-{{$result['template_settings'][0]->value}}">{{trans('auth.login')}}</button>

                        {{--{!! Form::submit(trans('auth.login'), array('id'=>'login', 'class'=>'btn login_btn' )) !!}--}}
                    </div>

                {!! Form::close() !!}
            </div>

          {{-- <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    {{__('auth.noaccount')}} <a href="#" class="ml-2">{{__('auth.SignUp')}}</a>
                </div>
                <div class="d-flex justify-content-center links">
                    <a href="#">{{ __('auth.Forgot Password')  }}</a>
                </div>
            </div>--}}
        </div>
    </div>
</div>

@endsection

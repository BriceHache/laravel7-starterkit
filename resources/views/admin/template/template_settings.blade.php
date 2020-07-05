@extends('layouts.tenant_main_layout')

@section('template_title')
    {{ __('admin.template_settings_page') }}
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-12 mx-auto">
            <div id="notific">
                @include('admin.common.notifications')
            </div>
        </div>
    </div>

    {!! Form::open(array('url' =>'admin/template_settings', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
    <div class="content-header">
        <div class="header-section" style="display: block ruby;" >
            <h2 class="themed-border-{{$result['template_settings'][0]->value}}" >
                <i class="gi gi-settings"></i> &nbsp;<strong>{{ __('admin.template_settings_page') }}</strong>
            </h2>

            <button type="submit"  class="btn btn-success mt15"
                    style="float: right;">
                    {{--style="background-color: #1bbae1; float: right;">--}}
                <i class="fa fa-save"></i> {{ __('admin.update') }}
            </button>
        </div>
    </div>

    <!-- Template settings -->
    <div class="block">
        <!-- Tabs settings -->
        <div class="block-title">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#general-tab">{{ __('admin.general') }}</a></li>
                <li><a href="#color-tab">{{ __('admin.colors') }}</a></li>

            </ul>
        </div>
        <!-- END Tabs settings -->

        <!-- General Content -->
        <div class="tab-content">
            <!-- General Content -->
            <div class="tab-pane active" id="general-tab">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Basic Form Elements Block -->
                        <div class="block">
                            <!-- Basic Form Elements Title -->
                            <div class="block-title">
                               {{-- <div class="block-options pull-right">
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                                </div>--}}
                                <h2><strong>{{__('template_settings.auth_page')}}</strong></h2>
                            </div>
                            <!-- END Form Elements Title -->

                            <!-- Basic Form Elements Content -->


                                <div class="form-group">
                                    <label class="col-md-3 control-label pl-0" for="example-text-input">{{__('template_settings.welcome_message')}}</label>
                                    <div class="col-md-9">
                                        <input type="text" id="example-text-input" name="{{$result['template_settings'][3]->name}}" class="form-control" value="{{str_replace('\\', "", $result['template_settings'][3]->value)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label pl-0" style="padding-left: 0" for="example-file-input">{{__('template_settings.background_login_image')}}</label>
                                    <div class="col-md-9">
                                        {!! Form::file($result['template_settings'][2]->name, array('id'=> $result['template_settings'][2]->name)) !!}<br>

                                        {!! Form::hidden('oldImage_login_image',  $result['template_settings'][2]->value , array('id'=>$result['template_settings'][2]->name)) !!}
                                        <img src="{{asset('').$result['template_settings'][2]->value}}" alt="" width=" 100px">
                                    </div>
                                </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label pl-0" style="padding-left: 0">{{__('template_settings.prelaoder')}}</label>
                                <div class="col-md-9">
                                    <div class="radio">
                                        <label for="example-radio1">
                                            <input type="radio" id="example-radio1" name="{{$result['template_settings'][1]->name}}" value="false" @if($result['template_settings'][1]->value=="false") checked @endif> Non
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="example-radio2">
                                            <input type="radio" id="example-radio2" name="{{$result['template_settings'][1]->name}}" value="true" @if($result['template_settings'][1]->value=="true") checked @endif>Oui
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <!-- END Basic Form Elements Content -->
                        </div>
                        <!-- END Basic Form Elements Block -->
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

            </div>
            <!-- END General Content -->

            <!-- Colors Content -->
            <div class="tab-pane" id="color-tab">

                <div class="panel-body">
                    <div class="row">
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="default" @if($result['template_settings'][0]->value  == 'default') checked @endif>
                                <span class="color-control-box" style="background:#394263;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="night" @if($result['template_settings'][0]->value  == 'night') checked @endif>
                                <span class="color-control-box" style="background:#333333;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="amethyst" @if($result['template_settings'][0]->value  == 'amethyst') checked @endif>
                                <span class="color-control-box" style="background:#583a63;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="modern" @if($result['template_settings'][0]->value  == 'modern') checked @endif>
                                <span class="color-control-box" style="background:#3b3f40;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="autumn" @if($result['template_settings'][0]->value  == 'autumn') checked @endif>
                                <span class="color-control-box" style="background:#4a392b;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="flatie" @if($result['template_settings'][0]->value  == 'flatie') checked @endif>
                                <span class="color-control-box" style="background:#32323a;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="spring" @if($result['template_settings'][0]->value  == 'spring') checked @endif>
                                <span class="color-control-box" style="background:#344a3d;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio"name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="fancy" @if($result['template_settings'][0]->value  == 'fancy') checked @endif>
                                <span class="color-control-box" style="background:#352b4e;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="fire" @if($result['template_settings'][0]->value  == 'fire') checked @endif>
                                <span class="color-control-box" style="background:#4a2e2b;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio"name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="coral" @if($result['template_settings'][0]->value  == 'coral') checked @endif>
                                <span class="color-control-box" style="background:#3c3e4f;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="lake" @if($result['template_settings'][0]->value  == 'lake') checked @endif>
                                <span class="color-control-box" style="background:#043e50;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="forest" @if($result['template_settings'][0]->value  == 'forest') checked @endif>
                                <span class="color-control-box" style="background:#3b322c;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="waterlily" @if($result['template_settings'][0]->value  == 'waterlily') checked @endif>
                                <span class="color-control-box" style="background:#4f243e;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="emerald" @if($result['template_settings'][0]->value  == 'emerald') checked @endif>
                                <span class="color-control-box" style="background:#07313a;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="{{$result['template_settings'][0]->name}}" class="color-control-input" value="blackberry" @if($result['template_settings'][0]->value  == 'blackberry') checked @endif>
                                <span class="color-control-box" style="background:#352738;"></span>
                            </label>
                        </div>

                    </div>
                </div>

            </div>
            <!-- END Colors Content -->

        </div>
        <!-- END Tabs settings -->
    </div>
    <!-- END Template settings -->
    {!! Form::close() !!}
@endsection


@section('ext_js')

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setTimeout(function() {
                $('#notific').remove();
            }, 5000);

        });
    </script>
@endsection

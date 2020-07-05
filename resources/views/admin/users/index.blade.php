@extends('layouts.tenant_main_layout')

@section('template_title')
    {{ __('admin.users') }}
@endsection

@section('header_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/datatables/css/dataTables.bootstrap4.css') }}" />
    <link href="{{ asset('public/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-12 mx-auto">
            <div id="notific">
                @include('admin.common.notifications')
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="header-section" style="display: block ruby;" >
            <h2 class="themed-border-{{$result['template_settings'][0]->value}}" >
                <i class="fa fa-users"></i> &nbsp;<strong>{{ __('admin.users') }}</strong>
            </h2>
            <ol class="breadcrumb" style="float:right;">
                <li>
                    <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
                        <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                        {{__('admin.Dashboard')}}
                    </a>
                </li>
                <li class="active">{{ __('admin.users') }}</li>
            </ol>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row text-center">
        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-dark-{{$result['template_settings'][0]->value}}">
                    <h4 class="widget-content-light"><strong>Total</strong> {{ __('admin.users') }}</h4>
                </div>
                <div class="widget-extra-full"><span class="h2 themed-color-dark animation-expandOpen">{{$result['totalUsers']}}</span></div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-3">

        </div>

        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra bg-primary">
                    <h4 class="widget-content-light"><strong> {{ __('admin.BulkImport') }}</strong>{{ __('admin.Bulk') }}</h4>
                </div>
                <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen"><i class="fa fa-file-excel-o"></i></span></div>
            </a>

        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ URL::to('admin/users/create') }}" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-success">
                    <h4 class="widget-content-light"><strong>{{__('admin.AddNew')}}</strong>{{__('admin.AUser')}} </h4>
                </div>
                <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen"><i class="fa fa-plus"></i></span></div>
            </a>
        </div>
    </div>
    <!-- END Quick Stats -->
    <!-- Main content -->
    <section class="content pl-3 pr-3">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        {{--<h4 class="card-title my-2 float-left"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Users List
                        </h4>
                        <a href="{{ URL('admin/bulk_import_users') }}" class="float-right btn btn-success import_btn">
                            <i class="fa fa-plus fa-fw"></i>Bulk Import</a>--}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered width100" id="table">
                                <thead>
                                <tr class="filters">
                                    <th class="hidden-xs text-center">ID</th>
                                    <th class="text-center">First Name</th>
                                    <th class="hidden-xs text-center">Last Name</th>
                                    <th class="hidden-xs text-center">User E-mail</th>
                                    <th class="hidden-xs text-center">Status</th>
                                    <th class="hidden-xs text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row-->
    </section>


   {{-- <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Aller au début"
       data-toggle="tooltip" data-placement="left">
        <i class="fa fa-arrow-up" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>

    </a>--}}

@endsection

@section('ext_js')

    <script type="text/javascript" src="{{ asset('public/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                             processing: "Traitement..."
                },
                ajax: '{!! route('admin.users.data') !!}',
                columns: [
                    { data: 'id', name: 'id', className: "dt-head-center" },
                    { data: 'first_name', name: 'first_name', className: "dt-head-center" },
                    { data: 'last_name', name: 'last_name', className: "dt-head-center" },
                    { data: 'email', name: 'email', className: "dt-head-center" },
                    { data: 'status', name: 'status', className: "dt-head-center"},
                    { data: 'created_at', name:'created_at', className: "dt-head-center"},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: "dt-head-center" }
                ],


            });
            /*table.on( 'draw', function () {
                $('.livicon').each(function(){
                    $(this).updateLivicon();
                });
            } );*/
        });

    </script>
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this User? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->

    <script>
        $(function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
        var $url_path = '{!! url('/') !!}';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var $recipient = button.data('id');
            var modal = $(this)
            modal.find('.modal-footer a').prop("href",$url_path+"/admin/users/"+$recipient+"/delete");
        });

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


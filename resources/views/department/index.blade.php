@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('department.index') }}">{{ getTranslation('department') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Departments Lists</h2>
                    <a href="{{ route('department.create') }}" class="btn btn-danger pull-right">Create</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                            <tr id="content_{{ $department->id }}">
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->code }}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td style="width:150px;" class="col-md-3 col-xs-12" >Address</td>
                                                <td style="width:150px;" class="col-md-3 col-xs-12" >Post nr.</td>
                                                <td style="width:150px;" class="col-md-3 col-xs-12" >By</td>
                                                <td style="width:150px;" class="col-md-3 col-xs-12" >Build Year</td>
                                                <td style="width:150px;" class="col-md-3 col-xs-12" >Etageareal</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($department->addresses) > 0)
                                            @foreach($department->addresses as $address)
                                                <tr style="margin-bottom: 35px;" class="addresses">
                                                    <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->address}}</td>
                                                    <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->zip_code}}</td>
                                                    <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->city}}</td>
                                                    <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->build_year}}</td>
                                                    <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->m2}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>


                                    </table>
                                </td>
                                <td>
                                    <a href="{{ route('department.edit', ['id'=> $department->id]) }}" class="btn btn-success">Edit</a>
                                    <button data-id="{{ $department->id }}" data-url="{{ route('department.delete', ['id'=> $department->id]) }}" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }} " rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }} "></script>
@endsection
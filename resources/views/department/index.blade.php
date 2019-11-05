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
                    <a href="{{ route('department.create') }}" class="btn btn-danger pull-right">Opret</a>
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
                    <form action="{{ route('department.index') }}" method="GET">
                        <div class="row">
                            <div class="form-group form-group-sm col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <label for="customer_id">
                                            {{ getTranslation('customer') }}
                                        </label>
                                        <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_customer') }}</option>
                                            @foreach($customers as $aCustomer)
                                                <option value="{{ $aCustomer->id }}" {{ ($search && isset($search['customer_id']) && $search['customer_id'] == $aCustomer->id) ? 'selected="selected"' : '' }}>{{ $aCustomer->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group form-group-sm ">
                                            <label for="customer_id">
                                                &nbsp;
                                            </label>
                                            <div class="">
                                                <button class="btn btn-danger" type="submit">{{ getTranslation('submit') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    $departmentsArray = [];
                    if($search && isset($search['customer_id']) && count($departments) > 0) {
                        foreach ($departments as $department) {
                            $departmentsArray[$department->id][] = $department;
                        }
                    }
                    ?>
                    <table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ getTranslation('department') }}</th>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Address</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Post nr.</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >By</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Byggeår</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Etageareal</td>
                            <th>{{ getTranslation('action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($departmentsArray) == 0)
                            @foreach($departments as $department)
                                @foreach($department->addresses as $key => $address)
                                    <tr id="content_{{ $department->id }}">
                                        <td data-order="{{ intval($department->name) }}">{{ $department->name }}</td>
                                        <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->address}}</td>
                                        <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->zip_code}}</td>
                                        <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->city}}</td>
                                        <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->build_year}}</td>
                                        <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->m2}}</td>
                                        <td>
                                            <a href="{{ route('department.edit', ['id'=> $department->id]) }}" class="btn btn-success">Redigere</a>
                                            <button data-id="{{ $department->id }}" data-url="{{ route('department.delete', ['id'=> $department->id]) }}" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            @foreach($departmentsArray as $departmentsA)
                                @foreach($departmentsA as $key1 => $department)
                                    @foreach($department->addresses as $key => $address)
                                        <tr id="content_{{ $address->id }}"  style="{{ ($key1 == 0 && $key == 0) ? '' : 'display:none' }}" class="{{ ($key1 == 0 && $key == 0) ? '' : 'toggle-class-'.$department->id }}">
                                            <td data-order="{{ intval($department->name) }}">
                                                {!! ($key1 == 0 && $key == 0) ? $department->name : '' !!}
                                                {!! ($key1 == 0 && $key == 0 && count($department->addresses) > 1) ? '<br /><br /><i style="cursor:pointer;color: #0275d8;" class="show_more down icon-my pull-right" data-what-to-do="down" data-department-id="'.$department->id.'">': '' !!}
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->address}}</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->zip_code}}</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->city}}</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->build_year}}</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >{{ $address->m2}}</td>
                                            <td>
                                                <a href="{{ route('department.edit', ['id'=> $department->id]) }}" class="btn btn-success">Redigere</a>
                                                <button data-id="{{ $department->id }}" data-url="{{ route('department.delete', ['id'=> $department->id]) }}" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
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
    <style>
        .show {
            display: block;
        }

        .hide {
            display: none;
        }
        .up {
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }

        .down {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }
        .icon-my {
            border: solid black;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
        }
    </style>
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
    <script src="{{ asset('/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            $('.show_more').on('click', function () {
                var whatToDO = $(this).attr('data-what-to-do');
                var departmentId = $(this).attr('data-department-id');

                if(whatToDO == 'down') {
                    $(this).attr('data-what-to-do', 'up');
                    $(".toggle-class-"+departmentId).show();
                    $(this).removeClass('down').addClass('up');
                    //$(this).html('Hide');
                } else {
                    $(this).attr('data-what-to-do', 'down');
                    $(".toggle-class-"+departmentId).hide();
                    $(this).removeClass('up').addClass('down');
                }


            });
            $('#datatable1').dataTable(
                {
                    searching: false,
                    paging: false
                }
            );
        });
    </script>
@endsection
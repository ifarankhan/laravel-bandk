@extends('layouts.app-admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Claims Lists</h2>
                    {{--<a href="{{ route('claim.create') }}" class="btn btn-danger pull-right">Create</a>--}}
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                        <form action="{{ route('claim.index') }}" method="GET">
                             <div class="row">
                                <div class="form-group form-group-sm">
                                    <div class="col-md-4 col-lg-4">
                                        <label for="claim_type_id">
                                            {{ getTranslation('claim_type') }}
                                        </label>
                                        <select id="claim_type_id" class="form-control" name="search[claim_type_id]" data-actions-box="true" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_claim_type') }}</option>
                                            @foreach($claimTypes as $claimType)
                                                <option value="{{ $claimType->id }}" {{ ($search && $search['claim_type_id'] && $search['claim_type_id'] == $claimType->id) ? 'selected="selected"' : '' }}>{{ $claimType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label for="type_of_document">
                                            {{ getTranslation('date') }}
                                        </label>
                                        <div class="input-group date" id="date">
                                            <input type="text" class="form-control" name="search[date]" id="date" value="{{ ($search && $search['date']) ? $search['date'] : ''}}">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label for="department_id">
                                            {{ getTranslation('department') }}
                                        </label>
                                        <select id="department_id" class="form-control" name="search[department_id]" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_department') }}</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ ($search && $search['department_id'] && $search['department_id'] == $department->id) ? 'selected="selected"' : '' }}>{{ $department->name }} ({{ $department->code }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                             </div>
                            <div class="row">
                                <div class="form-group form-group-sm">
                                    <div class="col-md-4 col-lg-4">
                                        <button class="btn btn-danger" type="submit">{{ getTranslation('submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <br />
                    <br />
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ getTranslation('claim_created_at') }}</th>
                            <th>{{ getTranslation('date') }}</th>
                            <th>{{ getTranslation('claim_type') }}</th>
                            <th>{{ getTranslation('estimate') }}</th>
                            <th>{{ getTranslation('department') }}</th>
                            <th>{{ getTranslation('address_1') }}</th>
                            <th>{{ getTranslation('address_2') }}</th>
                            <th>{{ getTranslation('actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($claims as $claim)
                            <tr>
                                <td>{{ $claim->created_at }}</td>
                                <td>{{ $claim->date }}</td>
                                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                                <td>{{ $claim->estimate }}</td>
                                <td>{{ ($claim->department) ? $claim->department->name.'('.$claim->department->code.')' : ''}}</td>
                                <td>{{ ($claim->address1)  ? $claim->address1->address : ''}}</td>
                                <td>{{ ($claim->address2)  ? $claim->address2->address : ''}}</td>
                                <td>
                                    <a href="{{ route('claim.details', ['id'=> $claim->id]) }}" class="btn btn-success">{{ getTranslation('details') }}</a>
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
    <link href="{{ asset('/admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
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
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
@endsection
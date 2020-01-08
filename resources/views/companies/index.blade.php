@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('company.index') }}">{{ getTranslation('companies') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Company Lists</h2>
                    <a href="{{ route('company.create') }}" class="btn btn-danger pull-right">Opret</a>
                    <div class="clearfix"></div>
                </div>
                <form action="{{ route('company.index') }}" method="GET">
                    <div class="row">
                        <div class="form-group form-group-sm col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="customer_id">
                                        {{ getTranslation('customer') }}
                                    </label>
                                    <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                        <option value="">{{ getTranslation('select_customer') }}</option>
                                        @foreach($allCustomers as $aCustomer)
                                            <option value="{{ $aCustomer->id }}" {{ (session('customer_id') && session('customer_id') == $aCustomer->id) ? 'selected="selected"' : '' }}>{{ $aCustomer->name }}</option>
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
                                            <a class="btn btn-success" href="{{ route('reset.url') }}">{{ getTranslation('reset') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="x_content">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!}  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ getTranslation('customer_name') }}</th>
                            <th>{{ getTranslation('customer') }}</th>
                            <th>{{ getTranslation('customer_address') }}</th>
                            <th>{{ getTranslation('customer_city') }}</th>
                            <th>{{ getTranslation('customer_zip_code') }}</th>
                            {{--<th>{{ getTranslation('customer_contact_person') }}</th>
                            <th>{{ getTranslation('customer_bank_number') }}</th>
                            <th>{{ getTranslation('customer_account_number') }}</th>
                            <th>{{ getTranslation('customer_insurance_company_name') }}</th>
                            <th>{{ getTranslation('customer_policy_number') }}</th>
                            <th>{{ getTranslation('customer_emails') }}</th>--}}
                            <th width="20%">{{ getTranslation('actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr id="content_{{ $company->id }}">
                                <td>{{ $company->name }}</td>
                                <td>{{ ($company->customer) ? $company->customer->name : '' }}</td>
                                <td>{{ ($company->address) ? $company->address :  ''}}</td>
                                <td>{{ ($company->city) ? $company->city :  ''}}</td>
                                <td>{{ ($company->zip_code) ? $company->zip_code :  ''}}</td>
                                {{--<td>{{ ($company->contact_person) ? $company->contact_person :  ''}}</td>
                                <td>{{ ($company->bank_number) ? $company->bank_number :  ''}}</td>
                                <td>{{ ($company->account_number) ? $company->account_number :  ''}}</td>
                                <td>{{ ($company->insurance_company_name) ? $company->insurance_company_name :  ''}}</td>
                                <td>{{ ($company->policy_number) ? $company->policy_number :  ''}}</td>
                                <td>{!! ($company->emails) ? implode('<br />', json_decode($company->emails, true)) :  '' !!}</td>--}}
                                <td>
                                    {{--<a href="{{ route('company.details', ['id'=> $company->id]) }}" class="btn btn-info btn-xs">{!! getTranslation('details')  !!} </a>--}}
                                    <a href="{{ route('company.edit', ['id'=> $company->id]) }}" class="btn btn-success btn-xs">{!! getTranslation('edit') !!}</a>
                                    {{--<button data-id="{{ $company->id }}" data-url="{{ route('company.delete', ['id'=> $company->id]) }}" class="btn btn-danger delete btn-xs" data-toggle="modal" data-target="#modal-delete">{!! getTranslation('delete') !!}</button>--}}
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
    <style>
        table {
            table-layout: fixed;
            overflow-x: hidden;
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
@endsection
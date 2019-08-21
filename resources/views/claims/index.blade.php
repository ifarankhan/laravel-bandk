@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        @if(!in_array('AGENT', getUserRoles(\Auth::user())))
            <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        @endif
        <li><a href="{{ route('claim.index') }}">{{ getTranslation('claims') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Claims Lists</h2>
                    <a href="{{ route('claim.create') }}" class="btn btn-danger pull-right">Opret</a>
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
                    @if(in_array('AGENT', getUserRoles(\Auth::user())) && \Auth::user()->customer)
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="mt-element-ribbon bg-grey-steel">
                                    <table class="table table-responsive table-noborder">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_name') }}:</strong></div>
                                                <div class="col-md-6"> {{ \Auth::user()->customer->name }}</div>
                                            </td>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_contact_person') }}:</strong></div>
                                                <div class="col-md-6">{{ \Auth::user()->customer->contact_person }}</div>
                                            </td>
                                            <td>
                                                <div class="col-md-6"><strong>Selskab:</strong></div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer) ? \Auth::user()->customer->insurance_company_name : '' }}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('address_1') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer->address)  ? \Auth::user()->customer->address : ''}}</div>
                                                </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_policy_number') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer)  ? \Auth::user()->customer->policy_number : ''}}</div>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_zip_code') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer)  ? \Auth::user()->customer->zip_code : ''}}</div>
                                                </td>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_emails') }}:</strong> </div>
                                                <div class="col-md-6">{!!  (\Auth::user()->customer && \Auth::user()->customer->emails)  ? implode('<br /> ', json_decode(\Auth::user()->customer->emails, true)) : ''!!}</div>
                                                </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_city') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer) ? \Auth::user()->customer->city : '' }}</div>
                                                </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_bank_number') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer) ? \Auth::user()->customer->bank_number : '' }}</div>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="col-md-6"><strong>{{ getTranslation('customer_account_number') }}:</strong> </div>
                                                <div class="col-md-6">{{ (\Auth::user()->customer) ? \Auth::user()->customer->account_number : '' }}</div>
                                                </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    {{--<div class="row ribbon-content">

                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_name') }}:</strong> {{ \Auth::user()->customer->name }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_contact_person') }}:</strong> {{ \Auth::user()->customer->contact_person }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_insurance_company_name') }}:</strong> {{ \Auth::user()->customer->insurance_company_name }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('address_1') }}:</strong> {{ (\Auth::user()->customer->address)  ? \Auth::user()->customer->address : ''}}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_emails') }}:</strong> {{ (\Auth::user()->customer && \Auth::user()->customer->email)  ? implode(', ', json_decode(\Auth::user()->customer->email, true)) : ''}}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_policy_number') }}:</strong> {{ (\Auth::user()->customer)  ? \Auth::user()->customer->policy_number : ''}}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_zip_code') }}:</strong> {{ (\Auth::user()->customer)  ? \Auth::user()->customer->zip_code : ''}}
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_city') }}:</strong> {{ (\Auth::user()->customer) ? \Auth::user()->customer->city : '' }}
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_bank_number') }}:</strong> {{ (\Auth::user()->customer) ? \Auth::user()->customer->bank_number : '' }}
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">
                                            <strong>{{ getTranslation('customer_account_number') }}:</strong> {{ (\Auth::user()->customer) ? \Auth::user()->customer->account_number : '' }}
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('claim.index') }}" method="GET">
                         <div class="row">
                            <div class="form-group form-group-sm col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <label for="claim_type_id">
                                            {{ getTranslation('claim_type') }}
                                        </label>
                                        <select id="claim_type_id" class="form-control" name="search[claim_type_id]" data-actions-box="true" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_claim_type') }}</option>
                                            @foreach($claimTypes as $claimType)
                                                <option value="{{ $claimType->id }}" {{ ($search && isset($search['claim_type_id'])&& $search['claim_type_id'] == $claimType->id) ? 'selected="selected"' : '' }}>{{ $claimType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label for="type_of_document">
                                            {{ getTranslation('claim_creation_date') }}
                                        </label>
                                        <div class="input-group date" id="date">
                                            <input type="text" class="form-control" name="search[date]" id="date" value="{{ ($search && isset($search['date'])) ? $search['date'] : ''}}">
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
                                                <option value="{{ $department->id }}" {{ ($search && isset($search['department_id']) && $search['department_id'] == $department->id) ? 'selected="selected"' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <label for="user_id">
                                            {{ getTranslation('users') }}
                                        </label>
                                        <select id="user_id" class="form-control" name="search[user_id]" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_users') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ ($search && isset($search['user_id']) && $search['user_id'] == $user->id) ? 'selected="selected"' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(!in_array('AGENT', getUserRoles(\Auth::user())))
                                        <div class="col-md-4 col-lg-4">
                                            <label for="customer_id">
                                                {{ getTranslation('customer') }}
                                            </label>
                                            <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                                <option value="">{{ getTranslation('select_customer') }}</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ ($search && isset($search['customer_id']) && $search['customer_id'] == $customer->id) ? 'selected="selected"' : '' }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

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
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ getTranslation('updated_at') }}</th>
                            <th>{{ getTranslation('customer_name') }}</th>
                            <th>{{ getTranslation('date') }}</th>
                            <th>Selskab skade nummer</th>
                            <th>{{ getTranslation('claim_type') }}</th>
                            <th>{{ getTranslation('department') }}</th>
                            <th>{{ getTranslation('address_1') }}</th>
                            <th>{{ getTranslation('address_2') }}</th>
                            <th>{{ getTranslation('actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($claims as $claim)
                            <tr class="alert alert-{{ getClaimColor($claim) }}">
                                <td data-sort="{{ date('Y-m-d', strtotime($claim->updated_at)) }}">{{ $claim->updated_at }}
                                    @if($claim->is_updated)
                                        <button class="btn btn-info">Opdateret</button>
                                     @endif
                                </td>
                                <td>{{ ($claim->customer && $claim->customer->name)  ? $claim->customer->name : ''}}</td>
                                <td data-sort="{{ date('Y-m-d', strtotime($claim->date)) }}">{{ $claim->date }}</td>
                                <td>{{ $claim->selsskab_skade_nummer }}</td>
                                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                                {{--<td data-claim-id="{{ $claim->id }}" data-csrf="{{ csrf_token() }}" data-url="{{ route('claim.detail.form') }}" class="estimate_value">{{ $claim->estimate }}</td>--}}
                                <td>{{ ($claim->department) ? $claim->department->name : ''}}</td>
                                <td>{{ ($claim->address1)  ? $claim->address1->address : ''}}</td>
                                <td>{{ ($claim->address_2)  ? $claim->address_2 : ''}}</td>
                                <td>
                                    <a href="{{ route('claim.details', ['id'=> $claim->id]) }}" class="btn btn-success btn-sm">{{ getTranslation('details') }}</a>
                                    <a href="{{ route('claim.edit', ['id'=> $claim->id]) }}" class="btn btn-info btn-sm">{{ getTranslation('edit') }}</a>
                                    {{--<button data-url="{{ route('claim.delete', ['id'=> $claim->id]) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">{{ getTranslation('delete') }}</button>--}}
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
    <style>
        table { table-layout:fixed; }
        hr.style-one {
            border: 0;
            height: 1px;
            background: #333;
            background-image: linear-gradient(to right, #ccc, #333, #ccc);
        }
        .help-block{
            color: #a94442;
        }
        .bg-grey-steel {
            background: #e9edef!important;
        }


        .mt-element-ribbon .ribbon {
            padding: .5em 1em;
            float: left;
            margin: 10px 0 0 -2px;
            clear: left;
            position: relative;
        }
        .mt-element-ribbon {
            position: relative;
            margin-bottom: 30px;
        }
        .mt-element-ribbon .ribbon.ribbon-clip {
            left: -10px;
            margin-left: 0;
        }
        .mt-element-ribbon .ribbon.ribbon-color-danger {
            background-color: #ed6b75;
            color: #fff;
        }
        .mt-element-ribbon .ribbon, .mt-element-ribbon .ribbon.ribbon-color-default, .mt-element-ribbon .ribbon.ribbon-color-default>.ribbon-sub, .mt-element-ribbon .ribbon>.ribbon-sub {
            background-color: #bac3d0;
            color: #384353;
        }
        .mt-element-ribbon .ribbon-content {
            margin: 0;
            padding: 25px;
            clear: both;
        }
        .mt-element-ribbon .ribbon, .mt-element-ribbon .ribbon.ribbon-color-default, .mt-element-ribbon .ribbon.ribbon-color-default>.ribbon-sub, .mt-element-ribbon .ribbon>.ribbon-sub {
            background-color: #bac3d0;
            color: #384353;
        }
        .mt-element-ribbon .ribbon.ribbon-border-hor:after {
            border-top: 1px solid;
            border-bottom: 1px solid;
            border-left: none;
            border-right: none;
            content: '';
            position: absolute;
            top: 5px;
            bottom: 5px;
            left: 0;
            right: 0;
            border-color: #e73d4a;
        }
        b, optgroup, strong {
            font-weight: 800;
        }
        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }


        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: black;
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        img {
            margin-bottom: -4px;
        }

        .caption-container {
            text-align: center;
            background-color: black;
            padding: 2px 16px;
            color: white;
        }

        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        img.hover-shadow {
            transition: 0.3s;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        input[type=file] {
            position: absolute;
            left: 10px;
            top: 0;
            opacity: 0;
            width: 100px;
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
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datatable').on( 'dblclick', 'tbody td.estimate_value', function (e) {
            var element = $(this);

            var claimId = element.attr('data-claim-id');

            var url = element.attr('data-url');
            var csrf = element.attr('data-csrf');
            var html = element.html().trim();

            var index = html.indexOf('<textarea type="text"');

            if(index === -1) {
                var input = '<textarea type="text" name="updated-value" class="form-control update-value-'+claimId+'" data-claim-id="'+claimId+'">'+html+'</textarea>';

                $(this).html(input);

                $(".update-value-"+claimId).on('blur', element, function (e) {
                    var updatedText = $(this).val();
                    var  data = {_token: csrf, id: claimId, estimate: updatedText};

                    if(updatedText != html && updatedText.trim() != '') {
                        sendAjax(url, data, 'POST',function (result) {
                        });
                    }

                    //updatedText = formatNumber(updatedText);
                    element.html(updatedText);

                });

                $(".update-value-"+claimId).on('change', element, function (event) {
                    console.log('hello')
                    var updatedText = $(this).val();
                    updatedText = formatNumber(updatedText);

                    $(this).val(updatedText);
                });
            }


        });


        function formatNumber(x) {
            x = x.replace('.', '');
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
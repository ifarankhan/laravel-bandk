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
                                        <label for="selsskab_skade_nummer">
                                            Selskab skade nummer
                                        </label>
                                        <input type="text" class="form-control" name="search[selsskab_skade_nummer]" id="selsskab_skade_nummer" value="{{ ($search && isset($search['selsskab_skade_nummer'])) ? $search['selsskab_skade_nummer'] : ''}}">
                                    </div>
                                    {{--<div class="col-md-4 col-lg-4">
                                        <label for="user_id">
                                            {{ getTranslation('users') }}
                                        </label>
                                        <select id="user_id" class="form-control" name="search[user_id]" tabindex="-1" aria-hidden="true">
                                            <option value="">{{ getTranslation('select_users') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ ($search && isset($search['user_id']) && $search['user_id'] == $user->id) ? 'selected="selected"' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>--}}

                                    @if(!in_array('AGENT', getUserRoles(\Auth::user())))
                                        <div class="col-md-4 col-lg-4">
                                            <label for="customer_id">
                                                {{ getTranslation('customer') }}
                                            </label>
                                            <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                                <option value="">{{ getTranslation('select_customer') }}</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ (session('customer_id') && session('customer_id') == $customer->id) ? 'selected="selected"' : '' }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-lg-4">
                                        <label for="id">
                                            {{ getTranslation('claim_id') }}
                                        </label>
                                        <input type="text" class="form-control" name="search[id]" id="id" value="{{ ($search && isset($search['id'])) ? $search['id'] : ''}}">
                                    </div>

                                </div>
                            </div>
                         </div>
                        <div class="row">
                            <div class="form-group form-group-sm">
                                <div class="col-md-4 col-lg-4">
                                    <button class="btn btn-danger" type="submit">{{ getTranslation('submit') }}</button>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="status">
                                        {{ getTranslation('get_closed_claims_as_well') }}
                                        <input type="checkbox" id="status" name="search[status]" value="CLOSED" {{ ($search && isset($search['status'])) ? 'checked="checked"' : '' }}>
                                    </label>
                                    <br />


                                </div>
                            </div>
                        </div>
                    </form>
                    <br />
                    <br />
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ getTranslation('date') }}</th>
                            <th>{{ getTranslation('customer_name') }}</th>
                            <th>Virksomheder</th>
                            <th>{{ getTranslation('claim_id') }}</th>

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
                            <tr class="alert alert-{{ getClaimColor($claim) }}" id="claim_{{ $claim->id }}">
                                <td data-sort="{{ date('Y-m-d', strtotime($claim->date)) }}">{{ $claim->date }}</td>
                                <td>{{ ($claim->customer && $claim->customer->name)  ? $claim->customer->name : ''}}</td>
                                <td>
                                    {{ ($claim->department && $claim->department->company && $claim->department->company->name)  ? $claim->department->company->name : ''}}
                                </td>
                                <td >
                                    {{ $claim->id }}
                                </td>

                                <td>{{ $claim->selsskab_skade_nummer }}</td>
                                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                                {{--<td data-claim-id="{{ $claim->id }}" data-csrf="{{ csrf_token() }}" data-url="{{ route('claim.detail.form') }}" class="estimate_value">{{ $claim->estimate }}</td>--}}
                                <td>{{ ($claim->department) ? $claim->department->name : ''}}</td>
                                <td>{{ ($claim->address1)  ? $claim->address1->address : ''}}</td>
                                <td>{{ ($claim->address_2)  ? $claim->address_2 : ''}}</td>
                                <td>
                                    <a href="{{ route('claim.details', ['id'=> $claim->id]) }}" class="btn btn-success btn-sm">{{ getTranslation('details') }}</a>
                                    @if (isAdmin(\Auth::user()))
                                        <a href="{{ route('claim.edit', ['id'=> $claim->id]) }}" class="btn btn-info btn-sm">{{ getTranslation('edit') }}</a>
                                        <button data-url="{{ route('claim.delete', ['id'=> $claim->id]) }}" data-id="{{ $claim->id }}" class="btn btn-danger btn-sm delete" data-csrf="{{ csrf_token() }}">{{ getTranslation('delete') }}</button>
                                    @endif
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

        $('.delete').on('click', function(event){
            event.stopImmediatePropagation();
            var modal = $("#modal-delete");
            var url = $(this).data('url');
            var id = $(this).data('id');
            var csrf = $(this).data('csrf');
            modal.modal('show');

            $("#delete-confirm").unbind().on('click', function (e) {
                e.stopImmediatePropagation();
                sendAjax(url, {_token: csrf}, 'POST', function (result) {
                    modal.modal('hide');
                    if(result.is_deleted) {
                        $("#claim_"+id).hide('slow');
                    }
                });
            });
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

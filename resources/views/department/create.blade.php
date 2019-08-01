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
                    <h2>Create Department </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('department.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ old('team_id') }}" id="hidden_teams_id">
                        <input type="hidden" value="{{ old('company_id') }}" id="hidden_company_id">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="title">{{ getTranslation('department') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <input type="text" id="title" class="form-control col-md-7 col-xs-12" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="policy_number">{{ getTranslation('customer_policy_number') }}
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <input type="text" id="policy_number" class="form-control col-md-7 col-xs-12" name="policy_number" value="{{ old('policy_number') }}">
                                @if ($errors->has('policy_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('policy_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_id">{{ getTranslation('customer') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="customer_id" id="customer_id" data-url="/customer/teams/">
                                    <option value="">{{ getTranslation('select_customer') }}</option>
                                    @if(count($customers) > 0)
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ (old('customer_id') == $customer->id) ? "selected='selected'" : '' }}>{{ $customer->name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('customer_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="team_id">{{ getTranslation('teams') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="team_id" id="team_id" disabled="disabled">
                                </select>
                                @if ($errors->has('team_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="company_id">{{ getTranslation('company') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="company_id" id="company_id" disabled="disabled">
                                </select>
                                @if ($errors->has('company_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            @if ($errors->has('addresses'))
                                <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('addresses') }}</strong>
                                    </span>
                            @endif
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">&nbsp;
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <div class="col-md-10">
                                    <table>
                                        <thead>
                                        <tr>
                                            <td style="width:150px;" class="col-md-3 col-xs-12" >Address</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >Post nr.</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >By</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >Build Year</td>
                                            <td style="width:150px;" class="col-md-3 col-xs-12" >Etageareal</td>
                                        </tr>
                                        </thead>
                                        <tbody class="addresses" id="address_div">
                                        @if(count(old('addresses')) > 0)
                                            @foreach(old('addresses') as $key => $address)
                                                <tr style="margin-bottom: 35px;" >
                                                    <td><input type="text"  required="required" style="width: 150px;" class="form-control col-md-3 col-xs-12" name="addresses[{{$key}}][address]" value="{{ $address['address']}}"></td>
                                                    <td><input type="text"  required="required" style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$key}}][zip_code]" value="{{ $address['zip_code']}}"></td>
                                                    <td><input type="text"  required="required" style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$key}}][city]" value="{{ $address['city']}}"></td>
                                                    <td><input type="text"  required="required" style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$key}}][build_year]" value="{{ $address['build_year']}}"></td>
                                                    <td><input type="text"  required="required" style="width: 150px;" class="form-control col-md-3 col-xs-12" name="addresses[{{$key}}][m2]" value="{{ $address['m2']}}"></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>


                                    </table>

                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger pull-right" type="button" id="add_address">Add Address</button>
                                </div>

                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('department.index') }}">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('/admin/vendors/select2/dist/css/select2.min.css') }} " rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('/admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
           jQuery("#roles").on('change', function(){
                var value = jQuery(this).val();

                if(jQuery.inArray("2", value) !== -1) {
                    jQuery("#department_id_div").show();
                    jQuery("#department_id").prop( "disabled", false );
                } else {
                    jQuery("#department_id_div").hide();
                    jQuery("#department_id").prop( "disabled", true );
                }
           });
        });
        $('.select2').select2();
    </script>
@endsection
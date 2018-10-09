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
                    <h2>Edit Department </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('department.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $department->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">{{ getTranslation('department') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12" name="name" value="{{ $department->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">Code <span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12" name="code" value="{{ $department->code }}">
                                @if ($errors->has('code'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_id">{{ getTranslation('customer') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="customer_id" id="customer_id">
                                    <option value="">{{ getTranslation('select_customer') }}</option>
                                    @if(count($customers) > 0)
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ ($department->customer_id == $customer->id) ? "selected='selected'" : '' }}>{{ $customer->name }}</option>
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
                            <label class="control-label col-md-1 col-sm-1 col-xs-12">&nbsp;
                            </label>
                            <div class="col-md-11 col-sm-11 col-xs-12">
                                <div class="col-md-10" id="address_div">
                                    <table >
                                        <thead>
                                        <tr>
                                            <td style="width:150px;" class="col-md-3 col-xs-12" >Address</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >Post nr.</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >By</td>
                                            <td style="width:150px;" class="col-md-2 col-xs-12" >Build Year</td>
                                            <td style="width:150px;" class="col-md-3 col-xs-12" >Etageareal</td>
                                        </tr>
                                        </thead>

                                        <tbody class="addresses">
                                        @if(count($department->addresses) > 0)
                                            @foreach($department->addresses as $address)
                                                <tr style="margin-bottom: 35px;" >
                                                    <td><input type="text"  style="width: 150px;" class="form-control col-md-3 col-xs-12" name="addresses[{{$address->id}}][address]" value="{{ $address->address}}"></td>
                                                    <td><input type="text"  style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$address->id}}][zip_code]" value="{{ $address->zip_code}}"></td>
                                                    <td><input type="text"  style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$address->id}}][city]" value="{{ $address->city}}"></td>
                                                    <td><input type="text"  style="width: 150px;" class="form-control col-md-2 col-xs-12" name="addresses[{{$address->id}}][build_year]" value="{{ $address->build_year}}"></td>
                                                    <td><input type="text"  style="width: 150px;" class="form-control col-md-3 col-xs-12" name="addresses[{{$address->id}}][m2]" value="{{ $address->m2}}"></td>
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
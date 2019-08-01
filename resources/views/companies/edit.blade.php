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
                    <h2>Edit Customer </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('company.store') }}" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $company->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ getTranslation('customer_name') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ $company->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ getTranslation('select_customer') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="customer_id" class="form-control" name="customer_id" aria-hidden="true">
                                    <option value="">{{ getTranslation('select_customer') }}</option>
                                    @foreach($allCustomers as $aCustomer)
                                        <option value="{{ $aCustomer->id }}" {{ ( $company->customer_id == $aCustomer->id) ? 'selected="selected"' : '' }}>{{ $aCustomer->name }}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('customer_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">{{ getTranslation('customer_address') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" class="form-control col-md-7 col-xs-12" name="address" value="{{ $company->address }}">
                                @if ($errors->has('address'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">{{ getTranslation('customer_city') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="city" class="form-control col-md-7 col-xs-12" name="city" value="{{ $company->city }}">
                                @if ($errors->has('city'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip_code"> {{ getTranslation('customer_zip_code') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="zip_code" class="form-control col-md-7 col-xs-12" name="zip_code" value="{{ $company->zip_code }}">
                                @if ($errors->has('zip_code'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person"> {{ getTranslation('customer_contact_person') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="contact_person" class="form-control col-md-7 col-xs-12" name="contact_person" value="{{ $company->contact_person }}">
                                @if ($errors->has('contact_person'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('contact_person') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('company.index') }}">Back</a>
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
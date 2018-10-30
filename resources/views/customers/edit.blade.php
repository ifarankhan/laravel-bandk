@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('customer.index') }}">{{ getTranslation('customer') }}</a></li>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('customer.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ getTranslation('customer_name') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ $customer->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">{{ getTranslation('customer_address') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" class="form-control col-md-7 col-xs-12" name="address" value="{{ $customer->address }}">
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
                                <input type="text" id="city" class="form-control col-md-7 col-xs-12" name="city" value="{{ $customer->city }}">
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
                                <input type="text" id="zip_code" class="form-control col-md-7 col-xs-12" name="zip_code" value="{{ $customer->zip_code }}">
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
                                <input type="text" id="contact_person" class="form-control col-md-7 col-xs-12" name="contact_person" value="{{ $customer->contact_person }}">
                                @if ($errors->has('contact_person'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('contact_person') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_number"> {{ getTranslation('customer_bank_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="bank_number" class="form-control col-md-7 col-xs-12" name="bank_number" value="{{ $customer->bank_number }}">
                                @if ($errors->has('bank_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('bank_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_number"> {{ getTranslation('customer_account_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="account_number" class="form-control col-md-7 col-xs-12" name="account_number" value="{{ $customer->account_number }}">
                                @if ($errors->has('account_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="insurance_company_name"> {{ getTranslation('customer_insurance_company_name') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="insurance_company_name" class="form-control col-md-7 col-xs-12" name="insurance_company_name" value="{{ $customer->insurance_company_name }}">
                                @if ($errors->has('insurance_company_name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('insurance_company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="policy_number"> {{ getTranslation('customer_policy_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="policy_number" class="form-control col-md-7 col-xs-12" name="policy_number" value="{{ $customer->policy_number }}">
                                @if ($errors->has('policy_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('policy_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="insurance_number"> {{ getTranslation('customer_insurance_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="insurance_number" class="form-control col-md-7 col-xs-12" name="insurance_number" value="{{ $customer->insurance_number }}">
                                @if ($errors->has('insurance_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('insurance_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bnk_insurance_number"> {{ getTranslation('bnk_insurance_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="bnk_insurance_number" class="form-control col-md-7 col-xs-12" name="bnk_insurance_number" value="{{ $customer->bnk_insurance_number }}">
                                @if ($errors->has('bnk_insurance_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('bnk_insurance_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_send_email" > {{ getTranslation('receive_emails') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="is_send_email" id="is_send_email" value="true" {{  ($customer->is_send_email) ?  'checked="checked"' : '' }} >
                                @if ($errors->has('bnk_insurance_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('bnk_insurance_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ getTranslation('customer_emails') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-9" id="emails_div">
                                    <?php
                                        $emails = ($customer->emails) ? json_decode($customer->emails, true) : [];
                                    ?>
                                    @if(count($emails) > 0)
                                        @foreach($emails as $email)
                                            <div style="margin-bottom: 35px;">
                                                <input type="text" class="form-control col-md-7 col-xs-12" name="emails[]" value="{{ $email }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger pull-right" type="button" id="add_emails">{{ getTranslation('customer_add_emails') }}</button>
                                </div>

                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('customer.index') }}">Back</a>
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
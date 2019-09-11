@extends('layouts.app-front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-section">
                <h1>Claim Form</h1>

                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>

                <form action="{{ route('claim.create.post') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="status" value="OPEN">
                    <input type="hidden" name="from_web" value="from_web">
                    <?php
                        $roles = \Auth::user()->roles;

                        if(count($roles) > 0) {
                            $roles = $roles->pluck('name')->toArray();
                        }
                    ?>

                    @if(in_array('ADMIN', $roles))
                        <div class="form-group ">
                        <label for="heading">{{ getTranslation('customer') }}
                            <i class="fa fa-spin fa-spinner" style="display: none;" id="customer_loader"></i>
                        </label>
                            {{--data-url="/customer/companies/"--}}
                        <select class="form-control" name="customer_id" id="customer_id" data-url="/customer/departments/">
                            <option value="">{{ getTranslation('select_customer_id') }}</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected="selected"' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>

                        @foreach($customers as $customer)
                            <input type="hidden" id="customer_{{ $customer->id }}" value="{{ json_encode($customer) }}">
                        @endforeach
                        @if ($errors->has('customer_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    @else
                    <input type="hidden" name="customer_id" id="customer_id" data-url="/customer/departments/" value="{{ \Auth::user()->customer_id }}">
                    @endif

                   {{-- <div class="form-group ">
                        <label for="department">{{ getTranslation('company') }}
                            <i class="fa fa-spin fa-spinner" style="display: none;" id="company_loader"></i>
                        </label>
                        <input type="hidden" value="{{ old('company_id') }}" id="hidden_company_1">
                        <select class="form-control" name="company_id" id="company_id_id" data-url="/company/departments/">
                            <option value="">{{ getTranslation('select_company') }}</option>
                        </select>
                        @if ($errors->has('company_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_id') }}</strong>
                            </span>
                        @endif
                    </div>--}}
                    <div class="form-group ">
                        <label for="department">{{ getTranslation('department') }}
                            <i class="fa fa-spin fa-spinner" style="display: none;" id="department_loader"></i>
                        </label>
                        <input type="hidden" value="{{ old('department_id') }}" id="hidden_department_1">
                        <select class="form-control" name="department_id" id="department_id" data-url="/department/address/">
                            <option value="">{{ getTranslation('select_department') }}</option>
                        </select>
                        @if ($errors->has('department_id'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('department_id') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="address">{{ getTranslation('address_1') }}</label>
                        <input type="hidden" value="{{ old('address_1') }}" id="hidden_address_1">
                        <select class="form-control" name="address_1" id="address_1">
                        </select>
                        @if ($errors->has('address_1'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('address_1') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="Address">{{ getTranslation('address_2') }}</label>
                        <input type="text" class="form-control" id="address" name="address_2" value="{{ old('address_2') }}">
                        @if ($errors->has('address_2'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('address_2') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="heading">{{ getTranslation('claim_type') }}</label>
                        <select class="form-control" name="claim_type_id">
                            <option value="">{{ getTranslation('select_claim_type') }}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('claim_type_id') == $type->id ? 'selected="selected"' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('claim_type_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('claim_type_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="date">{{ getTranslation('date') }}</label>
                        <input type="text" class="form-control" id="date" name="date" value="{{ old('date') }}" placeholder="dd/mm/yyyy" autocomplete="off">
                        @if ($errors->has('date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label >{{ getTranslation('is_damage_inspected') }}</label>
                        <div class="radio">
                            <label for="optionsRadios1">
                                <input type="radio"  value="1" id="optionsRadios1" name="is_damage_inspected"> Yes
                            </label>
                            <label for="optionsRadios2">
                                <input type="radio" checked="" value="0" id="optionsRadios2" name="is_damage_inspected"> No
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="estimate">{{ getTranslation('estimate') }}</label>
                        <input type="text" class="form-control" id="estimate" name="estimate" value="{{ old('estimate') }}" maxlength="10">
                        @if ($errors->has('estimate'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('estimate') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="Description" class="display-block">{{ getTranslation('description') }}</label>
                        <textarea rows="5" cols="64" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                        @endif
                    </div>

                    {{--<div class="form-group ">
                        <label for="heading">{{ getTranslation('mechanics_type') }}</label>
                        <select class="form-control" name="claim_mechanic_id">
                            <option value="">{{ getTranslation('select_claim_mechanic_type') }}</option>
                            @foreach($mechanicsTypes as $item)
                                <option value="{{ $item->id }}" {{ old('claim_mechanic_id') == $item->id ? 'selected="selected"' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('claim_mechanic_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('claim_mechanic_id') }}</strong>
                            </span>
                        @endif
                    </div>--}}

                    <div class="form-group">
                        <label for="fileUpload">{{ getTranslation('attach_photo') }}</label>
                        <input type="file" id="fileUpload" multiple="multiple" name="images[]">
                        @if ($errors->has('images'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('images') }}</strong>
                                </span>
                        @endif
                        <div id="image-holder">
                        </div>
                    </div>


                    <button class="send">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('/admin/vendors/select2/dist/css/select2.min.css') }} " rel="stylesheet">
    <style>
        #image-holder img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
            height: 100px;
        }

        #image-holder img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .help-block{
            color: #a94442;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('/admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('.select2').select2();
        $( function() {
            $( "#date" ).datepicker({ dateFormat: 'dd/mm/yy',maxDate: '0' });
        } );
    </script>
@endsection
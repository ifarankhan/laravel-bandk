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
                    <input type="hidden" name="id" value="{{ $claim->id }}">
                    <input type="hidden" name="status" value="FOR_BNK">
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
                            <select class="form-control" name="customer_id" id="customer_id" data-url="/customer/departments/">
                                <option value="">{{ getTranslation('select_customer_id') }}</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $claim->customer_id == $customer->id ? 'selected="selected"' : '' }}>{{ $customer->name }}</option>
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
                        <input type="hidden" name="customer_id" id="customer_id" data-url="/customer/departments/" value="{{ $claim->customer_id }}">
                    @endif

                    <div class="form-group ">
                        <label for="department">{{ getTranslation('department') }}
                            <i class="fa fa-spin fa-spinner" style="display: none;" id="department_loader"></i>
                        </label>
                        <input type="hidden" value="{{ $claim->department_id }}" id="hidden_department_1">
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
                        <input type="hidden" value="{{ $claim->address_1 }}" id="hidden_address_1">
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
                        <input type="text" class="form-control" id="address" name="address_2" value="{{ $claim->address_2 }}">
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
                                <option value="{{ $type->id }}" {{ $claim->claim_type_id == $type->id ? 'selected="selected"' : '' }}>{{ $type->name }}</option>
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
                        <input type="date" class="form-control" id="date" name="date" value="{{ dateFormat($claim->date) }}">
                        @if ($errors->has('date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="estimate">{{ getTranslation('estimate') }}</label>
                        <input type="text" class="form-control" id="estimate" name="estimate" value="{{ $claim->estimate }}" maxlength="10">
                        @if ($errors->has('estimate'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('estimate') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <label for="Description" class="display-block">{{ getTranslation('description') }}</label>
                        <textarea rows="5" cols="64" name="description">{{ $claim->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                        @endif
                    </div>

                    {{--<div class="form-group ">
                        <label for="insurance_number">{{ getTranslation('customer_insurance_number') }}</label>
                        <input type="text" class="form-control" id="insurance_number" name="estimate" value="{{ old('insurance_number') }}" disabled="disabled">
                    </div>
                    <div class="form-group ">
                        <label for="insurance_police_number">{{ getTranslation('customer_policy_number') }}</label>
                        <input type="text" class="form-control" id="insurance_police_number" name="policy_number" value="{{ old('policy_number') }}" disabled="disabled">
                    </div>
                    <div class="form-group ">
                        <label for="bnk_insurance_number">{{ getTranslation('bnk_insurance_number') }}</label>
                        <input type="text" class="form-control" id="bnk_insurance_number" name="bnk_insurance_number" value="{{ old('bnk_insurance_number') }}" disabled="disabled">
                    </div>
                    <div class="form-group ">
                        <label for="estimate">{{ getTranslation('customer_bank_number') }}</label>
                        <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number') }}" disabled="disabled">
                    </div>--}}


                    <div class="form-group ">
                        <label for="heading">{{ getTranslation('mechanics_type') }}</label>
                        <select class="form-control" name="claim_mechanic_id">
                            <option value="">{{ getTranslation('select_claim_mechanic_type') }}</option>
                            @foreach($mechanicsTypes as $item)
                                <option value="{{ $item->id }}" {{ $claim->claim_mechanic_id == $item->id ? 'selected="selected"' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('claim_mechanic_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('claim_mechanic_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="fileUpload">{{ getTranslation('attach_photo') }}</label>
                        <input type="file" id="fileUpload" multiple="multiple" name="images[]">
                        @if ($errors->has('images'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('images') }}</strong>
                                </span>
                        @endif
                        @if(count($claim->images) > 0)
                            <div class="row">
                                @foreach($claim->images as $key => $image)
                                    <div class="col-md-6">
                                        <div id="content_{{ $image->id }}">
                                            <img src="{{ asset('/images/'.$image->image) }}" style="width:170px;height:120px;" class="img-responsive" />
                                            <br />
                                            <br />
                                            <a data-id="{{ $image->id }}" data-url="{{ route('image.delete', ['id'=> $image->id]) }}" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">{{ getTranslation('delete') }}</a>
                                        </div>

                                    </div>

                                @endforeach
                            </div>
                        @endif
                        <div class="image-holder" id="image-holder">
                        </div>
                    </div>


                    <button class="send">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('/admin/vendors/select2/dist/css/select2.min.css') }} " rel="stylesheet">
    <style>
        .image-holder img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
            height: 100px;
        }

        .image-holder img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .help-block{
            color: #a94442;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('/admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();
    </script>
@endsection
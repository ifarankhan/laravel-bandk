@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('users.index') }}">{{ getTranslation('users') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Users </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('users.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Roles</label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <?php
                                    $userRoles = ($user->roles) ? $user->roles->pluck('id')->toArray() : [];
                                    $userModules = ($user->modules) ? $user->modules->pluck('id')->toArray() : [];
                                ?>
                                <select class="form-control select2" name="roles[]" multiple="multiple" id="roles">
                                    <option value="">Choose option</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('roles'))
                                        <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Modules</label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control select2" name="modules[]" multiple="multiple" >
                                    <option value="">Choose option</option>
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}" {{ in_array($module->id, $userModules) ? 'selected=selected' : '' }}>{{ $module->text }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('modules'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('modules') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer</label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control" name="customer_id" id="customer_id">
                                    <option value="">Choose option</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ ($customer->id == $user->customer_id) ? 'selected=selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('customer_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
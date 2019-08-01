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
                        <input type="hidden" id="departments_selected" value="{{ $user->departments }}">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="username" class="form-control col-md-7 col-xs-12" name="username" value="{{ $user->username }}">
                                @if ($errors->has('username'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="password" class="form-control col-md-7 col-xs-12" name="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Telefonnummer <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="phone_number" class="form-control col-md-7 col-xs-12" name="phone_number" value="{{ $user->phone_number }}">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
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
                                        @if($role->id != 2)
                                            <option value="{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                                        @endif
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
                                        @if($module->id != 3)
                                            <option value="{{ $module->id }}" {{ in_array($module->id, $userModules) ? 'selected=selected' : '' }}>{{ $module->text }}</option>
                                        @endif
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
                            <input type="hidden" value="{{ $user->company_id }}" id="hidden_company_1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer</label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control " name="customer_id" id="customer_id" data-url="/customer/companies/">
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
                        <?php
                            $userCompanies = ($user->companies) ? $user->companies->pluck('company_id')->toArray() : [];
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_id">{{ getTranslation('company') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" name="companies[]" id="company_id_id" multiple="multiple" data-url="/customer/departments/grouped/">
                                    <option value="">Choose option</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ (in_array($company->id, $userCompanies)) ? 'selected=selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departments">{{ getTranslation('teams') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select id='departments' name="departments[]" multiple='multiple'>

                                </select>
                                @if ($errors->has('departments'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('departments') }}</strong>
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
    <link href="{{ asset('/admin/css/multi-select.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('/admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.multiselect.search.js') }}"></script>
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
        $('#departments').multiSelect({
            selectableOptgroup: true,
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Search'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Search'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    </script>
@endsection
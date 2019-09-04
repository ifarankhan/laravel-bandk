@extends('layouts.app-admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create Users </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('users.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="departments_selected" value="{{ json_encode(old('departments')) }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ old('name') }}">
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
                                <input type="text" id="username" class="form-control col-md-7 col-xs-12" name="username" value="{{ old('username') }}">
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
                                <input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="password" class="form-control col-md-7 col-xs-12" name="password" >
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
                                <input type="text" id="phone_number" class="form-control col-md-7 col-xs-12" name="phone_number" value="{{ old('phone_number') }}">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Roles
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control select2" name="roles[]" multiple="multiple" id="roles1">
                                    <option value="">Choose option</option>
                                    @foreach($roles as $role)
                                        @if($role->id != 2)
                                            <option value="{{ $role->id }}" {{ old('roles') && in_array($role->id, old('roles')) ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Modules
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control select2" name="modules[]" multiple="multiple">
                                    <option value="">Choose option</option>
                                    @foreach($modules as $module)
                                        @if($module->id != 3)
                                            <option value="{{ $module->id }}" {{ old('modules') && in_array($module->id, old('modules')) ? 'selected="selected"' : '' }}>{{ $module->text }}</option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control" name="customer_id" id="customer_id" data-url="/customer/companies/">
                                    <option value="">Choose option</option>
                                    @if(count($customers) > 0)
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected="selected"' : '' }}>{{ $customer->name }}</option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_id">{{ getTranslation('company') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" multiple="multiple" name="companies[]" id="company_id_id" disabled="disabled" data-url="/customer/departments/grouped/">
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
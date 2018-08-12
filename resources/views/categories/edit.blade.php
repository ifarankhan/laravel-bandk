@extends('layouts.app-admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Category </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('category.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $content->id }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="title" required="required" class="form-control col-md-7 col-xs-12" name="title" value="{{ $content->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Parent
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select type="text" id="parent_id" class="form-control col-md-7 col-xs-12" name="parent_id">
                                    <option value="">Select Parent</option>
                                    @if(count($parents) > 0)
                                        @foreach($parents as $parent)
                                            @if($parent->id != $content->id)
                                                <option value="{{ $parent->id }}" {{ ($parent->id == $content->parent_id) ? 'selected="selected"' : ''}}>{{ $parent->title }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('parent_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('category.index') }}">Back</a>
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
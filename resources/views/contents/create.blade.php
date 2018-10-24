@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('content.index') }}">{{ getTranslation('content') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create Contents </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('content.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="title" class="form-control col-md-7 col-xs-12" name="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" id="description"  class="form-control col-md-7 col-xs-12 wysihtml5" name="description">
                                    {{ old('description') }}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Category<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select type="text" id="parent_id" class="form-control col-md-7 col-xs-12" name="category_id">
                                    <option value="">Select Category</option>
                                    @if(count($parents) > 0)
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ (old('category_id') == $parent->id) ? 'selected="selected"' : ''}}>{{ $parent->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-danger" href="{{ route('content.index') }}">Back</a>
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
            $('.wysihtml5').wysihtml5({
                "classes": { "*":1 },
                "stylesheets": ["{{ asset('/admin/vendors/html-editor/wysiwyg-color.css') }}"],
                parser: function(html) {
                    return html;
                }
            });
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
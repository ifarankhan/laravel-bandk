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
                                <textarea type="text" id="description"  class="form-control col-md-7 col-xs-12 wysihtml5" name="description" style="width: 100%; height: 100%;">
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
        <div id="linked-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add link</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Text
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="text" id="text" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('parent_id'))
                                        <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Category
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select id="link_category" class="form-control col-md-7 col-xs-12" >
                                        <option value="">Select Category</option>
                                        @if(count($parents) > 0)
                                            @foreach($parents as $parent)
                                                <option value="{{ $parent->id }}" >{{ $parent->title }}</option>
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

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="addLink">Add</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="phone-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Phone</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="text" id="phone_number" class="form-control col-md-7 col-xs-12">
                                </div>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="addPhone">Add</button>
                    </div>
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
                },
                "image": false
            });
            jQuery(".wysihtml5-toolbar").append('<li class="dropdown"><a class="btn default dropdown-toggle" href="#" id="linked" data-toggle="modal" data-target="#linked-modal"><i class="fa fa-link"></i></a></li>');
            jQuery(".wysihtml5-toolbar").append('<li class="dropdown"><a class="btn default dropdown-toggle" href="#" id="phone" data-toggle="modal" data-target="#phone-modal"><i class="fa fa-phone"></i></a></li>');
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
            jQuery("#addLink").on('click', function(){
                //var description = jQuery(".wysihtml5");
                var text = jQuery("#text").val();
                var link_category = jQuery("#link_category");
                var id = link_category.val();
                if(text.trim() == '') {
                    text = jQuery("#link_category option:selected").text();
                }

                var content = jQuery('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html();
                var link = '<a class="load-content" href="{{ route('home.index') }}'+'/content/'+id+'" data-id="'+id+'" data-url="/content/list/'+id+'">'+text+'</a>';
                content = content + link;

                jQuery('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(content);
            });
            jQuery("#addPhone").on('click', function(){
                console.log('Hello');
                var text = jQuery("#phone_number").val();
                if(text.trim() == '') {
                    jQuery("#phone_number").css('border-color', 'red');

                    return false;
                }

                var content = jQuery('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html();
                var link = '<a href="tel:'+text+'">'+text+'</a>';
                content = content + link;

                jQuery('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(content);
                $("#phone-modal").modal('hide');
            });
        });
        $('.select2').select2();
    </script>
@endsection
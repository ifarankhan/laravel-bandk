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
                    <h2>Create Meeting Place </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('meeting-place.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">Category<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select type="text" id="category_id" class="form-control col-md-7 col-xs-12" name="category_id">
                                    <option value="">Select Category</option>
                                    @if(count($categories) > 0)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected="selected"' : ''}}>{{ $category->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-info" id="add-meeting-place">Add meeting place</button>

                        </div>
                        <table class="table table-striped table-bordered" id="meeting-place">
                            <tbody>
                                {{--<tr>
                                    <td>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select type="text" id="customer_id[]" class="form-control col-md-7 col-xs-12" name="category_id">
                                                <option value="">Select Customer</option>
                                                @if(count($customers) > 0)
                                                    @foreach($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="description"  class="form-control col-md-7 col-xs-12 wysihtml5" name="meeting_place[]" style="width: 100%; height: 100%;" placeholder="Add meeting place">
                                                </textarea>
                                                @if ($errors->has('description'))
                                                    <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>--}}
                            </tbody>
                        </table>
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
        jQuery(document).ready(function() {

            $("#add-meeting-place").on('click', function (event) {
                event.preventDefault();
                var trs = $("#meeting-place").get(0).rows.length;
                var html = '<td> <div class="col-md-12 col-sm-12 col-xs-12"> <select type="text" id="customer_id[]" class="form-control col-md-7 col-xs-12" name="category_id"> <option value="">Select Customer</option>@if(count($customers) > 0)@foreach($customers as $customer)<option value="{{ $customer->id }}">{{ $customer->name }}</option>@endforeach @endif</select> </div> </td> <td> <div class="form-group"> <div class="col-md-12 col-sm-12 col-xs-12"> <textarea id="meeting_place_'+trs+'"  class="form-control col-md-7 col-xs-12 wysihtml5" name="meeting_place[]" style="width: 100%; height: 100%;" placeholder="Add meeting place"> </textarea> </div> </div> </td>';
                $("#meeting-place").prepend('<tr id="tr_'+trs+'">'+html+'</tr>');
                $('#meeting_place_'+trs).wysihtml5({
                    "classes": {"*": 1},
                    "stylesheets": ["{{ asset('/admin/vendors/html-editor/wysiwyg-color.css') }}"],
                    parser: function (html) {
                        return html;
                    },
                    "image": false
                });
            });


        });

        $('.select2').select2();
    </script>
@endsection
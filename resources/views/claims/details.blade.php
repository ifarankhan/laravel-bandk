@extends('layouts.app-admin')
@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('claim.index') }}">{{ getTranslation('claims') }}</a></li>
    </ul>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('claim.detail.form') }}" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
                            <div class="ribbon-sub ribbon-clip">{{ getTranslation('claim_details') }}</div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <div class="row">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $claim->id }}">
                            <div class="form-group col-md-6">
                                <select class="form-control" name="status">
                                    <option value="">{{ getTranslation('select_status') }}</option>
                                    <option value="CLOSED" {{ $claim->status == 'CLOSED' ? 'selected="selected"' : '' }}>{{ getTranslation('closed') }}</option>
                                    <option value="OPEN" {{ $claim->status == 'OPEN' ? 'selected="selected"' : '' }}>{{ getTranslation('open') }}</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>


            <div class="mt-element-ribbon bg-grey-steel">
                <div class="row ribbon-content">

                    <div class="row">
                        <div class="col-md-3"><strong>{{ getTranslation('customer_name') }}:</strong></div>
                        <div class="col-md-3">{{ ($claim->customer) ?  $claim->customer->name : ''}}</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>

                    <div class="row">
                        <div class="col-md-2"><strong>{{ getTranslation('claim_id') }}:</strong></div>
                        <div class="col-md-2">{{ $claim->id }}</div>
                        <div class="col-md-2"><strong>{{ getTranslation('department') }}:</strong></div>
                        <div class="col-md-2">{{ ($claim->department) ? $claim->department->name : ''}}</div>
                        <div class="col-md-2"><strong>{{ getTranslation('date') }}:</strong></div>
                        <div class="col-md-2">{{ $claim->date }}</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>
                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-2"><strong>{{ getTranslation('address_1') }}:</strong></div>
                        <div class="col-md-2">{{ ($claim->address1)  ? $claim->address1->address : ''}}</div>
                        <div class="col-md-2"><strong>{{ getTranslation('claim_type') }}:</strong></div>
                        <div class="col-md-2">{{ ($claim->type) ? $claim->type->name : ''}}</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>
                    <div class="row">
                        <div class="col-md-4"><strong>Selskab skade nummer:</strong></div>
                        <div class="col-md-2"><strong>{{ getTranslation('address_2') }}:</strong></div>
                        <div class="col-md-2">{{ ($claim->address_2)  ? $claim->address_2 : ''}}</div>
                        <div class="col-md-2"><strong>{{ getTranslation('estimate') }}:</strong></div>
                        <div class="col-md-2">{{ $claim->estimate }}</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>

                    <div class="row">
                        <div class="col-md-4"><input type="hidden" name="id" value="{{ $claim->id }}">
                            {{ csrf_field() }}
                            <div style="margin-left: -2px;">
                                <input type="text" id="selsskab_skade_nummer" class="form-control" name="selsskab_skade_nummer" value="{{ $claim->selsskab_skade_nummer }}" placeholder="Selskab skade nummer">
                            </div>
                        </div>
                        <div class="col-md-2"><strong>{{ getTranslation('customer_zip_code') }}:</strong></div>
                        <div class="col-md-3">{{ ($claim->address1) ?  $claim->address1->zip_code : ''}}</div>
                        <div class="col-md-3">&nbsp;</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>

                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-2"><strong>{{ getTranslation('customer_city') }}:</strong></div>
                        <div class="col-md-2">{{ ($claim->customer) ? $claim->customer->city : '' }}</div>
                        <div class="col-md-2"><strong>Anmelder:</strong></div>
                        <div class="col-md-2">{{ ($claim->user) ? $claim->user->name : '' }}</div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>

                    <div class="row">
                        <div class="col-md-12"><strong>{{ getTranslation('is_damage_inspected') }}</strong></div>
                    </div>
                    <hr style="border-top: 1px solid gray;"/>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" value="{{ $claim->id }}">
                            {{ csrf_field() }}
                            <div class="radio">
                                <label>
                                    <input type="radio" {{($claim->is_damage_inspected) ? 'checked=""' : ''}} value="1" id="optionsRadios1" name="is_damage_inspected"> Yes
                                </label>
                                <label>
                                    <input type="radio" {{(!$claim->is_damage_inspected) ? 'checked=""' : ''}} value="0" id="optionsRadios2" name="is_damage_inspected"> No
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <button class=" btn btn-{{ getClaimColor($claim) }} " type="submit">{{ getTranslation('submit') }}</button>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <strong>{{ getTranslation('description') }}:</strong> &nbsp;{{ $claim->description }}
                        </div>
                    </div>
                </div>
                {{--<div class="row ribbon-content">
                    <div class="col-md-4">
                        <strong>{{ getTranslation('claim_id') }}:</strong> {{ $claim->id }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('department') }}:</strong> {{ ($claim->department) ? $claim->department->name : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('claim_person') }}:</strong> {{ ($claim->user) ? ucfirst($claim->user->name) : '' }}
                    </div>
                    <div class="col-md-4">
                        <form class="form-horizontal form-label-left" action="{{ route('claim.detail.form') }}" method="POST">
                            <input type="hidden" name="id" value="{{ $claim->id }}">
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-left: -10px;">

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="control-label" for="rekv_nummer"><strong>Selsskab skade nummer:</strong>
                                    </label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="selsskab_skade_nummer" class="form-control col-md-12 " name="selsskab_skade_nummer" value="{{ $claim->selsskab_skade_nummer }}" placeholder="Selsskab skade nummer">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" class="btn btn-success btn-xs">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('claim_type') }}:</strong> {{ ($claim->type) ? $claim->type->name : '' }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('address_1') }}:</strong> {{ ($claim->address1)  ? $claim->address1->address : ''}}
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('date') }}:</strong> {{ $claim->date }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('address_2') }}:</strong> {{ ($claim->address_2)  ? $claim->address_2 : ''}}
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('estimate') }}:</strong> {{ $claim->estimate }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_zip_code') }}:</strong> {{ ($claim->customer) ?  $claim->customer->zip_code : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('status') }}:</strong> {{ getClaimStatus($claim) }}
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_city') }}:</strong> {{ ($claim->customer) ? $claim->customer->city : '' }}
                    </div>
                    <div class="col-md-4">
                        <form class="form-horizontal form-label-left" action="{{ route('claim.detail.form') }}" method="POST">
                            <input type="hidden" name="id" value="{{ $claim->id }}">
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-left: -8px;">

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="control-label" for="rekv_nummer"><strong>Rekv nummer:</strong>
                                    </label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="rekv_nummer" class="form-control col-md-12 " name="rekv_nummer" value="{{ $claim->rekv_nummer }}" placeholder="Rekv nummer">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" class="btn btn-success btn-xs">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row ribbon-content">
                    <div class="col-md-12">
                        <strong>{{ getTranslation('description') }}:</strong> {{ $claim->description }}
                    </div>

                </div>--}}
            </div>

            </form>
        </div>
    </div>
    @if(count($claim->images) > 0)

        <div class="row">

            <div class="imageGallery1 col-md-12">
                @foreach($claim->images as $key => $image)
                    <div class="col-md-3" >
                        <a href="{{ $image->image }}" >
                            <img class="img-responsive {{ needRotate($image->image_path) ? 'rotate' : '' }}" src="{{ $image->image }}" style="width: 250px; height: 250px;"/>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <br />
    <br />
    <div class="row">

        <h4>{{ getTranslation('conversation') }}</h4>

        <!-- end of user messages -->
        <div class="col-md-8">
            <ul class="messages">

                @if(count($claim->conversations) > 0)
                    @foreach($claim->conversations as $conversation)
                        <li>
                            <div class="message_date">
                                <h3 class="date text-info">{{ date('d', strtotime($conversation->created_at)) }}</h3>
                                <p class="month">{{ date('M', strtotime($conversation->created_at)) }}</p>
                            </div>
                            <div class="message_wrapper">
                                <blockquote class="message">{{ $conversation->conversation }}</blockquote>
                                <br />
                                <p class="url">
                                    @if(count($conversation->files) > 0)
                                        @foreach($conversation->files as $file)
                                            <a href="{{ asset('/files/'.$file->file_name) }}" download="{{ $file->file_name }}"><i class="fa fa-paperclip"></i> {{ $file->file_name }} </a><br>
                                        @endforeach()
                                    @endif
                                </p>
                            </div>
                        </li>
                    @endforeach


                @endif
            </ul>
        </div>
        <div class="col-md-4">
            <form id="demoForm2" data-parsley-validate class="form-horizontal form-label-left dropzone" action="{{ route('claim.conversation.store') }}" method="POST" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <input type="hidden" name="claim_id" value="{{ $claim->id }}">
                <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="description">{{ getTranslation('add_conversation') }} <span class="required">*</span>
                    </label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea id="conversation" col="10" row="15" class="form-control col-md-7 col-xs-12" name="conversation">{{ old('conversation') }}</textarea>
                        @if ($errors->has('conversation'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('conversation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br />
                <br />
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="col-md-8">
                            {{--<input class="pull-left" id="all_files" type="file" name="all_files[]" onchange="javascript:updateList()" multiple/>--}}
                            @if ($errors->has('all_files.0'))
                                <span class="help-block" style="color: red;">
                                <strong>File must be of type pdf, doc, docx.</strong>
                            </span>
                            @endif
                            <div id="fileList"></div>
                        </span>
                        <span class="col-md-4">
                        </span>

                    </div>
                </div>

            </form>
            <button type="submit" id="btn_submit" class="btn btn-success pull-left btn-xs">Submit</button>

        </div>
    </div>

    {{ isUpdated($claim) }}

@endsection

@section('css')
    <link href="{{ asset('/admin/css/simpleLightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/dropzone.css') }}" rel="stylesheet">
    <style>
        table {border:none;}
        hr.style-one {
            border: 0;
            height: 1px;
            background: #333;
            background-image: linear-gradient(to right, #ccc, #333, #ccc);
        }
        .help-block{
            color: #a94442;
        }
        .bg-grey-steel {
            background: #e9edef!important;
        }


        .mt-element-ribbon .ribbon {
            padding: .5em 1em;
            float: left;
            margin: 10px 0 0 -2px;
            clear: left;
            position: relative;
        }
        .mt-element-ribbon {
            position: relative;
            margin-bottom: 30px;
        }
        .mt-element-ribbon .ribbon.ribbon-clip {
            left: -10px;
            margin-left: 0;
        }
        .mt-element-ribbon .ribbon.ribbon-color-danger {
            background-color: #ed6b75;
            color: #fff;
        }
        .mt-element-ribbon .ribbon, .mt-element-ribbon .ribbon.ribbon-color-default, .mt-element-ribbon .ribbon.ribbon-color-default>.ribbon-sub, .mt-element-ribbon .ribbon>.ribbon-sub {
            background-color: #bac3d0;
            color: #384353;
        }
        .mt-element-ribbon .ribbon-content {
            margin: 0;
            padding: 25px;
            clear: both;
        }
        .mt-element-ribbon .ribbon, .mt-element-ribbon .ribbon.ribbon-color-default, .mt-element-ribbon .ribbon.ribbon-color-default>.ribbon-sub, .mt-element-ribbon .ribbon>.ribbon-sub {
            background-color: #bac3d0;
            color: #384353;
        }
        .mt-element-ribbon .ribbon.ribbon-border-hor:after {
            border-top: 1px solid;
            border-bottom: 1px solid;
            border-left: none;
            border-right: none;
            content: '';
            position: absolute;
            top: 5px;
            bottom: 5px;
            left: 0;
            right: 0;
            border-color: #e73d4a;
        }
        b, optgroup, strong {
            font-weight: 800;
        }
        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }


        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: black;
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        img {
            margin-bottom: -4px;
        }

        .caption-container {
            text-align: center;
            background-color: black;
            padding: 2px 16px;
            color: white;
        }

        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        img.hover-shadow {
            transition: 0.3s;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        input[type=file] {
            position: absolute;
            left: 10px;
            top: 0;
            opacity: 0;
            width: 100px;
        }
        img.rotate {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('/admin/js/dropzone.js') }}"></script>
    <script src="{{ asset('/admin/js/simpleLightbox.min.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            $('.imageGallery1 a').simpleLightbox();


            $('#btn_submit').on("click", function() {
                var conversation = $("#conversation").val();

                if(conversation == '') {
                    $("#conversation").css('border-color', 'red');
                    return false;
                }
                if($("#demoForm2").find(".dz-preview.dz-file-preview").length == 0) {
                    $("#demoForm2").submit();
                }
                return false;
            });

            Dropzone.prototype.defaultOptions.dictRemoveFile = "Fjern fil";
            Dropzone.options.demoForm2 = {
                maxFiles: 10,
                parallelUploads: 10,
                autoProcessQueue: false,
                uploadMultiple: true,
                addRemoveLinks: true,
                dictDefaultMessage: 'Træk og slip her',

                init: function (e) {

                    var myDropzone = this;

                    $('#btn_submit').on("click", function() {
                        var conversation = $("#conversation").val();

                        if(conversation == '') {
                            $("#conversation").css('border-color', 'red');
                            return false;
                        }
                        myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                    });
                    myDropzone.on("complete", function(file, xhr, data) {
                        window.location.reload();
                    });
                    // Event to send your custom data to your server
                    myDropzone.on("sending", function(file, xhr, data) {
                        data.append("conversation", $('#conversation').val());
                    });

                }
            };
        });
        function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }
    </script>
@endsection
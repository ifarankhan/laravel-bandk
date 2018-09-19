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
            <div class="mt-element-ribbon bg-grey-steel">
                <form action="{{ route('claim.status') }}" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
                                <div class="ribbon-sub ribbon-clip"></div>{{ getTranslation('claim_details') }}
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
                                    <div class="col-md-6">
                                        <button class=" btn btn-{{ getClaimColor($claim) }} " type="submit">{{ getTranslation('submit') }}</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>


                <div class="row ribbon-content">
                    <div class="col-md-4">
                        <strong>{{ getTranslation('status') }}:</strong> {{ getClaimStatus($claim) }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('department') }}:</strong> {{ ($claim->department) ? $claim->department->name.'('.$claim->department->code.')' : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_contact_person') }}:</strong> {{ ($claim->customer) ? $claim->customer->contact_person : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('claim_type') }}:</strong> {{ ($claim->type) ? $claim->type->name : '' }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('address_1') }}:</strong> {{ ($claim->address1)  ? $claim->address1->address : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('date') }}:</strong> {{ $claim->date }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('address_2') }}:</strong> {{ ($claim->address_2)  ? $claim->address_2 : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('estimate') }}:</strong> {{ $claim->estimate }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_zip_code') }}:</strong> {{ ($claim->customer) ?  $claim->customer->zip_code : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_city') }}:</strong> {{ ($claim->customer) ? $claim->customer->city : '' }}
                    </div>
                </div>
                <div class="row ribbon-content">
                    <div class="col-md-12">
                        <strong>{{ getTranslation('description') }}:</strong> {{ $claim->description }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if(count($claim->images) > 0)
        <div class="row">
            @foreach($claim->images as $key => $image)
                <div class="column">
                    <img src="{{ asset('/images/'.$image->image) }}" style="width:100%; max-height: 150px;min-height: 150px;" onclick="openModal();currentSlide({{ $key }})" class="hover-shadow cursor">
                </div>
            @endforeach
        </div>
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>

            <div class="modal-content">

                @foreach($claim->images as $key => $image)
                    <div class="mySlides">
                        <div class="numbertext">{{ $key + 1 }}</div>
                        <img src="{{ asset('/images/'.$image->image) }}" style="width:100%">
                    </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="caption-container">
                    <p id="caption"></p>
                </div>

                @foreach($claim->images as $key => $image)
                    <div class="column">
                        <img class="demo cursor" src="{{ asset('/images/'.$image->image) }}" style="width:100%" onclick="currentSlide({{ $key + 1 }})" alt="Nature and sunrise">
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
                                            <a href="{{ asset('/files/'.$file->file_name) }}" download="{{ $file->file_name }}"><i class="fa fa-paperclip"></i> {{ $file->file_name }} </a>
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('claim.conversation.store') }}" method="POST" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <input type="hidden" name="claim_id" value="{{ $claim->id }}">
                <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="description">{{ getTranslation('add_conversation') }} <span class="required">*</span>
                    </label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea type="text" id="conversation" col="10" row="15" class="form-control col-md-7 col-xs-12" name="conversation">{{ old('conversation') }}</textarea>
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
                            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-link"></i>{{ getTranslation('attach_file') }}</button>
                            <input class="pull-left" id="all_files" type="file" name="all_files[]" onchange="javascript:updateList()" multiple/>
                            @if ($errors->has('all_files.0'))
                                <span class="help-block" style="color: red;">
                                <strong>File must be of type pdf, doc, docx.</strong>
                            </span>
                            @endif
                            <div id="fileList"></div>
                        </span>
                        <span class="col-md-4">
                            <button type="submit" class="btn btn-success pull-left btn-xs">Submit</button>
                        </span>

                    </div>
                </div>

            </form>
        </div>
    </div>

    {{--<div id="status" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>--}}

@endsection

@section('css')
    <style>
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
    </style>
@endsection

@section('js')
    <script>
        function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        updateList = function() {
            var input = document.getElementById('all_files');
            var output = document.getElementById('fileList');

            output.innerHTML = '<ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML += '</ul>';
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>
@endsection
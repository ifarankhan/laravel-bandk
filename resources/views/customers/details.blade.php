@extends('layouts.app-admin')
@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('customer.index') }}">{{ getTranslation('customer') }}</a></li>
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
                <div class="row ribbon-content">
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_name') }}:</strong> {{ $customer->name }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_address') }}:</strong> {{ ($customer->address) ? $customer->address : '' }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_zip_code') }}:</strong> {{ $customer->zip_code }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_city') }}:</strong> {{ $customer->city }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_contact_person') }}:</strong> {{ ($customer->contact_person) ? $customer->contact_person : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_bank_number') }}:</strong> {{ ($customer->bank_number)  ? $customer->bank_number : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_account_number') }}:</strong> {{ ($customer->account_number)  ? $customer->account_number : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_insurance_company_name') }}:</strong> {{ ($customer->insurance_company_name)  ? $customer->insurance_company_name : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_policy_number') }}:</strong> {{ ($customer->policy_number)  ? $customer->policy_number : ''}}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ getTranslation('customer_emails') }}:</strong> {!!  ($customer->emails)  ? implode(', ',json_decode($customer->emails)) : '' !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th>{{ getTranslation('claim_created_at') }}</th>
                <th>{{ getTranslation('claim_number') }}</th>
                <th>{{ getTranslation('date') }}</th>
                <th>{{ getTranslation('claim_type') }}</th>
                <th>{{ getTranslation('estimate') }}</th>
                <th>{{ getTranslation('department') }}</th>
                <th>{{ getTranslation('address_1') }}</th>
                <th>{{ getTranslation('address_2') }}</th>
                <th>{{ getTranslation('actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customer->claims as $claim)
            <tr class="alert alert-{{ getClaimColor($claim) }}">
                <td>{{ $claim->created_at }}</td>
                <td>{{ $claim->id }}</td>
                <td>{{ $claim->date }}</td>
                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                <td>{{ $claim->estimate }}</td>
                <td>{{ ($claim->department) ? $claim->department->name.'('.$claim->department->code.')' : ''}}</td>
                <td>{{ ($claim->address1)  ? $claim->address1->address : ''}}</td>
                <td>{{ ($claim->address_2)  ? $claim->address_2 : ''}}</td>
                <td>
                    <a href="{{ route('claim.details', ['id'=> $claim->id]) }}" class="btn btn-success">{{ getTranslation('details') }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection

@section('css')
    <style>
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
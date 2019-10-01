@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('category.index') }}">{{ getTranslation('categories') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="{{ route('category.index') }}" method="GET">
                <div class="row">
                    <div class="form-group form-group-sm col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <label for="customer_id">
                                    {{ getTranslation('customer') }}
                                </label>
                                <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                    <option value="">{{ getTranslation('select_customer') }}</option>
                                    @foreach($customers as $aCustomer)
                                        <option value="{{ $aCustomer->id }}" {{ (session('customer_id') && session('customer_id') == $aCustomer->id) ? 'selected="selected"' : '' }}>{{ $aCustomer->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group form-group-sm ">
                                    <label for="customer_id">
                                        &nbsp;
                                    </label>
                                    <div class="">
                                        <button class="btn btn-danger" type="submit">{{ getTranslation('submit') }}</button>
                                        <a class="btn btn-success" href="{{ route('reset.url') }}">{{ getTranslation('reset') }}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Categories Lists</h2>
                    <a href="{{ route('category.create') }}" class="btn btn-danger pull-right">Opret</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    {{--<div id="tree-container"></div>--}}
                    <table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Parent</th>
                            <th>Customer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr id="content_{{ $category->id }}">
                                <td>{{ $category->title }}</td>
                                <td>{{ ($category->parent) ? $category->parent->title :  ''}}</td>
                                <td>{{ ($category->customer) ? $category->customer->name :  'All'}}</td>
                                <td>
                                    @if($search && isset($search['customer_id']))
                                        <a href="{{ route('category.customer.content', ['category_id'=> $category->id, 'id' => $search['customer_id']]) }}" class="btn btn-info">{{ getTranslation('content') }}</a>
                                    @endif
                                    <a href="{{ route('category.edit', ['id'=> $category->id]) }}" class="btn btn-success">{{ getTranslation('edit') }}</a>
                                    <button data-id="{{ $category->id }}" data-csrf="{{ csrf_token() }}" data-url="{{ route('category.delete', ['id'=> $category->id]) }}" class="btn btn-danger delete" data-toggle="modal">{{ getTranslation('delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-model" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Category:</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete the category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal" id="delete">Slet</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('/admin/js/themes/default/style.min.css') }}" />
@endsection

@section('js')
@endsection
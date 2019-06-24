@extends('layouts.app-admin')

@section('content')
    <form action="{{ route('dashboard.index') }}" method="GET">
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
                                <option value="{{ $aCustomer->id }}" {{ ($search && isset($search['customer_id']) && $search['customer_id'] == $aCustomer->id) ? 'selected="selected"' : '' }}>{{ $aCustomer->name }}</option>
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    @if($search && isset($search['customer_id']))
        <div class="row">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('department.index') }}?search[customer_id]={{ $search['customer_id'] }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ getTranslation('department') }}</div>
                    <h3>&nbsp</h3>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('claim.index') }}?search[customer_id]={{ $search['customer_id'] }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ getTranslation('claims') }}</div>
                    <h3>&nbsp</h3>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('category.index') }}?search[customer_id]={{ $search['customer_id'] }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-briefcase"></i>
                    </div>
                    <div class="count">{{ getTranslation('categories') }}</div>
                    <h3>&nbsp</h3>
                </div>
            </a>
        </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="{{ route('content.index') }}?search[customer_id]={{ $search['customer_id'] }}">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-briefcase"></i>
                        </div>
                        <div class="count">{{ getTranslation('content') }}</div>
                        <h3>&nbsp</h3>
                    </div>
                </a>
            </div>


    </div>
    @endif
    <div class="row">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('users.index') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $userCount }}</div>

                    <h3>{{ getTranslation('total_users') }}</h3>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('customer.index') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $customersCount }}</div>

                    <h3>{{ getTranslation('total_customer') }}</h3>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('claim.index') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-briefcase"></i>
                    </div>
                    <div class="count">{{ $claimCount }}</div>

                    <h3>{{ getTranslation('total_claims') }}</h3>
                </div>
            </a>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('claim.index') }}?search[date]={{ date('Y-m-d') }}">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-briefcase"></i>
                    </div>
                    <div class="count">{{ $todayCount }}</div>

                    <h3>{{ getTranslation('today_claims') }}</h3>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ getTranslation('today_claims') }}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ getTranslation('customer_name') }}</th>
                        <th>{{ getTranslation('claim_type') }}</th>
                        <th>{{ getTranslation('estimate') }}</th>
                        <th>{{ getTranslation('date') }}</th>
                        <th>{{ getTranslation('department') }}</th>
                        <th>{{ getTranslation('address_1') }}</th>
                        <th>{{ getTranslation('address_2') }}</th>
                        <th>{{ getTranslation('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($todayClaims as $claim)
                            <tr>
                                <td>{{ ($claim->customer && $claim->customer->name)  ? $claim->customer->name : ''}}</td>
                                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                                <td>{{ $claim->estimate }}</td>
                                <td>{{ $claim->date }}</td>
                                <td>{{ ($claim->department) ? $claim->department->name : ''}}</td>
                                <td>{{ ($claim->address1)  ? $claim->address1->address : ''}}</td>
                                <td>{{ ($claim->address_2)  ? $claim->address_2 : ''}}</td>
                                <td>
                                    <a href="{{ route('claim.details', ['id'=> $claim->id]) }}" class="btn btn-success">{{ getTranslation('details') }}</a>
                                    <a href="{{ route('claim.edit', ['id'=> $claim->id]) }}" class="btn btn-info">{{ getTranslation('edit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
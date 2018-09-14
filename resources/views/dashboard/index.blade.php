@extends('layouts.app-admin')

@section('content')
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
                                <td>{{ ($claim->type) ? $claim->type->name : '' }}</td>
                                <td>{{ $claim->estimate }}</td>
                                <td>{{ $claim->date }}</td>
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

            </div>
        </div>
    </div>
@endsection
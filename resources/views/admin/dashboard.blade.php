@extends('admin.layout.app')
@section('title', 'Dashboard')
@push('css')
<style>
    .info {
        margin-bottom: 0px !important;
    }
</style>
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-header">
                    <div class="w-info">
                        <h6 class="value">Total Influancers</h6>
                    </div>
                </div>
                <div class="w-content">
                    <div class="w-info">
                        <p class="value">
                            {{$data['influancer_total']}}
                            <span>
                                ({{$data['influancer_month']}}) this Month
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-header">
                    <div class="w-info">
                        <h6 class="value">Total Users</h6>
                    </div>
                </div>
                <div class="w-content">
                    <div class="w-info">
                        <p class="value">
                            {{$data['user_total']}}
                            <span>
                                ({{$data['user_month']}}) this Month
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-header">
                    <div class="w-info">
                        <h6 class="value">Purchases & Unlocks</h6>
                    </div>
                </div>
                <div class="w-content">
                    <div class="w-info">
                        <p class="value">
                            451
                            <span>
                                this Month
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-three" style="height:158.6px;">
            <div class="widget-content">
                <div class="account-box">
                    <div class="info">
                        <div class="inv-title">
                            <h5 class="">Total Balance</h5>
                        </div>
                        <div class="inv-balance-info">
                            <p class="inv-balance">₹ {{$data['income']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="">
                    <h5 class="">Monthly Income</h5>
                    <p class="value">
                        <span>
                            In ₹ (Rupees)
                        </span>
                    </p>
                </div>
            </div>

            <div class="widget-content">
                <div id="uniqueVisits"></div>
            </div>
        </div>
    </div>
</div>
@endsection
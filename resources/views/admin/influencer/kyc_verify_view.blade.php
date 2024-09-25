@extends('admin.layout.app')

@section('title', 'Kyc Verify View')

@push('css')
<style>
    .kyc_image{
        width: 70%;
        height: 250px;
        margin: auto;
    }

    .kyc_image > img{
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .zoom {
        display:inline-block;
        position: relative;
    }
</style>
@endpush

@section('content')
<div class="container-xxl p-0">

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Influncer</a></li>
                <li class="breadcrumb-item active" aria-current="page">KYC Verify View</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row">

        <div id="card_1" class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">

                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                            <h4>PAN number</h4>
                            <p>{{ $kyc_data->kyc->pan_card }}</p>
                        </div>
                        @if(!empty($kyc_data->kyc->gst_no))
                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                            <h4>GSTIN(optional)</h4>
                            <p>{{ $kyc_data->kyc->gst_no }}</p>
                        </div>
                        @endif
                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                            <h4>Aadhar Number</h4>
                            <p>{{ $kyc_data->kyc->aadhar_no }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h2>Billing Details</h2>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Billing Name</h4>
                            <p>{{ $kyc_data->kyc->billing_name }}</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Address</h4>
                            <p>{{ $kyc_data->kyc->address }}</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>City</h4>
                            <p>{{ $kyc_data->kyc->city }}</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Pincode</h4>
                            <p>{{ $kyc_data->kyc->pincode }}</p>
                        </div>
                    </div>
                    <hr>
                    <h2>Bank Settings</h2>
                    @if(!empty($kyc_data->kyc->upi_id))
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>UPI Address</h4>
                                <p>{{ $kyc_data->kyc->upi_id }}</p>
                            </div>
                        </div>
                    @endif
                    <hr>
                    @if(!empty($kyc_data->kyc->account_no))
                        <div class="row">
                            <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                <h4>Bank Name</h4>
                                <p>{{ $kyc_data->kyc->bank_name }}</p>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                <h4>Account Number</h4>
                                <p>{{ $kyc_data->kyc->account_no }}</p>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                <h4>Account Holder Name</h4>
                                <p>{{ $kyc_data->kyc->account_holder }}</p>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                <h4>IFSC code</h4>
                                <p>{{ $kyc_data->kyc->account_ifsc }}</p>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div id="card_11" class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>KYC Document</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        @if(!empty($kyc_data->kyc->docs))
                                            @php($image = json_decode($kyc_data->kyc->docs))
                                            @foreach($image as $key => $value2)
                                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 mx-auto mb-5">
                                                    <div class="mb-md-0 mb-4 kyc_image" id="kyc_image-{{$key}}">
                                                        <img src="{{ asset('posts/').'/'.$value2 }}" class="card-img-top kyc_zoom_img"
                                                            alt="...">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.kyc_image').each(function(element){
            console.log('#'+ $(this).attr('id'));
            $('#'+ $(this).attr('id')).zoom({ on:'click' });
        });
        
    });
    
</script>
@endpush
@extends('admin.layout.app')
@section('title', 'Kyc Verify View')
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
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                            <h4>GSTIN(optional)</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                            <h4>Aadhar Number</h4>
                            <p>445456242783587587</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h2>Billing Details</h2>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Billing Name</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Address</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>City</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Pincode</h4>
                            <p>445456242783587587</p>
                        </div>
                    </div>
                    <hr>
                    <h2>Bank Settings</h2>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                            <h4>UPI Address</h4>
                            <p>445456242783587587</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Bank Name</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Account Number</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>Account Holder Name</h4>
                            <p>445456242783587587</p>
                        </div>
                        <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                            <h4>IFSC code</h4>
                            <p>445456242783587587</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div id="card_11" class="col-xxl-6 col-xl-6 col-lg-6  col-md-6 layout-spacing">
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
                                        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-6 mx-auto">
                                            <div class=" mb-md-0 mb-4">
                                                <img src="{{ asset('admin/src/assets/img/grid-blog-style-2.jpeg')}}"
                                                    class="card-img-top" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="card_11" class="col-xxl-6 col-xl-6 col-lg-6  col-md-6 layout-spacing">
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
                                        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-6 mx-auto">
                                            <div class=" mb-md-0 mb-4">
                                                <img src="{{ asset('admin/src/assets/img/grid-blog-style-2.jpeg')}}"
                                                    class="card-img-top" alt="...">
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






    </div>

</div>

</div>



@endsection
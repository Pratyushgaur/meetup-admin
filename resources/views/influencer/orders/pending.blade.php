@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Pending Orders</span>
        </div>
    </nav>
</header>
<main>

    <div class="container-fluid main-pending-container">
        <div class="pending_order_container">
            <div class="feature--heading--order mt-1">
                <span style="font-size:14px">Order ID : <b>#2407415041023</b></span>
                <span style="font-size:11px">Date 24/07/24 15:04</span>
            </div>

            <div class="deliver--detail--content pl-1">
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Service :
                    </div>
                    <div class="col-9 p-0">
                        <b>Exclusive Post Unlock</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Buyer :
                    </div>
                    <div class="col-9 p-0">
                        <b>Sahil Bagga</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Amount :
                    </div>
                    <div class="col-9 p-0">
                        <b>399.0</b>
                    </div>
                </div>
                <!-- <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Earning :
                    </div>
                    <div class="col-9 p-0">
                        <b>279.3</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        TDS :
                    </div>
                    <div class="col-9 p-0">
                        <b>3.99</b>
                    </div>
                </div> -->

                <a href="javascript:void(0)" class="btn-chat">
                    Chat
                </a>
                <a href="javascript:void(0)" class="btn-deliver">
                    Mark Delivered
                </a>
            </div>
        </div>

        <div class="pending_order_container">
            <div class="feature--heading--order mt-1">
                <span style="font-size:14px">Order ID : <b>#2407415041023</b></span>
                <span style="font-size:11px">Date 24/07/24 15:04</span>
            </div>

            <div class="deliver--detail--content pl-1">
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Service :
                    </div>
                    <div class="col-9 p-0">
                        <b>Exclusive Post Unlock</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Buyer :
                    </div>
                    <div class="col-9 p-0">
                        <b>Sahil Bagga</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Amount :
                    </div>
                    <div class="col-9 p-0">
                        <b>399.0</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Earning :
                    </div>
                    <div class="col-9 p-0">
                        <b>279.3</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        TDS :
                    </div>
                    <div class="col-9 p-0">
                        <b>3.99</b>
                    </div>
                </div>

                <a href="javascript:void(0)" class="btn-chat">
                    Chat
                </a>
                <a href="javascript:void(0)" class="btn-deliver">
                    Mark Delivered
                </a>
            </div>
        </div>

        <div class="pending_order_container">
            <div class="feature--heading--order mt-1">
                <span style="font-size:14px">Order ID : <b>#2407415041023</b></span>
                <span style="font-size:11px">Date 24/07/24 15:04</span>
            </div>

            <div class="deliver--detail--content pl-1">
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Service :
                    </div>
                    <div class="col-9 p-0">
                        <b>Exclusive Post Unlock</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Buyer :
                    </div>
                    <div class="col-9 p-0">
                        <b>Sahil Bagga</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Amount :
                    </div>
                    <div class="col-9 p-0">
                        <b>399.0</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Earning :
                    </div>
                    <div class="col-9 p-0">
                        <b>279.3</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        TDS :
                    </div>
                    <div class="col-9 p-0">
                        <b>3.99</b>
                    </div>
                </div>

                <a href="javascript:void(0)" class="btn-chat">
                    Chat
                </a>
                <a href="javascript:void(0)" class="btn-deliver">
                    Mark Delivered
                </a>
            </div>
        </div>
    </div>

</main>
@endsection
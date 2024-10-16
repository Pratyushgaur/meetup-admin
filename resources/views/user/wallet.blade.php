@extends('influencer.login_pages.app')
@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

<style>
    .active{
        background-color: black;
        color: white;
    }
    .imagebox{
        display:flex;
        justify-content:center;
        align-items:center;
        margin-top:30px;
    }
    .amount-box h2{
        text-align:center;
        margin-top:15px;
        font-family: "Roboto Mono", monospace;
        font-optical-sizing: auto;

    }
    .add_money-box{
        display:flex;
        justify-content:center;
        align-items:center;
        margin-top:20px;
        
    }
    .add_money-box a{
        background:black;
        padding:10px;
        color:white;
        border-radius:30px;
        font-weight:500;
        text-decoration:none;
    }
    hr{
        box-shadow:2px 0px 1px black;
    }
    .transaction_add{
        font-weight:bold;
        color:green;
        

    }
    .transaction_down{
        font-weight:bold;
        color:#b41d1d;
    }
    .wallet_degrade{
        background-color:#dfb7c4 !important;
    }
    
</style>
@endpush
@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Wallet</span>
            </li>
        </ul>
    </nav>
</header>
<main class="mb-70">
    <div class="container-fluid">
        <div class="imagebox" >
            <img src="{{ URL::TO('Assets/images/wallet-icon.png') }}" alt="" width="100" >
        </div>
        <div class="amount-box" >
           <h2>{{auth()->guard('customer')->user()->balance}}</h2>
        </div>
        <div class="add_money-box" >
           <a href="#" onclick="addmoney()">+ Add Money</a>
        </div>
        <hr>

    </div>
    @if(!empty($transaction))
        @foreach($transaction as $key =>$value)
        <div class="notification--main--content">

            <div class="notification--image--section">
                @if($value->transction_type == 1)
                <div class="main--notification--image" style="background-color: #aed6f1; font-weight:bold; font-size:30px;">
                    +
                </div> 
                @else
                <div class="main--notification--image wallet_degrade" style="background-color: #aed6f1; font-weight:bold; font-size:30px;">
                    -
                </div> 
                @endif
                
            </div>

            <div class="notification--content-section">
                <div class="notification--content" style="margin-top:10px;">
                    {{$value->transction_title}} 
                </div>
                <p>
                    {{$value->transction_desc}} 
                </p>
            </div>
            @if($value->transction_type == 1)
            <div class="notification--back-image--section transaction_add">
                {{$value->amount}}
            </div>
            @else
            <div class="notification--back-image--section transaction_down">
                {{$value->amount}}
            </div>
            @endif
           

        </div>
        <!--  -->
        <!-- <div class="notification--main--content">

            <div class="notification--image--section ">
                <div class="main--notification--image wallet_degrade" style="background-color: #aed6f1; font-weight:bold; font-size:30px;">
                    -
                </div> 
            </div>

            <div class="notification--content-section">
                <div class="notification--content" style="margin-top:10px;">
                    Post Unlock 
                </div>
                <p>
                    sahil bagga post unlock
                </p>
            </div>

            <div class="notification--back-image--section transaction_down">
                1000.00
            </div>

        </div> -->
        @endforeach
    @endif
</main>

<div id="createmodel">
    <div class="modelbox stream-model" style="min-height:150px;">
        <div class="modelnav">
            <div class="model--nav--head">Recharge</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close " onclick="closeMdel()" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form method="post" action="{{ route("user.wallet.add",request()->segment(2)) }}">
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1"> Amount </label>
                <input type="number" name="amount" class="form-control live-stram-input" id="Input1" placeholder="Enter Amount You want to recharge " required>
            </div>
            
            
            
            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Recharge
                </button>
            </div>
        </form>
    </div>
</div>

@include('user.footer')
@endsection

@push('js')
<script>
    $(document).ready(function(){
        

    })
    function addmoney(){
        $("#createmodel").css('display', 'flex');
    }
    function closeMdel(){
        $("#createmodel").css('display', 'none');
        
    }
</script>
@endpush
@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Login</span>
            </li>
        </ul>
    </nav>
</header>
<main>
    <!-- Logo -->
    <div class="container-fluid logo--section">
        <img src="{{ asset('assets/images/meet_up_logo.png') }}" alt="" class="meetup--logo">
    </div>
    <!-- /Logo -->

    <!-- Text -->
    <div class="container-fluid text-center">
        <p class="signup--text">
            Login to 
            <span class="signup--text--heading">
                Meet-UpMe
            </span>
            creator's Dashboard
        </p>
    </div>
    <!-- /Text -->

    <!-- Sign up form -->
    <div class="container-fluid">
       
        <form action="{{ route('influencer.login') }}" method="post" class="signup--form">
        
            @csrf

            <div class="input--section">
                <input name="username" value="{{ old('username') }}" type="text" class="form-control form--input" placeholder="Enter Username Or Mobile">
            </div>
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @if(Session::has('error'))
                    <span class="text-danger">{{  Session::get('error') }}</span>
                @endif

            <div class="input--section mt-3">
                <span class="text-danger">
                    We will send 4 digit OTP on your Registered Mobile Number 
                </span>
            </div>

            <button class="btn btn--submit mt-3">
                Login via OTP
            </button>
        </form>
    </div>
    <!-- /Sign up form -->
</main>
@endsection
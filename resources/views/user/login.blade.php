@extends('user.layout.app')

@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <a href="javascript:void(0)" onclick="history.back()"  class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <li class="nav-item">
                <span class="header-text">Login</span>
            </li>
            
        </ul>
    </nav>
</header>
<main>
    <!-- Logo -->
    <div class="container-fluid logo--section" style="height:15vh !important;">
      
    </div>
    <!-- /Logo -->

    

    <!-- Sign up form -->
    <div class="container-fluid">
       
        <form action="{{ route('user.login.post',request()->segment(2)) }}" method="post" class="signup--form">
        
            @csrf

            <div class="input--section">
                <input name="username" value="{{ old('username') }}" type="text" class="form-control form--input" placeholder="Enter Mobile number to login">
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

            <button class="btn btn--submit mt-3 mb-2">
                Login via OTP
            </button>
            
            <a href="{{ route('user.register',request()->segment(2))  }}" >don't Have an Account | Signup</a>
        </form>
    </div>
    <!-- /Sign up form -->
</main>
@endsection
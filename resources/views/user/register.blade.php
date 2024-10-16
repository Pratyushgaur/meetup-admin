@extends('user.layout.app')

@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <a href="javascript:void(0)" onclick="history.back()"  class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <li class="nav-item">
                <span class="header-text">Register</span>
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
        @if(Session::has('error'))
            <span class="text-danger">{{  Session::get('error') }}</span>
        @endif
        <form action="{{ route('user.register.post',request()->segment(2)) }}" method="post" class="signup--form">
        
            @csrf

            <div class="input--section">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control form--input" placeholder="Enter Name number">
            </div>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input--section">
                <input name="email" value="{{ old('email') }}" type="text" class="form-control form--input" placeholder="Enter email">
            </div>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input--section">
                <input name="mobile" value="{{ old('mobile') }}" type="text" class="form-control form--input" placeholder="Enter Mobile number">
            </div>
            @error('mobile')
            <span class="text-danger">{{ $message }}</span>
            @enderror
                

            

            <button class="btn btn--submit mt-3 mb-2">
                Login via OTP
            </button>
            
            <a href="{{ route('user.login',request()->segment(2))  }}" >Already have an account click to login</a>
        </form>
    </div>
    <!-- /Sign up form -->
</main>
@endsection
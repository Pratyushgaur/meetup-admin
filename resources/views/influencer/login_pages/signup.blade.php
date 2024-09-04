@extends('influencer.login_pages.app')


@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Signup</span>
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
            Signup to 
            <span class="signup--text--heading">
                Meet-UpMe
            </span>
            creator's Dashboard
        </p>
    </div>
    <!-- /Text -->

    <!-- Sign up form -->
    <div class="container-fluid">
   
        <form action="{{Route('influencer.signup.post')}}" method="post" class="signup--form">
            @csrf
            <div class="input--section">
                <input type="text" class="form-control form--input" name="fullname" placeholder="Full Name">
                @error('fullname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input--section">
                <select name="gender" id="gender--select" class="form-control">
                    <option value selected disabled>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                @error('gender')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input--section">
                <input type="email" class="form-control" name="email" placeholder="Enter your Email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input--section">
                <select name="country_code" id="" class="form-control">
                    <option value="+91" selected>+91</option>
                    <option value="+92">+92</option>
                    <option value="+93">+93</option>
                    <option value="+94">+94</option>
                    <option value="+95">+95</option>
                </select>

                <input type="number" class="form-control" name="mobile" placeholder="Moblie Number">
                
            </div>
            @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            <div class="input--section mt-3">
                <span class="text-danger">
                    We will send 4 digit OTP on your Registered Mobile Number and Email address
                </span>
            </div>
            

            <button class="btn btn--submit mt-3">
                Proceed
            </button>
        </form>
    </div>
    <!-- /Sign up form -->
</main>
@endsection
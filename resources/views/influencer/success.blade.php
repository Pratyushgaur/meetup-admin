@extends('influencer.login_pages.app')

@push('css')
<style>
   .box{
        display:flex;
        justify-content:center;
        align-items:center;
        margin-top:100px;

    }
    .message h3{
        text-align:center;
    }
    .button-con{
        display:flex;
        justify-content:center;
        align-items:center;
        padding:0px 45px 0px 45px;
    }
    .button-con button{
        border:1px solid black;
       border-radius:5px;
       margin-top:50px;
       background:black;
       color:#fff;
       font-weight:bold;


    } 
</style>
@endpush
@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Congratulation</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-70">
    <div class="container-fluid">
        <div class="box" >
            <img src="{{ url('Upload_done.gif') }}" alt="">
            
        </div>
        <div class="message">
            <h3>Post Uploded</h3>
        </div>
        <div class="button-con">
            <button type="submit" onclick="window.location.href='{{ route('influencer.post','exclusive') }}'" class="btn btn-lg btn-block">
                View Post
            </button>
        </div>
        
      
    </div>
</main>




@push('js')

@endpush

@endsection

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Success</title>
    <style>
        .box{
            display:flex;
            justify-content:center;
            align-items:center;

        }
    </style>
</head>
<body>
    <div class="box" >
        <img src="{{ url('Upload_done.gif') }}" alt="">
    </div>
</body>
</html> -->
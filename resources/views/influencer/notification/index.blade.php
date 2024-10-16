@extends('influencer.login_pages.app')

@push('css')
    <style>
        
    </style>
@endpush
@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Notifications</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-70">

    <div class="notification--main--content">

        <div class="notification--image--section">
            <div class="main--notification--image" style="background-color: #aed6f1;">
                <img src="{{ asset('assets/images/lock.png') }}" alt="" width="35" height="40" >
            </div> 
        </div>

        <div class="notification--content-section">
            <div class="notification--content">
                Congratulations! New post unlocked by <span class="notification--name">Sahil Bagga</span>
            </div>
            <p>
                New Exclusive Post Unlock
            </p>
        </div>

        <div class="notification--back-image--section">
            <img src="{{ asset('assets/images/girls1.jpg') }}" alt="" class="notification--back-image">
        </div>

    </div>

    <div class="notification--main--content">

        <div class="notification--image--section">

            <div class="main--notification--image" style="background-color: #f9c1fe;">
                <img src="{{ asset('assets/images/gift-chat.png') }}" alt="">
            </div> 
        </div>

        <div class="notification--content-section">
            <div class="notification--content">
                Congratulations! New subscription purchased by <span class="notification--name">Sahil Bagga</span>
            </div>
            <p>
                New Exclusive Post Unlock
            </p>
        </div>

    </div>

    <div class="notification--main--content">

        <div class="notification--image--section">

            <div class="main--notification--image" style="background-color: #c6c2ff;">
                <img src="{{ asset('assets/images/VIP.png') }}" alt="">
            </div> 
        </div>

        <div class="notification--content-section">
            <div class="notification--content">
                Congratulationsl New post unlocked by <span class="notification--name">Sahil Bagga</span>
            </div>
            <p>
                New Exclusive Post Unlock
            </p>
        </div>

    </div>
    
</main>

@include('influencer.footer.footer')


@endsection
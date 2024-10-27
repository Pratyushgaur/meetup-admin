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
            <div class="main--notification--image" style="background-color: #c6c2ff;">
                <img src="{{ asset('assets/images/padlock.png') }}" alt="" width="35" height="40" >
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

            <div class="main--notification--image" style="background-color: #c6c2ff;">
                <img src="{{ asset('assets/images/4f41576fb530f59339aaa1acc7d0043d@2x.png') }}" alt="">
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
                <img src="{{ asset('assets/images/crown.png') }}" alt="">
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
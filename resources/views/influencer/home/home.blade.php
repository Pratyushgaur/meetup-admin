@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--home">
        <div class="navbar--menu" onclick="openMenu()">
            <img src="{{ asset('assets/images/menu.png') }}" alt="" class="menu--icon">
        </div>
        <div class="navbar--options">
            <div class="navber--options--container" id="live--model--trigger">
                <a href="javascript:void(0)" class="live--btn" style="background-color: #58e24e;">
                    <img src="{{ asset('assets/images/home-live.png') }}" alt="" class="live--icon">
                    Live
                </a>
            </div>
            <div class="navber--options--container">
                <a href="javascript:void(0)" class="live--btn" style="background-color: #cb5eed;">
                    <img src="{{ asset('assets/images/home-inbox.png') }}" alt="" class="inbox--icon">
                    Inbox
                </a>
                <span class="new--inbox--indicator"></span>
            </div>
            <div class="navber--options--container">
                <img src="{{ asset('assets/images/home-bell.png') }}" alt="" class="bell--icon">
            </div>
            <div class="navber--options--container">
                <img src="{{ asset('assets/images/home-bell2.png') }}" alt="" class="bell--icon">
            </div>
        </div>
    </nav>
</header>

<main class="mb-70">
    <div class="container-fluid">

        <!-- Home Profile Details -->
        <div class="home--view--card">
            <div class="home--view--card--section" style="background-image:url({{ asset('assets/images/home-background.jpeg') }});">
                <div class="name--profile--section">
                    <div class="home--profile--section">
                        <img src="{{ asset('assets/images/verify-badge.png') }}" alt="" class="home--profile--image">
                    </div>
                    <div class="home--name--section">
                        <p class="home--name">
                            {{auth()->user()->name}}
                        </p>
                        <a href="{{route('influencer.profile.edit')}}" class="home--edit--profile--btn">
                            Edit Profile
                        </a>
                    </div>
                </div>
                <div class="home--profile--details--section">
                    <div class="home--profile--detail--btn">
                        <div class="profile--detail--btn--content">
                            Earned<br>
                            <span class="home--amount">1000.00</span>
                        </div>
                        <div class="profile--detail--btn--image--section">
                            <img src="{{ asset('assets/images/earned-btn.png') }}" alt="" class="detail--btn--image">
                        </div>
                    </div>
                    <div class="home--profile--detail--btn">
                        <div class="profile--detail--btn--content">
                            Paid<br>
                            <span class="home--amount">800.00</span>
                        </div>
                        <div class="profile--detail--btn--image--section">
                            <img src="{{ asset('assets/images/paid-btn.png') }}" alt="" class="detail--btn--image">
                        </div>
                    </div>
                    <div class="home--profile--detail--btn">
                        <div class="profile--detail--btn--content">
                            Balance<br>
                            <span class="home--amount">{{auth()->user()->balance}}</span>
                        </div>
                        <div class="profile--detail--btn--image--section">
                            <img src="{{ asset('assets/images/balance-btn.png') }}" alt="" class="detail--btn--image">
                        </div>
                    </div>
                </div>
                <p class="payout--detail--setion">
                    Your next payout day is <b>Sunday 2024-08-04</b>
                </p>
            </div>
        </div>
        <!-- /Home Profile Details -->

        <!-- Home Link Section -->
        <div class="home--profile--linkSection">
            <div class="home--link--input">
                <input type="text" name="" id="link--input" class="link--input text-truncate" placeholder="qwetrertuytyuitywerertyrtyrtueyrweteruirturty">
                <button class="btn link--copy--button" onclick="CopyLink()">Copy</button>
            </div>
            <div class="home--link--details">
                <p class="home--link--details--heading">
                    How it works?
                </p>
                <p class="home--link--details--para">
                    Promote your app link & start earning
                </p>
                <div class="home--working--list">
                    <div class="home--working--content">
                        <div class="dot--section">
                            <div class="dot">
                                •
                            </div>
                        </div>
                        <div class="content">
                            Copy the below link and put it in your instagram Bio
                        </div>
                    </div>

                    <div class="home--working--content">
                        <div class="dot--section">
                            <div class="dot">
                                •
                            </div>
                        </div>
                        <div class="content">
                            Put a story everyday and promote your app on all social platforms
                        </div>
                    </div>

                    <div class="home--working--content">
                        <div class="dot--section">
                            <div class="dot">
                                •
                            </div>
                        </div>
                        <div class="content">
                            Let's start making some money!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Home Link Section -->

        <!-- Account Detials -->
        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg,#eddfdf, #edb5e6);">
                    <p class="detail--bar--heading">
                        Pending Orders : 0
                    </p>
                    <p class="detail--bar--content">
                        Amount : 00.00
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #7ebaff;">
                    <img src="{{ asset('assets/images/pending.png') }}" alt="" height="55" width="55">
                </div>
            </a>
        </div>

        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg ,#e0e9ee, #8999e4);">
                    <p class="detail--bar--heading">
                        Last Post
                    </p>
                    <p class="detail--bar--content">
                        9 Months ago
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #f84c4c;">
                    <img src="{{ asset('assets/images/add-post.png') }}" alt="" height="40" width="50">
                </div>
            </a>
        </div>

        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg ,#cceed1, #3aa351);">
                    <p class="detail--bar--heading">
                        Profile Visitors
                    </p>
                    <p class="detail--bar--content">
                        10 This Month
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #9cb2bf;">
                    <img src="{{ asset('assets/images/visitors.png') }}" alt="" height="45" width="45">
                </div>
            </a>
        </div>

        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg ,#99acee, #3b4cce);">
                    <p class="detail--bar--heading">
                        Notification Enabled
                    </p>
                    <p class="detail--bar--content">
                        266 Fans
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #f22828;">
                    <img src="{{ asset('assets/images/home-notification.png') }}" alt="" height="40" width="40">
                </div>
            </a>
        </div>

        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg,#edb6cd, #d4383b);">
                    <p class="detail--bar--heading">
                        Yesterday Insights
                    </p>
                    <p class="detail--bar--content">
                        Click to view
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #bcbee7;">
                    <img src="{{ asset('assets/images/analytics.png') }}" alt="" height="40" width="40">
                </div>
            </a>
        </div>

        <div>
            <a href="javascript:void(0)" class="account--details--section">
                <div class="detail--bar" style="background-image: linear-gradient( 90deg,#dfbeed, #933e82);">
                    <p class="detail--bar--heading">
                        Last week Analytics
                    </p>
                    <p class="detail--bar--content">
                        Click to view
                    </p>
                </div>
                <div class="detail--round--icon" style="background-color: #ed9df2;">
                    <img src="{{ asset('assets/images/analytics.png') }}" alt="" height="40" width="40">
                </div>
            </a>
        </div>
        <!-- /Account Detials -->

        <!-- Whatsapp Notification -->
        <div class="whatsapp--notification--section border">
            <div class="whatsapp--notification--container" style="background-image: url({{ asset('assets/images/whatsapp-icon.png') }})">
                <p class="whatsapp--notification--heading">
                    WhatsApp Notifications
                </p>
                <p class="whatsapp--notification--para">
                    Enable WhatsApp notifications to receive important updates directly on your WhatsApp
                </p>
                <a href="javascript:void(0)" class="btn whatsapp--notification--btn">
                    Know more
                </a>
            </div>
        </div>
        <!-- /Whatsapp Notification -->
    </div>
</main>

@include('influencer.footer.footer')

<!-- create live stream model start -->
<div id="createmodel--live">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Create Live Stream</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close" alt="">
            </div>
        </div>

        <div class="form-check radio-input">
            <input class="form-check-input coolor-radio" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Now
            </label>
        </div>
        <div class="form-check radio-input">
            <input class="form-check-input coolor-radio" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Schedule
            </label>
        </div>

        <form>
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Create Schedule</label>
                <input type="datetime-local" class="form-control live-stram-input" id="Input1"
                    placeholder="Enter your Schedule">
            </div>
            <div class="form-group pl-3 pr-3">
                <label for="Select1">Select Entry Price</label>
                <select class="form-control live-stram-input" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right;background-size: 25px;">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <div class="stream--submit--button">
                <a href="javascript:void(0)" class="btn btn-cancel-create live--model--close">Cancel</a>
                <button type="button" class="btn btn-cancel-create stream--btn--bg">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
<!-- live stream end model -->

@endsection

@push('js')
<script>
    function CopyLink() {
        // Get the text field
        var copyText = document.getElementById("link--input");

        // Select the text field
        copyText.select();

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
    }

    $('#live--model--trigger').click(function() {
        console.log('check');
        $('#createmodel--live').css('display', 'flex');
    })

    $('.live--model--close').click(function() {
        console.log('check');
        $('#createmodel--live').css('display', 'none');
    })
</script>
@endpush
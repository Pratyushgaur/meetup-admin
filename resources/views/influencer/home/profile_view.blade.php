@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:history.back()" class="cross--btn">
                <img src="{{ asset('assets/images/cross-icon.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Preview</span>
        </div>
    </nav>
</header>

<main class="mb-70">
    <!-- Profile Cover -->
    <div class="container-fluid profile--cover">
        <img src="{{ asset('assets/images/cover-profile.jpg') }}" alt="" class="profile--cover--image">
    </div>
    <!-- /Profile Cover -->

    <!-- Profile Data -->
    <div class="container-fluid preview--data">

        <div class="profile--info">
            <div class="preview--bio--section">
                <h5 class="preview--name--heading">
                    Hey, I'm Your {{auth()->user()->name}}
                </h5>
                <p class="preview--name--bio">
                {{strip_tags(auth()->user()->bio)}}
                </p>
            </div>
        </div>

        <div class="profile--links--section mt-3">
            <a href="" class="btn preview--link">
                Brand Enquiry
            </a>
            <a href="" class="btn preview--link">
                Chat Now
            </a>
            <a href="" class="btn preview--link">
                Instagram
            </a>
        </div>
    </div>
    <!-- /Profile Data -->


    <!-- Feature Section -->
    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            Membership
        </div>

        <div class="feature--dispaly">
            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @forelse($plans as $key =>$value)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="feature--display--body membership--section">
                            <div class="membership--image--section">
                                <img src="{{ URL::TO('plans') }}/{{$value->image}}" onerror="this.onerror=null;this.src='{{ URL::TO("plans/default.webp") }}';" alt="" class="membership--image">
                            </div>
                            <div class="preview--membership--content">
                                <h5>
                                    {{$value->title }}
                                </h5>
                                <p>
                                    {{$value->description }}
                                </p>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="btn preview--feature--button">
                            Subscribe Now
                        </a>
                    </div>
                    @empty
                    <div class="carousel-item active">
                        <div class="feature--display--body membership--section">
                            <div class="membership--image--section">
                                <img src="{{ asset('assets/images/member-1.jpg') }}" alt="" class="membership--image">
                            </div>
                            <div class="preview--membership--content">
                                <h5>
                                    No Plan Found 
                                </h5>
                                <p>
                                    There are no plan found please create new
                                </p>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="btn preview--feature--button">
                            Subscribe Now
                        </a>
                    </div>
                    @endforelse
                    

                    
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls1"
                    data-slide="prev">
                    <img src="{{ asset('assets/images/Slide left@2x.png') }}" alt=""
                        class="carousel--control--prev">
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls1"
                    data-slide="next">
                    <img src="{{ asset('assets/images/Slide Right@2x.png') }}" alt=""
                        class="carousel--control--next">
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid feature--section mt-3">
        <div class="feature--heading mt-1">
            Exclusives
        </div>

        <div class="exclusives--cards--section mt-1">
            <div class="owl-carousel owl-theme loopscards">
                <div class="exclusives--item">
                    <div class="exclusives--card--header">
                        <div class="exclusives--card--header--centent">
                            After Shower After Shower After Shower After ShowerAfter Shower
                            After Shower After Shower After Shower After ShowerAfter Shower
                        </div>
                        <div class="exclusives--card--header--label">
                            <span>Posted Recently</span>
                            <div class="exclusives--card--header--label--img">
                                <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="100%" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="exclusives--card--body">
                        <div class="exclusives--card--body--container">
                            <img src="{{ asset('assets/images/member-1.jpg') }}" alt="">
                            <div class="exclusives--card--body--container--label">
                                1/4
                            </div>
                        </div>
                    </div>
                    <button class="exclusives--card--footer">
                        Login to View
                    </button>
                </div>

                <div class="exclusives--item">
                    <div class="exclusives--card--header">
                        <div class="exclusives--card--header--centent">
                            After Shower After Shower After Shower After ShowerAfter Shower
                            After Shower After Shower After Shower After ShowerAfter Shower
                        </div>
                        <div class="exclusives--card--header--label">
                            <span>Posted Recently</span>
                            <div class="exclusives--card--header--label--img">
                                <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="100%" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="exclusives--card--body">
                        <div class="exclusives--card--body--container">
                            <video class="video-clip" onclick="this.paused?this.play():this.pause();">
                                <source src="{{ asset('assets/videos/private.mp4') }}" type="video/ogg">
                            </video>
                            <div class="exclusives--card--body--container--label">
                                2/4
                            </div>
                        </div>
                    </div>
                    <button class="exclusives--card--footer">
                        Login to View
                    </button>
                </div>

                <div class="exclusives--item">
                    <div class="exclusives--card--header">
                        <div class="exclusives--card--header--centent">
                            After Shower After Shower After Shower After ShowerAfter Shower
                            After Shower After Shower After Shower After ShowerAfter Shower
                        </div>
                        <div class="exclusives--card--header--label">
                            <span>Posted Recently</span>
                            <div class="exclusives--card--header--label--img">
                                <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="100%" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="exclusives--card--body">
                        <div class="exclusives--card--body--container border">
                            <img src="{{ asset('assets/images/member-1.jpg') }}" alt="">
                            <div class="exclusives--card--body--container--label">
                                3/4
                            </div>
                            <div class="exclusives--card--body--blur--section">
                                <div class="exclusives--card--body--blur--box">
                                    <img src="{{ asset('assets/images/preview-image.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="exclusives--card--footer">
                        Login to View
                    </button>
                </div>

                <div class="exclusives--item">
                    <div class="exclusives--card--header">
                        <div class="exclusives--card--header--centent">
                            After Shower After Shower After Shower After ShowerAfter Shower
                            After Shower After Shower After Shower After ShowerAfter Shower
                        </div>
                        <div class="exclusives--card--header--label">
                            <span>Posted Recently</span>
                            <div class="exclusives--card--header--label--img">
                                <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="100%" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="exclusives--card--body">
                        <div class="exclusives--card--body--container border">
                            <video class="video-clip" onclick="this.paused?this.play():this.pause();">
                                <source src="{{ asset('assets/videos/private.mp4') }}" type="video/ogg">
                            </video>
                            <div class="exclusives--card--body--container--label">
                                4/4
                            </div>
                            <div class="exclusives--card--body--blur--section">
                                <div class="exclusives--card--body--blur--box">
                                    <img src="{{ asset('assets/images/preview-video.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="exclusives--card--footer">
                        Login to View
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Feature Section -->
</main>

@include('influencer.footer.footer')

@endsection

@push('js')
<script>
    $('.loopscards').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: false,
        autoWidth: true,
    })
</script>
@endpush
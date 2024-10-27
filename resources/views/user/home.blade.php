@extends('user.layout.app')
@push('css')
<style>
    .amount-box h2{
        text-align:center;
        margin-top:15px;
        font-family: "Roboto Mono", monospace;
        font-optical-sizing: auto;

    }
    .live-section{
        width:70px;
        height:70px;
        border:5px solid red;
        margin:auto;
        margin-top:10px;
        border-radius:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        color:red;
        font-weight:bold;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar--home">
        <div class="navbar--menu">
            
        </div>
        <div class="navbar--options">
            <div class="navber--options--container" id="live--model--trigger">
                <a href="javascript:void(0)" class="live--btn" style="background-color: #fff;;color:#333;">
                    <img src="{{ asset('assets/images/subscribe-icon.png') }}" alt="" class="live--icon">
                    Subscribe
                </a>
            </div>
            @if(auth()->guard('customer')->check())
            <div class="navber--options--container">
                <a href="javascript:void(0)" class="live--btn" style="background-color: #fff;;color:#333">
                    <img src="{{ asset('assets/images/profile-user.png') }}" alt="" class="live--icon">
                    Profile
                </a>
                
            </div>
            @endif
            @if(auth()->guard('customer')->check())
                <div class="navber--options--container" >
                    <a href="{{ route('user.logout',request()->segment(2))   }}"  class="live--btn" style="background-color: #fff;;color:#333">
                        <img src="{{ asset('assets/images/logout-icon.png') }}" alt="" class="live--icon">
                        Logout
                    </a>
                </div>
            @else
                <div class="navber--options--container" >
                    <a href="{{ route('user.login',request()->segment(2))   }}"  class="live--btn" style="background-color: #fff;;color:#333">
                        <img src="{{ asset('assets/images/login.png') }}" alt="" class="live--icon">
                        Login
                    </a>
                    
                </div>
            @endif
            
            <!-- <div class="navber--options--container">
                <img src="{{ asset('assets/images/home-bell.png') }}" alt="" class="bell--icon">
            </div>
            <div class="navber--options--container">
                <img src="{{ asset('assets/images/home-bell2.png') }}" alt="" class="bell--icon">
            </div> -->
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
        @if($user->is_live)
        <div class="live-section" onclick="window.location.href='{{ route('user.view-stream',request()->segment(2)) }}'">
            Live
        </div>
        @endif
        <div class="profile--info">
            
            @if(Auth::guard('customer')->check())
            <div class="preview--bio--section">
                <h5 class="preview--name--heading">
                    Hey, {{Auth::guard('customer')->user()->name}}
                </h5>
                <div class="amount-box" >
                    <h2>{{auth()->guard('customer')->user()->balance}}</h2>
                </div>
            </div>
            @else
            <div class="preview--bio--section">
                <h5 class="preview--name--heading">
                    Hey, I'm Your {{$user->username}}
                </h5>
                <p class="preview--name--bio">
                {{strip_tags($user->bio)}}
                </p>
            </div>
            @endif
            
        </div>

        <div class="profile--links--section mt-3">
            <a href="" class="btn preview--link">
                Brand Enquiry
            </a>
            <a href="{{ route('user.chat',request()->segment(2)) }}" class="btn preview--link">
                Chat Now
            </a>
            @if(Auth::guard('customer')->check())
            <a href="{{ route('user.wallet',request()->segment(2)) }}" class="btn preview--link">
                Recharge
            </a>
            @else
            <a href="" class="btn preview--link">
                Instagram
            </a>
            @endif
        </div>
        
    </div>
    <!-- /Profile Data -->
     


    <!-- Feature Section -->
    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            {{ $user->plan_label_name  }}
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
                        <a href="{{ route('user.plan.view',[request()->segment(2),$value->id]) }}" class="btn preview--feature--button">
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
    @if($ex_posts->exists())
    <div class="container-fluid feature--section mt-3">
        <div class="feature--heading mt-1">
            Exclusives
        </div>

        <div class="exclusives--cards--section mt-1">
            <div class="owl-carousel owl-theme loopscards">
                @foreach($ex_posts->get() as $key =>$value)
                <div class="exclusives--item">
                    <div class="exclusives--card--header">
                        <div class="exclusives--card--header--centent">
                            {{$value->post_title}}
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
                            @if($value->file_type == "image")
                                @if($value->post_unlock_id !=null)
                                <img src="{{ URL::TO('posts') }}/{{$value->main_file}}" alt="">
                                @else
                                <img src="{{ URL::TO('posts') }}/{{$value->main_image_blur}}" alt="">
                                @endif
                           
                            @endif
                            @if($value->file_type == "video")
                            <img src="{{ URL::TO('thumbnails') }}/{{$value->video_thumbnail}}" alt="">
                            @endif
                            
                            @if($value->more_files != "")
                            <div class="exclusives--card--body--container--label">
                                <?php 
                                    if($value->more_files != ""){
                                        $more = json_decode($value->more_files);
                                        echo '1/'.count($more)+1;
                                    }
                                ?>
                               
                            </div>
                            @endif
                            @if(!Auth::guard('customer')->check())
                            <div class="exclusives--card--body--blur--section">
                                <div class="exclusives--card--body--blur--box">
                                    <img src="{{ asset('assets/images/preview-image.png') }}" alt="">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if(Auth::guard('customer')->check())
                        @if($value->post_unlock_id !=null)
                        <button onclick="window.location.href='{{route('user.post.view',[request()->segment(2),$value->id])}}'" class="exclusives--card--footer">
                            View
                        </button> 
                        @else
                        <button onclick="window.location.href='{{route('user.post.view',[request()->segment(2),$value->id])}}'" class="exclusives--card--footer">
                            Unlock
                        </button> 
                        @endif
                            
                    @else
                        <button class="exclusives--card--footer">
                            Login to View
                        </button>            
                    @endif
                    
                </div>
                @endforeach
                <!-- <div class="exclusives--item">
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
                </div> -->
                 <!-- <div class="exclusives--item">
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
                </div> -->

                

               <!-- <div class="exclusives--item">
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
                </div> -->
            </div>
        </div>
    </div>
    @endif
    <!-- /Feature Section -->
</main>

@include('user.footer')

@endsection

@push('js')

@vite('resources/js/app.js')
    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            Echo.channel('chat-room')
                .listen('MessageSent', (e) => {
                    // console.log(e.);
                    // alert(e.message);
                });
        });
    </script>

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
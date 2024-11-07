@extends('user.layout.app')
@push('css')
<style>
    main{
        background-color: rgba(var(--feature-theme), .05);
    }
    .amount-box h2 {
        text-align: center;
        margin-top: 15px;
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

    .live-tag{
        position:absolute; 
        top:45px; 
        left:45px; 
        font-weight:bold; 
        color:red; 
        background:rgba(0,0,0,0.5);.
        text-shadow: 2px 0 #fff, -2px 0 #fff, 0 2px #fff, 0 -2px #fff,
               1px 1px #fff, -1px -1px #fff, 1px -1px #fff, -1px 1px #fff;
        
    }
    .comment-section-container{
        margin:10px 3px ;

    }
    .user-comment-section{
        padding-left:5px;
        display:flex;
        justify-content:center;
        margin-top:5px;
    }
    .exclusive-section-image{
        width:12%;
        margin-right:10px;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar--home">
        <div class="navbar--menu"></div>
        <div class="navbar--options">
            <!-- <div class="navber--options--container" id="live--model--trigger">
                <a href="javascript:void(0)" class="live--btn" style="background-color: #fff;;color:#333;">
                    <img src="{{ asset('assets/images/subscribe-icon.png') }}" alt="" class="live--icon">
                    Subscribe
                </a>
            </div> -->
            @if(auth()->guard('customer')->check())
            <div class="navber--options--container">
                <a href="{{ route('user.logout',request()->segment(2)) }}" class="flex items-center bg-white text-black font-semibold py-1 px-2 rounded-full">
                    <img src="{{ asset('assets/images/profile-user.png') }}" alt="" class="live--icon" style="margin-right: 5px;height:18px">
                    Profile
                </a>
            </div>
            @endif
            @if(auth()->guard('customer')->check())
            <div class="navber--options--container mx-3">
                <a href="{{ route('user.logout',request()->segment(2)) }}" class="flex items-center bg-white text-black font-semibold py-1 px-2 rounded-full">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Logout
                </a>
            </div>
            @else
            <div class="navber--options--container">
                <a href="{{ route('user.login',request()->segment(2)) }}" class="flex items-center bg-white text-black font-semibold py-1 px-2 rounded-full">
                    <i class="fas fa-sign-in-alt mr-2"></i>
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
        <img src="{{ URL::TO('cover') }}/{{$user->cover}}" onerror="this.src='{{ asset('assets/images/cover-profile.jpg') }}'" alt="" class="profile--cover--image">
    </div>
    <!-- /Profile Cover -->

    <!-- Profile Data -->
    <div class="container-fluid preview--data">
       
        <div class="profile--info">
            <div class="profile--image--section" @if($user->is_live) style="border:5px solid red;" @endif>
            @if($user->is_live)
                <span class="live-tag" style=" " onclick="window.location.href='{{ route('user.view-stream',request()->segment(2)) }}'">>LIVE</span>
            @endif                
                <img src="{{ URL::TO('avator') }}/{{$user->avtar}}" onerror="this.src='{{ asset('assets/images/verify-badge.png') }}'" alt="" class="profile--image">
            </div>
            @if(Auth::guard('customer')->check())
            <div class="preview--bio--section" style="padding:0px; font-size:18px;">
                <h4 class="preview--name--heading">
                    Hey, {{Auth::guard('customer')->user()->name}}
                </h4>
                <div class="amount-box" style="display:flex; justify-content:center;">
                    
                    <h2>{{auth()->guard('customer')->user()->balance}}</h2>
                </div>
            </div>
            @else
            <div class="profile--bio--section">
                <h5>
                    Hi, I'm {{$user->username}}
                </h5>
                <p>
                    {{strip_tags($user->bio)}} 
                </p>
            </div>
            @endif
        </div>

        <div class="profile--links--section mt-3">
            <a href="" class="btn preview--link">
                Subscribe Now
            </a>
            <a href="{{ route('user.chat',request()->segment(2)) }}" class="btn preview--link">
                Message Me
            </a>
            @if(Auth::guard('customer')->check())
            <a href="{{ route('user.wallet',request()->segment(2)) }}" class="btn preview--link">
                Recharge
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
                        <a href="{{ route('user.plan.view',[request()->segment(2),$value->id]) }}" class="btn preview--feature--button" style="background-color: black;color:#ffffff;">
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
                        <a href="javascript:void(0)" class="btn preview--feature--button" style="background-color: black;color:#ffffff;">
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
    @if($services->exists())
    <div class="container-fluid feature--section mt-3">
        <div class="feature--heading mt-1">
        {{ $user->service_label_name  }}
        </div>

        <div class="exclusives--cards--section mt-1">
            <div class="owl-carousel owl-theme loopscards">
                @foreach($services->get() as $key => $value)
                <div class="max-w-36 mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 border">
                        <!-- Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden h-52 relative">
                            <div class="relative">
                                <img alt="Person taking a selfie in a mirror" class="w-full h-24 object-cover" height="400"
                                    src="{{URL::TO('services_images')}}/{{ $value->image }}" onerror="this.src='{{URL::TO('services_images/noimage.jpg')}}';" class="posting-logo-img" 
                                    width="280" />
                                <div class="absolute top-2 right-2 bg-white rounded-full px-2 py-1 text-sm font-semibold text-gray-700 flex items-center">
                                    <!-- <img src="{{ asset('assets/images/58c4274d9028aa1790c58509601e92b8.png') }}" alt="" style="height: 15px;margin-right:5px"> -->
                                    ₹ {{$value->price}}
                                </div>
                            </div>
                            <div class="p-1">
                                <h2 class="text-sm font-bold">
                                    {{ Str::limit($value->service_type, 15, '...') }}
                                </h2>
                                <p class="text-xs mb-4">
                                    {{ Str::limit($value->service_type, 30, '...') }}
                                </p>
                                <button data-image="{{URL::TO('services_images')}}/{{ $value->image }}" data-id="{{ $value->id }}" data-price="{{  $value->price }}" data-service_type="{{ $value->service_type }}" data class="bg-gray-200 text-sm text-gray-700 font-semibold py-1 px-2 rounded book_now absolute bottom-1 left-1">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($ex_posts->exists())
    <div class="container-fluid">
        <div class="feature--heading mt-1">
        Exclusive 
        </div>
    </div>
    @foreach($ex_posts->get() as $key =>$value)
        <?php 
            $total_comment = Helpers_total_comment($value->id);
        ?>
        <div class="post">
            <div class="post-header">
                <img alt="Profile picture" src="{{ URL::TO('avator') }}/{{$user->avtar}}" onerror="this.src='{{ asset('assets/images/verify-badge.png') }}'" class="image_fit" />
                <div>
                    <span class="username">
                        {{Str::limit($user->username, 40, '...')}} <i class="fas fa-check-circle verified"></i>
                    </span>

                    <div class="time">
                    {{ Helpers_time_ago($value->created_at) }}
                        <i class="fas fa-globe globe">
                        </i>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <p class="post--caption mb-2">
                {{$value->post_title}}
                
                </p>
                @if(!auth()->guard('customer')->check())
                <div class="image--lock">
                    <div class="lock--price--label">
                        <div class="h-52 flex justify-center items-center">
                            <i class="fas fa-lock text-gray-500 text-8xl mt-4">
                            </i>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <button class="bg-black text-white py-2 px-4 rounded-full flex items-center">
                                <span>
                                    Login to View
                                </span>
                                
                            </button>
                        </div>
                        
                    </div>
                </div>
                @else
                    @if($value->price  == 0)
                        @if($value->file_type == 'video')
                            <video class="post--image" src="{{ asset('posts') }}/{{ $value->main_file }}" onclick="this.paused?this.play():this.pause();"></video>
                        @else
                            <div class="owl-carousel owl-theme post--images">
                                <div class="item">
                                    <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="{{ asset('posts') }}/{{ $value->main_file }}" />
                                </div>
                                @if($value->more_files!=null)
                                    <?php 
                                        $morefiles = json_decode($value->more_files);
                                        foreach ($morefiles as $k => $v) {
                                            ?>
                                            <div class="item">
                                                <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="{{ asset('posts') }}/{{ $v; }}" />
                                            </div>
                                            <?php
                                        }
                                    ?>
                                @endif
                                
                            </div>
                        @endif
                    @else
                    @if($value->post_unlock_id == null)   
                            <div class="image--lock">
                                <div class="lock--price--label">
                                    <div class="h-52 flex justify-center items-center">
                                        <i class="fas fa-lock text-gray-500 text-8xl mt-4">
                                        </i>
                                    </div>
                                    <div class="mt-4 flex justify-center">
                                        <button class="bg-black text-white py-2 px-4 rounded-full flex items-center confirm-unlock" data-postid="{{ $value->id }}" @if($value->price <= auth()->guard('customer')->user()->balance) data-eligble="true" @else data-eligble="false" @endif>
                                            <span>
                                                Unlock now @
                                            </span>
                                            <img src="{{ asset('assets/images/58c4274d9028aa1790c58509601e92b8.png') }}" alt="" style="height: 15px;width: 15px;margin-right: 5px;margin-left: 5px">
                                            <span>
                                                {{$value->price}}
                                            </span>
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>            
                    @else
                            @if($value->file_type == 'video')
                                    <video class="post--image" src="{{ asset('posts') }}/{{ $value->main_file }}" onclick="this.paused?this.play():this.pause();"></video>
                                @else
                                    <div class="owl-carousel owl-theme post--images">
                                        <div class="item">
                                            <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="{{ asset('posts') }}/{{ $value->main_file }}" />
                                        </div>
                                        @if($value->more_files!=null)
                                            <?php 
                                                $morefiles = json_decode($value->more_files);
                                                foreach ($morefiles as $k => $v) {
                                                    ?>
                                                    <div class="item">
                                                        <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="{{ asset('posts') }}/{{ $v; }}" />
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        @endif
                                        
                                    </div>
                            @endif

                    @endif              
                    @endif
                
                
                @endif
                
            </div>
            
            <div class="post-footer">
                @if(!auth()->guard('customer')->check())
                    <div class="icon likes">
                        <i class='fas fa-heart' style='font-size:18px;'></i>
                        {{$value->like_count}}
                    </div>
                    <div class="icon comments">
                        <i class="far fa-comment" style='font-size:18px;'>
                        </i>
                        {{$total_comment}}
                    </div>
                    <!-- <div class="icon share">
                        <i class="far fa-paper-plane" style='font-size:18px;'>
                        </i>
                    </div> -->
                @else
                    @if($value->price  == 0 || $value->post_unlock_id != null)   
                        <?php 
                            $isliked = is_liked($value->id,auth()->guard('customer')->user()->id);
                        ?>
                        <div class="icon likes postLike" data-islike="{{ $isliked }}" data-postid="{{ $value->id }}">
                            <i class='fas fa-heart ' style='font-size:18px; @if($isliked) color:red;  @endif'></i>
                            <span class="like-count-block">{{$value->like_count}}</span>
                        </div>
                        <div class="icon comments" onclick="showCommentBox('{{ $value->id }}')">
                            <i class="far fa-comment" style='font-size:18px;'>
                            </i>
                            {{$total_comment}}
                        </div>
                        <!-- <div class="icon share">
                            <i class="far fa-paper-plane" style='font-size:18px;'>
                            </i>
                        </div>     -->
                    @else
                        <div class="icon likes">
                                <i class='fas fa-heart' style='font-size:18px;'></i>
                                {{$value->like_count}}
                            </div>
                            <div class="icon comments" >
                                <i class="far fa-comment" style='font-size:18px;'>
                                </i>
                                {{$total_comment}}
                            </div>
                            <!-- <div class="icon share">
                                <i class="far fa-paper-plane" style='font-size:18px;'>
                                </i>
                            </div>                          -->
                    @endif
                @endif
                
            </div>
        </div>
    @endforeach

    @endif
   
    <!-- Free post -->
    <!-- <div class="post">
        <div class="post-header">
            <img alt="Profile picture" src="https://storage.googleapis.com/a1aa/image/PIDJOMLnKwJEO9wV1MBv8rKPdnNIH0LnoZ6vrfqWfmgcT8pTA.jpg" class="image_fit" />
            <div>
                <span class="username">
                    {{Str::limit($user->name, 40, '...')}} <i class="fas fa-check-circle verified"></i>
                </span>

                <div class="time">
                    6 days ago
                    <i class="fas fa-globe globe">
                    </i>
                </div>
            </div>
        </div>
        <div class="post-content">
            <p class="post--caption mb-2">
                Caption.. Caption.. Caption.. Caption.. Caption.. Caption..Caption.. Caption.. Caption.. Caption..
            </p>
            <div class="owl-carousel owl-theme post--images">
                <div class="item">
                    <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="https://storage.googleapis.com/a1aa/image/up0uM1ECjVosANcV8p4aWvjwetDsA6RtqneCjOO0U0TdT8pTA.jpg" />
                </div>
                <div class="item">
                    <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post-content--image image_fit" src="{{ asset('assets/images/cover-profile.jpg') }}" />
                </div>
            </div>
        </div>
        <div class="post-footer">
            <div class="icon likes">
                <i class='fas fa-heart' style='font-size:18px;color:red'></i>
                10
            </div>
            <div class="icon comments">
                <i class="far fa-comment" style='font-size:18px;'>
                </i>
                1
            </div>
            <div class="icon share">
                <i class="far fa-paper-plane" style='font-size:18px;'>
                </i>
            </div>
        </div>
    </div> -->
    
    <!-- Post Lock -->
    <!-- <div class="post">
        <div class="post-header">
            <img alt="Profile picture" src="https://storage.googleapis.com/a1aa/image/PIDJOMLnKwJEO9wV1MBv8rKPdnNIH0LnoZ6vrfqWfmgcT8pTA.jpg" class="image_fit" />
            <div>
                <span class="username">
                    {{Str::limit('shy_lii', 40, '...')}} <i class="fas fa-check-circle verified"></i>
                </span>

                <div class="time">
                    6 days ago
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>
        <div class="post-content">
            <p class="post--caption mb-2">
                Caption.. Caption.. Caption.. Caption.. Caption.. Caption..Caption.. Caption.. Caption.. Caption..
            </p>
            <div class="image--lock">
                <div class="lock--price--label">
                    <div class="h-52 flex justify-center items-center">
                        <i class="fas fa-lock text-gray-500 text-8xl mt-4">
                        </i>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button class="bg-black text-white py-2 px-4 rounded-full flex items-center">
                            <span>
                                Unlock now @
                            </span>
                            <img src="{{ asset('assets/images/58c4274d9028aa1790c58509601e92b8.png') }}" alt="" style="height: 15px;width: 15px;margin-right: 5px;margin-left: 5px">
                            <span>
                                1499
                            </span>
                        </button>
                    </div>
                    
                </div>
            </div>
           
        </div>
        <div class="post-footer">
            <div class="icon likes">
                <i class="far fa-heart" style='font-size:18px;'></i>
                10
            </div>
            <div class="icon comments">
                <i class="far fa-comment" style='font-size:18px;'></i>
                1
            </div>
            <div class="icon share">
                <i class="fas fa-share-square" style='font-size:18px;'></i>
            </div>
        </div>
    </div> -->
 
    <!-- <div class="post">
        <div class="post-header">
            <img alt="Profile picture" src="https://storage.googleapis.com/a1aa/image/PIDJOMLnKwJEO9wV1MBv8rKPdnNIH0LnoZ6vrfqWfmgcT8pTA.jpg" class="image_fit" />
            <div>
                <span class="username">
                    {{Str::limit('shy_lii', 40, '...')}} <i class="fas fa-check-circle verified"></i>
                </span>

                <div class="time">
                    6 days ago
                    <i class="fas fa-globe globe">
                    </i>
                </div>
            </div>
        </div>
        <div class="post-content">
            <p class="post--caption mb-2">
                Caption.. Caption.. Caption.. Caption.. Caption.. Caption..Caption.. Caption.. Caption.. Caption..
            </p>
            
            <video class="post--image" src="{{ asset('assets/video/private.mp4') }}" onclick="this.paused?this.play():this.pause();"></video>
        </div>
        <div class="post-footer">
            <div class="icon likes">
                <i class='fas fa-heart' style='font-size:18px;color:red'></i>
                10
            </div>
            <div class="icon comments">
                <i class="far fa-comment" style='font-size:18px;'>
                </i>
                1
            </div>
            <div class="icon share">
                <i class="far fa-paper-plane" style='font-size:18px;'>
                </i>
            </div>
        </div>
    </div> -->
   
    <div class="mt-4 flex justify-center">
        <button onclick="window.location.href='{{ route('influencer.signup') }}'" class="bg-black text-white py-2 px-4 rounded-full flex items-center">
            <span>
                Create your Profile
            </span>
        </button>
    </div>

    <div class="Home-footer">
        Copyright by @MeetMeUp
    </div>
</main>
<div id="edit-section-model" class="service-detail-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">View Service</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close close_service_model" alt="">
            </div>
        </div>
        <div class="servie-booking-detail-section" >
            <div class="container-fluid profile--cover " style="padding:5px;">
                <img class="service-image-block" src="" onerror="this.src='{{URL::TO('services_images/noimage.jpg')}}';" alt="" class="profile--cover--image">
            </div>
            <div class="p-2">
            
                <p class="text-xs mb-2 service-detail-block">
                
                </p>
                <h2 class="text-sm font-bold service-price-block">
                
                </h2>
                <div style="display:flex; justify-content:center;"> 
                    <button  data class="bg-gray-200 text-sm text-gray-700 font-semibold py-1 px-2 rounded bookingNow" style="background:black; color:#fff;">
                        Book Now
                    </button>
                    
                    
                </div>
                <div class="text-center mt-2">
                    <span class="text-danger booking-error"></span>   
                </div>
                
            </div>
        </div>
        <div class="success-section mt-3 mb-3" style="display:none">
            <div class="" style="padding:5px; display:flex; justify-content:center;">
                <img class="" src="{{ URL::TO('check.png') }}" onerror="this.src='{{URL::TO('services_images/noimage.jpg')}}';" alt="" class="" width="100px;">
            </div>
            <div class="text-center">
                <h2 style="font-size:25px !important; font-weight:bold">Congratulation</h2>
            </div>
            <div class="text-center mt-3 ">
                <p >Service Booked successfully..</p>
            </div>
        </div>
        

        

    </div>
</div>
<div id="edit-menbership-model" class="userlist_model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head"> Comments</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close modelClose" alt="">
            </div>
        </div>
        <div class="usercontainer">
            <div class="user-comment-section exclusive">
                <div class="exclusive-section-image">
                    <img alt="Profile picture" src="{{ asset('assets/images/verify-badge.png') }}" class="image_fit">   
                </div>
                <div class="exclusive-section-first">
                    <input type="text" class="form-control comment--input comment-input" placeholder="Type your comment...." />
                </div>
                <div class="exclusive-section-second sendComment" data-postid="" style="background:black; border-radius:100%; height: 40px;width:40px;display:flex; justify-content:center;align-items:center; margin-left:5px;">
                    <img src="{{ asset('assets/images/send.png') }}" alt="" style="height: 24px;width:24px; ">
                </div>
            </div>
            <div class="comment-section-container"></div>
            <h5 class="no_data" style="text-align:center; margin-top:20px; display:none;">No Comment exists</h5>
        </div>
    </div>
</div>

@include('user.footer')

@endsection

@push('js')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    $('.post--images').owlCarousel({
        items: 1,
        loop: false,
        margin: 15,
        nav: false,
        dots: true,
        autoWidth: false,
    })

    $(document).on('click','.book_now',function(){
        $(".booking-error").html('');
        $('.success-section').hide();
        $('.servie-booking-detail-section').show();
        let id= $(this).attr('data-id');
        let price = $(this).attr('data-price');
        let name=$(this).attr('data-service_type');
        let image=$(this).attr('data-image');
        $(".service-detail-block").html(name);
        $(".service-price-block").html("Rs."+price);
        $(".service-image-block").attr('src',image)
        $(".bookingNow").attr('data-id',id);
        $(".service-detail-model").css('display','flex');
    })
    $(document).on('click','.bookingNow',function(){
        document.getElementById('loader').classList.add('loader-visible');
        element = $(this);
        element.attr('disabled',true)
        let serviceId = $(this).attr('data-id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: "{{ route('user.service.book',[request()->segment(2)]) }}",
            method: "post",
            
            data: {serviceId:serviceId},
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {
                if(response.status == 0){
                    $(".booking-error").html(response.message);
                    element.attr('disabled',false)
                    document.getElementById('loader').classList.remove('loader-visible');
                }else if(response.status == 1){
                    $('.success-section').show();
                    $('.servie-booking-detail-section').hide();
                    document.getElementById('loader').classList.remove('loader-visible');
                }else{
                    document.getElementById('loader').classList.remove('loader-visible');
                }
            },
            error:() =>{
                document.getElementById('loader').classList.remove('loader-visible');
            }
        });
       

    })
    $(".close_service_model").click(function(){
        $(".service-detail-model").css('display','none');
    })
    $(".postLike").click(function(){
        //$(this).attr('disabled',true);
        //$(this).off('click')
        
        let elem = $(this);
        let postid = $(this).attr('data-postid');

        let islike = $(this).attr('data-islike');
        
        if(islike == '1'){
            $(this).children('i').css('color','');
            let countCon = $(this).find('.like-count-block');
            countCon.html(parseInt(countCon.html())-1);
            $(this).attr('data-islike','')
        }else{
           
            $(this).children('i').css('color','red');
            let countCon = $(this).find('.like-count-block');
            countCon.html(parseInt(countCon.html())+1);
            $(this).attr('data-islike','1')
            
        }
        $.ajax({
            url: "{{ route('user.post.like',[request()->segment(2)]) }}",
            data: {postid:postid,islike:islike},
            success: function(response) {
                
            }
        });
       // alert($(this).attr('data-islike'))
    })

    $(".modelClose").click(function(){

        $(".userlist_model").css('display', 'none');
    })
    $(".sendComment").click(function(){
        if($('.comment-input').val() != ''){
            $(".userlist_model").css('display', 'none');
            document.getElementById('loader').classList.add('loader-visible');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            const formData = new FormData();
            let postid = $(this).attr('data-postid');
            formData.append('comment', $('.comment-input').val());
            formData.append('post_id', postid);
            $.ajax({
                url: "{{ route('user.post.comment.send',[request()->segment(2)]) }}",
                method: "post",
                contentType: false,
                processData: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {
                    
                    if(response.status == "1"){
                        $('.comment-input').val('')
                        showCommentBox(postid);
                        document.getElementById('loader').classList.remove('loader-visible');
                    }
                },
                error:(request, status, error) =>{
                    let er = JSON.parse(request.responseText);
                    document.getElementById('loader').classList.remove('loader-visible');
                    Swal.fire({text:er.message,confirmButtonColor: "#333",});
                }


            });
        }
    })
    $(document).on('click','.confirm-unlock',function(){
        if($(this).attr('data-eligble') == 'true'){
            let postid = $(this).attr('data-postid');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't to unlock this port !",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#333",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Unlock it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    document.getElementById('loader').classList.add('loader-visible');
                    $.ajax({
                        url: "{{ route('user.post.unlock',[request()->segment(2)]) }}",
                        method: "get",
                    
                        data: {postid:postid},
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        success: function(response) {
                            document.getElementById('loader').classList.remove('loader-visible');
                            let r = JSON.parse(response);
                            
                            if(r.error){
                                Swal.fire({text:r.message,confirmButtonColor: "#333",});
                            }else{
                                window.location.reload();
                            }
                            // $(".create-post-image-section").hide();
                            // $(".create-post-form-section").show();
                            
                            //window.location.href = "{{ route('influencer.success.page') }}";
                        },


                    });
                }
            });
        }else{
            Swal.fire({
                text:"Insufficient balance in wallet !",
                confirmButtonColor: "#333",
            });

        }
        
    })
    function showCommentBox(postid){
        $.ajax({
            url: "{{ route('user.post.comment.get',[request()->segment(2)]) }}",
            method: "get",
            data: {post_id:postid},
            success: function(response) {
                let html = '';
                response.comment.forEach(element => {
                    html+='<div class="post"><div class="post-header"><img alt="Profile picture" src="{{ asset('assets/images/verify-badge.png') }}" class="image_fit"><div><span class="username">'+element.name+'</span><div class="time">'+timeAgo(element.created_at)+'<i class="fas fa-globe globe"></i></div></div></div><div class="post-content"><p class="post--caption mb-2">'+element.comment+'</p></div></div>';
                });
                if(response.comment.length > 0){
                    $(".comment-section-container").show();
                    $(".no_data").hide();
                    $(".comment-section-container").html(html);
                }else{
                    $(".comment-section-container").hide();
                    $(".no_data").show();

                }
                $(".sendComment").attr('data-postid',postid);
                $(".userlist_model").css('display', 'flex');
               
            },
            error:(request, status, error) =>{
                let er = JSON.parse(request.responseText);
                document.getElementById('loader').classList.remove('loader-visible');
                Swal.fire({text:er.message,confirmButtonColor: "#333",});
            }


        });
        
    }
    function timeAgo(dateInput) {
        const now = new Date();
        const date = new Date(dateInput);
        const seconds = Math.floor((now - date) / 1000);
        
        let interval = Math.floor(seconds / 31536000); // Years
        if (interval >= 1) return `${interval} year${interval === 1 ? '' : 's'} ago`;

        interval = Math.floor(seconds / 2592000); // Months
        if (interval >= 1) return `${interval} month${interval === 1 ? '' : 's'} ago`;

        interval = Math.floor(seconds / 86400); // Days
        if (interval >= 1) return `${interval} day${interval === 1 ? '' : 's'} ago`;

        interval = Math.floor(seconds / 3600); // Hours
        if (interval >= 1) return `${interval} hour${interval === 1 ? '' : 's'} ago`;

        interval = Math.floor(seconds / 60); // Minutes
        if (interval >= 1) return `${interval} minute${interval === 1 ? '' : 's'} ago`;

        return 'just now'; // Less than a minute ago
    }
</script>
@endpush
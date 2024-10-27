@extends('influencer.login_pages.app')

@push('css')
<style>
    main{
        background-color: rgba(var(--feature-theme), .05);
    }
</style>
@endpush

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
    <div class="container-fluid profile--data">
        <div class="profile--info">
            <div class="profile--image--section">
                <img src="{{ URL::TO('avator') }}/{{auth()->user()->avtar}}" onerror="this.src='{{ asset('assets/images/verify-badge.png') }}'" alt="" class="profile--image">
            </div>

            <div class="profile--bio--section">
                <h5>
                    Hi, I'm {{auth()->user()->name}}
                </h5>
                <p>
                    {{strip_tags(auth()->user()->bio)}} Message Me Message Me Message Me Message Me Message Me Message Me Message Me Message Me Message Me
                </p>
            </div>
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
                <div class="max-w-36 mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 border">
                        <!-- Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="relative">
                                <img alt="Person taking a selfie in a mirror" class="w-full h-24 object-cover" height="400"
                                    src="https://storage.googleapis.com/a1aa/image/Ewq9ExFuAVbJNl4nLnGEnBRBn2FKTdS7jAVIotCfxs7PHepTA.jpg"
                                    width="280" />
                                <div class="absolute top-2 right-2 bg-white rounded-full px-2 py-1 text-sm font-semibold text-gray-700 flex items-center">
                                    <img src="{{ asset('assets/images/58c4274d9028aa1790c58509601e92b8.png') }}" alt="" style="height: 15px;margin-right:5px">
                                    2999
                                </div>
                            </div>
                            <div class="p-1">
                                <h2 class="text-sm font-bold">
                                    {{ Str::limit('Add me on snapchat &', 15, '...') }}
                                </h2>
                                <p class="text-xs mb-4">
                                {{ Str::limit('Lets make spicy streaks together.😈😘 Lets make spicy streaks together.😈😘', 55, '...') }}
                                </p>
                                <button class="bg-gray-200 text-sm text-gray-700 font-semibold py-1 px-2 rounded">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Free post -->
    <div class="post">
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
    </div>

    <!-- Post Lock -->
    <div class="post">
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
                    <div class="mt-2 flex justify-center text-gray-500">
                        <i class="fas fa-image mt-1"></i>
                        <span class="ml-1">
                            1
                        </span>
                    </div>
                </div>
            </div>
            <!-- <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post--image" src="https://storage.googleapis.com/a1aa/image/up0uM1ECjVosANcV8p4aWvjwetDsA6RtqneCjOO0U0TdT8pTA.jpg"/> -->
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
    </div>

    <div class="post">
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
            <!-- <img alt="Person taking a mirror selfie wearing a grey top and jeans" class="post--image" src="https://storage.googleapis.com/a1aa/image/up0uM1ECjVosANcV8p4aWvjwetDsA6RtqneCjOO0U0TdT8pTA.jpg" /> -->
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
    </div>
    <!-- /Feature Section -->
</main>

@include('influencer.footer.footer')

@endsection

@push('js')

<script src="https://cdn.tailwindcss.com"></script>
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
</script>
@endpush
@extends('influencer.login_pages.app')


@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Profile</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-70">
    <!-- Profile Cover -->
    <div class="container-fluid profile--cover">
        <img src="{{ URL::TO('cover') }}/{{auth()->user()->cover}}" onerror="this.src='{{ asset('assets/images/cover-profile.jpg') }}'" alt="" class="profile--cover--image">
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
                    {{auth()->user()->name}}
                </h5>
                <p>
                {{strip_tags(auth()->user()->bio)}}
                </p>
            </div>
        </div>

        <div class="profile--links--section mt-3">

            <a href="" class="btn profile--links">
                Preview App
            </a>
            <a href="{{ route('influencer.profile.edit') }}" class="btn profile--links">
                Edit Profile
            </a>
            <a href="" class="btn profile--links">
                Share
            </a>
        </div>
    </div>
    <!-- /Profile Data -->



    <!-- Feature Section -->
    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            {{auth()->user()->service_label_name}}
            <a href="{{ route('influencer.services') }}"><img src="{{ asset('assets/images/Edit.png') }}" alt="" class="feature--edit"></a>
        </div>

        <div class="feature--dispaly">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i=0; ?>
                    @foreach($service as $key =>$value)
                    <div class="carousel-item @if($i==0)active @endif">
                        <div class="feature--display--body">
                            {{$value->service_type}}
                        </div>
                        <a href="javascript:void(0)" class="btn feature--button">
                            Price ₹{{number_format($value->price,2)}}
                        </a>
                    </div>
                    <?php $i++; ?>
                    @endforeach
                    

                   
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls"
                    data-slide="prev">
                    <img src="{{ asset('assets/images/Slide left@2x.png') }}" alt=""
                        class="carousel--control--prev">
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls"
                    data-slide="next">
                    <img src="{{ asset('assets/images/Slide Right@2x.png') }}" alt=""
                        class="carousel--control--next">
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            {{auth()->user()->plan_label_name}}
            <a href="{{ route('influencer.membership') }}"><img src="{{ asset('assets/images/Edit.png') }}" alt="" class="feature--edit"></a>
        </div>

        <div class="feature--dispaly">
            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php $i=0; ?>
                @foreach($plans as $key =>$value)
                    <div class="carousel-item @if($i==0)active @endif">
                        <div class="feature--display--body membership--section">
                            <div class="membership--image--section">
                                <img src="{{ URL::TO('plans') }}/{{$value->image}}" alt=""
                                    class="membership--image" onerror="this.onerror=null;this.src='{{ URL::TO("plans/default.webp") }}';">
                            </div>
                            <div class="membership--content">
                                <h5>
                                    {{$value->title}}
                                </h5>
                                <p>
                                    <!-- Premium content -->
                                </p>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="btn feature--button">
                            Price ₹{{number_format($value->price,2)}}
                        </a>
                    </div>
                <?php $i++; ?>
                @endforeach
                    

                    
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

    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            My Links
            <img src="{{ asset('assets/images/Edit.png') }}" alt="" class="feature--edit">
        </div>

        <div class="feature--dispaly">
            <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="feature--display--body feature--display--body--links">
                            New Youtube Video Launch
                            <br>
                            <a href="javascript:viod(0)" class="feature--links text-truncate">link</a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="feature--display--body feature--display--body--links">
                            New Youtube Video Launch
                            <br>
                            <a href="javascript:viod(0)" class="feature--links text-truncate">link</a>
                        </div>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls2"
                    data-slide="prev">
                    <img src="{{ asset('assets/images/Slide left@2x.png') }}" alt="" id="carousel--control--prev">
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls2"
                    data-slide="next">
                    <img src="{{ asset('assets/images/Slide Right@2x.png') }}" alt="" id="carousel--control--next">
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid feature--section">
        <div class="feature--heading mt-1">
            YouTube Channel
        </div>

        <div class="feature--dispaly">
            <div class="feature--display--body youtube--channel--section">
                <img src="{{ asset('assets/images/youtube-icon.png') }}" alt="" class="youtube--icon">
                Connect your Channel
                <input type="text" class="form-control youtube--channel--input">
            </div>
            <a href="javascript:void(0)" class="btn youtube--channel--button">
                Connect
            </a>
        </div>
    </div>

    <!-- /Feature Section -->

</main>

@include('influencer.footer.footer')

<!-- create live stream model start -->
<!-- <div id="createmodel">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div>
                <span>Create Live Stream</span>
            </div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="cloud" alt="" height="30vh" width="90%">
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
                <label for="exampleFormControlInput1">Create Schedule</label>
                <input type="text" class="form-control live-stram-input" id="exampleFormControlInput1"
                    placeholder="Enter your Schedule">
            </div>
            <div class="form-group pl-3 pr-3">
                <label for="exampleFormControlSelect1">Select Entry Price</label>
                <select class="form-control live-stram-input" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <div class="stream--submit--button">
                <a href="javascript:void(0)" class="btn btn-cancel-create border ">Cancel</a>
                <button type="button" class="btn btn-cancel-create border stream--btn--bg"><a href="javascript:void(0)">Create</a></button>
            </div>
        </form>




    </div>
</div> -->

<!-- live stream end model -->
@endsection
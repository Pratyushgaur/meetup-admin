@extends('influencer.login_pages.app')
@push('css')
<style>
    .active{
        background-color: black;
        color: white;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Feed</span>
            </li>
        </ul>
    </nav>
</header>
<main class="mb-70">
    <div class="container-fluid">
        <div class="feed-btn-container">
            <button type="button" data-href="{{ route('influencer.post','exclusive') }}" class="feed-btn shiftPost @if($postype == 'exclusive')active @endif">Exclusive</button>
            <button type="button" data-href="{{ route('influencer.post','premium') }}" class="feed-btn shiftPost @if($postype == 'premium') active @endif pl-2">Prime</button>
        </div>

        <!-- <div class="video-container">
            <div class="video-section mb-3">
                <video class="video-clip" onclick="this.paused?this.play():this.pause();">
                    <source src="{{ asset('assets/videos/private.mp4') }}" type="video/ogg">
                </video>
                <div class="video-blur-section">
                    <div class="video-blur-execlusive">
                        <div class="font-style">Move to prime</div>
                    </div>
                    <div class="video-blur-playbtn">
                        <img src="{{ asset('assets/images/prime-play.png') }}" alt="" height="90px" width="90px">
                    </div>
                    <div class="video-like-icon">
                        <button class="feed--prime--details">
                            <img src="{{ asset('assets/images/like-feed.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                139
                            </div>
                        </button>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/earned-btn.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                5000
                            </div>
                        </div>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                5000
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-detail-section">
                <div class="video-type">
                    <div class="post--content">
                        After shower 💦 After shower 💦 After shower 💦 After shower 💦 After shower 💦 After shower 💦 After shower 💦 After shower 💦
                    </div>
                    <div class="post--btn">
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/copy-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/notification-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                    </div>
                </div>
                <div class="date-time">
                    29/07/2024 15:53
                </div>
                <div class="exclusive">
                    <div class="exclusive-section-first">
                        <input type="text" class="form-control comment--input" placeholder="Type your comment...." />
                    </div>
                    <div class="exclusive-section-second">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                    </div>
                </div>
                <div class="view--comment--section">
                    <a href="#">View all comments</a>
                </div>
            </div>
        </div>

        <div class="video-container">
            <div class="video-section mb-3">
                <video class="video-clip" onclick="this.paused?this.play():this.pause();">
                    <source src="{{ asset('assets/videos/private.mp4') }}" type="video/ogg">
                </video>
                <div class="video-blur-section hidden">
                    <div class="video-blur-execlusive">
                        <div class="font-style">Move to prime</div>
                    </div>
                    <div class="video-blur-playbtn">
                        <img src="{{ asset('assets/images/prime-play.png') }}" alt="" height="90px" width="90px">
                    </div>
                    <div class="video-like-icon">
                        <button class="feed--prime--details">
                            <img src="{{ asset('assets/images/like-feed.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                139
                            </div>
                        </button>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/earned-btn.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                5000
                            </div>
                        </div>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                5000
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-detail-section">
                <div class="video-type">
                    <div class="post--content">
                        After shower 💦
                    </div>
                    <div class="post--btn">
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/copy-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/notification-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                    </div>
                </div>
                <div class="date-time">
                    29/07/2024 15:53
                </div>
                <div class="exclusive">
                    <div class="exclusive-section-first">
                        <input type="text" class="form-control comment--input" placeholder="Type your comment...." />
                    </div>
                    <div class="exclusive-section-second">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                    </div>
                </div>
                <div class="view--comment--section">
                    <a href="#">View all comments</a>
                </div>
            </div>
        </div> -->

        @foreach($posts as $key =>$value)
        <div class="video-container">
            <div class="video-section mb-3">
                @if($value->file_type == 'video')
                    <img src="{{ asset('thumbnails/') }}/{{ $value->video_thumbnail }}" alt="" class="image_fit" id="thumbnails-{{$value->id}}">
                    <video class="video-clip" id="video-{{$value->id}}" onclick="this.paused?this.play():this.pause();"></video>
                @else
                    <img src="{{ asset('posts/') }}/{{ $value->main_file }}" alt="" class="image_fit">
                @endif
                <div class="video-blur-section">
                    <div class="video-blur-execlusive">
                        @if($value->post_type == 0)
                        <div class="font-style">Move to prime</div>
                        @endif
                    </div>
                    @if($value->file_type == 'video')
                        <div class="video-blur-playbtn video-blur-playbtn-edit" data-video="video-{{$value->id}}" data-id="{{$value->id}}" data-src="{{ asset('posts/') }}/{{ $value->main_file }}">
                            <img src="{{ asset('assets/images/prime-play.png') }}" alt="" height="90px" width="90px">
                        </div>
                    @else
                        <div class="video-blur-playbtn">
                            
                        </div>
                    @endif
                    @if($value->post_type == 0)
                    <div class="video-like-icon">
                        <button class="feed--prime--details">
                            <img src="{{ asset('assets/images/like-feed.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                                {{$value->like_count}}
                            </div>
                        </button>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/earned-btn.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                            {{$value->total_earn}}
                            </div>
                        </div>
                        <div class="feed--prime--details">
                            <img src="{{ asset('assets/images/feed-lock.png') }}" alt="" height="22px" width="22px">
                            <div class="feed--prime--details--content">
                            {{$value->total_unlock}}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="video-detail-section">
                <div class="video-type" >
                    @if($value->post_type == 0)
                    <div class="feed--prime--btn">
                        <div class="feed--prime--btn--content">
                            Exclusive
                        </div>
                        
                    </div>
                    <div class="feed--prime--btn">
                        <div class="feed--prime--btn--content">
                            ₹{{number_format($value->price,2)}}
                        </div>
                        
                    </div>
                    <!-- <h6 style="margin-top:10px;margin-left:20px;" >₹100.00</h6> -->
                    @else
                    <div class="feed--prime--btn">
                        <div class="feed--prime--btn--content">
                            {{$value->plan_name}}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="video-type">
                    <div class="post--content">
                        {{ $value->post_title }}<!-- After shower 💦 -->
                    </div>
                    <div class="post--btn">
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/copy-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/notification-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                    </div>
                </div>
                <div class="date-time">
                    {{ date('d/m/Y H:i',strtotime($value->created_at)) }} 
                </div>
                <div class="exclusive">
                    <div class="exclusive-section-first">
                        <input type="text" class="form-control comment--input" placeholder="Type your comment...." />
                    </div>
                    <div class="exclusive-section-second">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                    </div>
                </div>
                <div class="view--comment--section">
                    <a href="#">View all comments</a>
                </div>
            </div>
        </div>
        @endforeach
        


    </div>
</main>

@include('influencer.footer.footer')
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.shiftPost').click(function(){
            window.location.href = $(this).attr('data-href');
        })

        $('.video-blur-playbtn-edit').click(function(){
            var VideoId = $(this).attr('data-video');
            var id = $(this).attr('data-id');
            var src = $(this).attr('data-src');

            $(this).parent('.video-blur-section').addClass('d-none');
            $('#thumbnails-'+id).addClass('d-none');
            $('#'+VideoId).attr("src" , src);
            $('#'+VideoId).click();

            console.log($(this).attr('data-video'));
        })
    })
</script>
@endpush
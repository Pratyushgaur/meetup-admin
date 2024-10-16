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
        <div class="video-container">
            <div class="video-section mb-3" style="height:100%;">
                @if($value->file_type == 'video')
                    <img src="{{ asset('thumbnails/') }}/{{ $value->video_thumbnail }}" alt="" class="image_fit" id="thumbnails-{{$value->id}}">
                    <video class="video-clip" id="video-{{$value->id}}" onclick="this.paused?this.play():this.pause();"></video>
                @else
                    @if(Auth::guard('customer')->check())
                        <!-- <img src="{{ asset('posts/') }}/{{ $value->main_file }}" alt="" class="image_fit"> -->
                        <img src="{{ asset('posts/') }}/{{ $value->main_image_blur }}" alt="" class="image_fit">
                    @else
                        <img src="{{ asset('posts/') }}/{{ $value->main_image_blur }}" alt="" class="image_fit">
                    @endif
                    
                @endif
                <div class="video-blur-section" style="display:flex; justify-content:center;align-items:center;">
                    
                    @if($value->file_type == 'video')

                        <!-- <div class="video-blur-playbtn video-blur-playbtn-edit" data-video="video-{{$value->id}}" data-id="{{$value->id}}" data-src="{{ asset('posts/') }}/{{ $value->main_file }}">
                            <img src="{{ asset('assets/images/prime-play.png') }}" alt="" height="90px" width="90px">
                        </div> -->
                        <div class="video-blur-playbtn">
                            <img src="{{ asset('assets/images/lock-icon.png') }}" alt="" height="90px" width="90px">
                        </div>
                    @else
                        <div class="video-blur-playbtn">
                            <img src="{{ asset('assets/images/lock-icon.png') }}" alt="" height="90px" width="90px">
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
                    <button class="feed--prime--details" style="margin:7px 5px; height:25px;">
                        <img src="{{ asset('assets/images/like-feed.png') }}" alt="" height="22px" width="22px">
                        <div class="feed--prime--details--content">
                            {{$value->like_count}}
                        </div>
                    </button>
                    
                   
                    
                    
                </div>
                <div class="unlock-btn">
                    
                    @if($value->post_type == '0')
                        
                    <button @if($value->price <= auth()->guard('customer')->user()->balance) data-eligble="true" @else data-eligble="false" @endif class="feed--prime--details confirm-unlock" style="margin:7px 5px; height:25px; width:40% !important;">
                        
                        Unlock Now
                   </button>
                    @else
                    <button onclick="" class="feed--prime--details " style="margin:7px 5px; height:25px; width:40% !important;">
                        
                        Unlock Now
                   </button>
                    @endif
                </div>
                <div class="video-type">
                    <div class="post--content">
                        {{ $value->post_title }}<!-- After shower 💦 -->
                    </div>
                   
                </div>
                <div class="date-time">
                    {{ date('d M Y h:i A',strtotime($value->created_at)) }} 
                </div>
                <div class="exclusive">
                    <div class="exclusive-section-first">
                        <input type="text" class="form-control comment--input" placeholder="Type your comment...." />
                    </div>

                </div>
                <div class="view--comment--section">
                    <a href="#">View all comments</a>
                </div>
            </div>
        </div>
    </div>
</main>

@include('user.footer')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        
        $(document).on('click','.confirm-unlock',function(){
            if($(this).attr('data-eligble') == 'true'){
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
                            url: "{{ route('user.post.unlock',[request()->segment(2),$value->id]) }}",
                            method: "get",
                        
                            data: {},
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
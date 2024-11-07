@extends('influencer.login_pages.app')
@push('css')
<style>
    .active{
        background-color: black;
        color: white;
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
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Premium </span>
            </li>
        </ul>
    </nav>
</header>
<main class="mb-70">
    <div class="container-fluid feature--section">
    @foreach($posts as $key =>$value)
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
                                        <button onclick="window.location.href='{{route('user.plan.view',[request()->segment(2),$value->plan_id])}}'" class="bg-black text-white py-2 px-4 rounded-full flex items-center" >
                                            <span>
                                                Subscribe to view post 
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


    </div>
</main>
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
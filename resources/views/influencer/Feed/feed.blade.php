@extends('influencer.login_pages.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .active{
        background-color: black;
        color: white;
    }
    .profile-section{
        height:100px;
        width:30%;
        border:1px solid black;
        box-sizing: border-box;
    }
    .username-section{
        height:100px;
        width:70%;
        border:1px solid black;
        box-sizing: border-box;
    }
    .main-container{
        display:flex;

    }
    .comment-section-container{
        margin:10px 3px ;

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
            <div class="video-section mb-3 owl-carousel owl-theme">
                @if($value->file_type == 'video')
                    <img src="{{ asset('thumbnails/') }}/{{ $value->video_thumbnail }}" alt="" class="image_fit" id="thumbnails-{{$value->id}}">
                    <video class="video-clip" id="video-{{$value->id}}" onclick="this.paused?this.play():this.pause();"></video>
                @else
                    <img src="{{ asset('cover/default_cover.jpg') }}" alt="" class="image_fit item">
                    <img src="{{ asset('cover/pratyushgaur.jpg') }}" alt="" class="image_fit item">
                    <img src="{{ asset('cover/pratyushgaur.jpeg') }}" alt="" class="image_fit item">
                @endif
                <!-- <div class="video-blur-section">
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
                </div> -->
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
                    <!-- <div class="post--btn">
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/copy-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                        <div class="feed--icons--box">
                            <img src="{{ asset('assets/images/notification-icon.png') }}" alt="" height="13px" width="13px">
                        </div>
                    </div> -->
                </div>
                <div class="date-time">
                    {{ Helpers_time_ago($value->created_at) }}
                  
                </div>
                <div class="exclusive">
                    <div class="exclusive-section-first">
                        <input type="text" class="form-control comment--input comment-input" placeholder="Type your comment...." />
                    </div>
                    <div class="exclusive-section-second sendComment" data-postid="{{ $value->id }}" style="background:black; border-radius:100%; height: 40px;width:40px;display:flex; justify-content:center;align-items:center; margin-left:15px;">
                        <img src="{{ asset('assets/images/send.png') }}" alt="" style="height: 24px;width:24px; ">
                    </div>
                    <div class="exclusive-section-second edit-post" data-postid="{{ $value->id }}" data-postype="{{ $value->post_type }}">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                    </div>
                </div>
                <div class="view--comment--section view-all-comment" onclick="showCommentBox('{{ $value->id  }}')">
                    <a href="#" >View all comments</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>
 <!-- crea Membership model -->
 <div id="edit-menbership-model" class="userlist_model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head"> Comments</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close modelClose" alt="">
            </div>
        </div>
        <div class="usercontainer">
            <div class="comment-section-container"></div>
            <h5 class="no_data" style="text-align:center; margin-top:20px; display:none;">No Comment exists</h5>
        </div>
    </div>
</div>

<!-- edit post -->

<!-- crea Membership model -->
<div id="edit-menbership-model" class="edit_post_model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head"> Edit Post</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close close_edit_post_model" alt="">
            </div>
        </div>
        <div style=" margin-top:20px;" class="edit-post-form-section">
            <span class="text-danger text-center edit_error_message_post" style="display:block;"></span>
            <form class="edit-post-form" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
                <input type="hidden" class="hidden-edit_id">
                @csrf
                <input type="file" name="coverimage" class="edit-cover-image" style="display:none;">


                <div class="form-group pl-3 pr-3">
                    <label for="Input1">Post Title</label>
                    <textarea class="form-control live-stram-input edit_post_description" name="description" rows="3" id="Input2" placeholder="Post Title "></textarea>
                </div>
                
                
                <div class="form-group pl-3 pr-3">
                    <label for="Select1">Post Type</label>
                    <select name="posttype" class="form-control live-stram-input edit_post_type" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                        <option value="0">Exclusive</option>
                        <option value="1">Subscription</option>
                    </select>
                </div>
                <div class="form-group pl-3 pr-3 edit_price-section">
                    <label for="Select1">Price</label>
                    <select name="price" class="form-control live-stram-input edit_post_price price_sector" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                        <option value="0">Free</option>
                        <?php
                        $price = \App\Models\Price::get();


                        ?>
                        @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                        @endforeach
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div class="form-group pl-3 pr-3" id="customPriceInput" style="display: none;">
                    <label for="customPrice">Custom Price</label>
                    <input type="number" name="price" class="form-control live-stram-input" id="customPrice" placeholder="Enter custom price" min="0">
                </div>
                <div class="form-group pl-3 pr-3 edit_plan-section" style="display:none">
                    <label for="Select1">Choose Subscription</label>
                    <select name="plan" class="form-control live-stram-input edit_post_plans" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                        <?php
                            if (auth()->check()) {
                                $plans = \App\Models\Influencerplan::where('user_id', '=', auth()->user()->id)->get();
                            } else {
                                $plans = [];
                            }
                        ?>
                        @foreach($plans as $key =>$value)
                        <option value="{{ $value->id }}">{{$value->title}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="btn-change-cover-section">
                    <button type="button" class="btn btn-cancel-create stream--btn--bg update-post-btn">
                        Update
                    </button>
                </div>
            </form>
    </div>
        

        
    </div>
</div>

@include('influencer.footer.footer')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:0,
            nav:false,
            dots:true,
            autoHeight:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
        $(".price_sector").change(function(){
            
            let $customPriceInput = $(this).closest('.form-group').next('#customPriceInput');
            console.log($(this).val())
            if ($(this).val() == 'custom') {
                console.log($customPriceInput)
                $customPriceInput.show();
                
                $customPriceInput.find('input').attr('name','price');
                $(this).attr('name','')
                $(this).closest('.form-group').hide();
            } else {
                $customPriceInput.find('input').attr('required', false);
                $customPriceInput.find('input').attr('name','');
                $(this).attr('name','price')
                
            }
        })
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
        


        $(".modelClose").click(function(){

            $(".userlist_model").css('display', 'none');
        })

        $(".sendComment").click(function(){
            if($('.comment-input').val() != ''){
                document.getElementById('loader').classList.add('loader-visible');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData();
                let postid = $(this).attr('data-postid');
                formData.append('comment', $('.comment-input').val());
                formData.append('post_id', postid);
                $.ajax({
                    url: "{{ route('influencer.post.comment.send') }}",
                    method: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    },
                    success: function(response) {
                        
                        if(response.status == "1"){
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

        $(".edit-post").click(function(){
            $("#customPriceInput").hide();
            $('#loader').addClass('loader-visible');
            let postid = $(this).attr('data-postid');
            
            $.ajax({
                    url: "{{ route('influencer.post.get') }}",
                    data: {postid:postid},
                    success: function(response) {
                        console.log(response)
                        $(".edit_post_description").val(response.postdata.post_title);
                        $(".edit_post_type").val(response.postdata.post_type);
                        let price = response.postdata.price;
                        if ($(`.edit_post_price option[value="${price}"]`).length === 0) {
                            // If not, append a new option with the specified value
                            $(`.edit_post_price`).append(new Option(price, price));
                            $(`.edit_post_price`).val(price);
                        }else{
                            $(".edit_post_price").val(price);
                        }
                        
                        $(".edit_post_plans").val(response.postdata.plan_id)
                        $(".hidden-edit_id").val(postid);
                        if(response.postdata.post_type == "0"){
                            $(".edit_price-section").show();
                            $(".edit_plan-section").hide();
                        }else{
                            $(".edit_price-section").hide();
                            $(".edit_plan-section").show();
                        } 
                        document.getElementById('loader').classList.remove('loader-visible');
                    },
                    error:(request, status, error) =>{
                        let er = JSON.parse(request.responseText);
                        document.getElementById('loader').classList.remove('loader-visible');
                        Swal.fire({text:er.message,confirmButtonColor: "#333",});
                    }


                });
            $(".edit_post_model").css('display', 'flex');
        })
        $(".edit_post_type").change(function() {
            if ($(this).val() == '0') {
                $(".edit_plan-section").hide();
                $(".edit_price-section").show();
            } else {
                $(".edit_price-section").hide();
                $(".edit_plan-section").show();
            }
        })
        $(".close_edit_post_model").click(function(){
            $(".edit_post_model").css('display', 'none');
        })
        
        
    })

                    
    $(".update-post-btn").click(function(){
        if ($('.edit-post-form').valid()) {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            document.getElementById('loader').classList.add('loader-visible');
            const formData = new FormData();
            formData.append('title', $('.edit_post_description').val());
            formData.append('post_type', $('.edit_post_type').val());
            if($('.edit_post_price').val() == 'custom'){
            
                formData.append('post_price', $('#customPrice').val());
            }else{
                formData.append('post_price', $('.edit_post_price').val());
            }
            
            formData.append('post_plans', $('.edit_post_plans').val());
            formData.append('id',  $(".hidden-edit_id").val());
            $.ajax({
                    url: "{{ route('influencer.post.update') }}",
                    method: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    },
                    success: function(response) {
                        
                        if(response.status == "1"){
                            window.location.reload();    
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

    $('.edit-post-form').validate({
        rules: {
            description: {
                required: true
            },
            price: {
                required: (element) => {
                    return $('.post_type').val() === '0';
                },
                number: true,

            },
            plans: {
                required: (element) => {
                    return $('.post_type').val() === '1';
                }
            }

        },
        errorElement: 'span',
        errorLabelContainer: '.edit_error_message_post',
        messages: {
            description: {
                required: "Please enter the post title",
            },
            edit_post_price: {
                required: "Please Choose the price",
                number: "Please enter a valid number",
            },
            plans: {
                required: "Please Choose the Plan",
                number: "Please enter a valid number",
            }

        }
    });

    function showCommentBox(postid){
        $.ajax({
            url: "{{ route('influencer.post.comment.get') }}",
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
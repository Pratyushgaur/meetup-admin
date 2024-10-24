<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('OwlCarousel/dist/assets/owl.theme.default.min.css')}}">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>Document</title>
    @stack('css')
    <style>
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Make sure it overlays everything */
            visibility: hidden;
            /* Initially hidden */
        }

        /* Spinner Styles */
        .spinner {
            border: 8px solid #333;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Show the loader */
        .loader-visible {
            visibility: visible;
        }

        .addmorecontiner {
            margin: 20px;
            border: 1px solid black;
            text-align: center;
            padding: 5px 0px 5px 0px;
            cursor: pointer;
        }

        .image-preview-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px;
            height: 100px;
            padding: 5px 10px;
            overflow-X: scroll;
        }
        .video-preview-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px;
            min-height: 200px;
            max-height: 250px;
            padding: 5px 10px;
        }

        .createPostImg {
            width: 79px;
            height: 79px;
            margin: 5px 5px 5px 5px;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        /* Optional: This ensures the content is still scrollable */
        .your-element {
            overflow-y: scroll;
            /* Enable scrolling */
        }

        .post-type-container a {
            padding: 20px;
            border: 1px solid gray;
        }

        .error {
            display: block;
        }

        .mainSectioncreate{
            position: relative;
            width: 33.3%;
        }

        #imagePreviewContainer{
            width: 100%;
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

        .deletecreatepost{
            position: absolute;
            height: 15px;
            width: 15px;
            background-color:red;
            border-radius: 50%;
            top: 3px;
            right: 3px;
            display: flex;
            justify-content: center;
            align-items: center;
            color:white;
            border:1px solid red;
        }

        .deletecreatepost span{
            margin-top: -5px;
        }
    </style>
</head>

<body>
    <div id="loader" class="loader-overlay">
        <div class="spinner"></div>
    </div>
    <div class="main-container">
        <div class="content--layout">
            @include('influencer.sidebar.sidebar')
            @yield('content')
            <!--create post model -->
            <div id="createmodel">
                <div class="modelbox">
                    <div class="modelnav">
                        <div class="model--nav--head">Create Post</div>
                        <div onclick="closeModel()">
                            <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close" alt="">
                        </div>
                    </div>
                    <div class="create-post-image-section">
                        <div class="upload_div1" onclick="createImagetrigger()">
                            <div class="upload--image--text">
                                <span>
                                    IMAGE
                                </span>
                                <span>
                                    Upload
                                </span>
                            </div>
                            <img src="{{ asset('assets/images/ac09f82283b596232e9ef288b8131d7e.png') }}" class="cloud" alt="">
                            <img src="{{ asset('assets/images/2d6e123281168335162dc8e3872d95b4@2x.png') }}" alt="" class="upload--image--last">
                            <input type="file" id="createImage" style="display: none;" accept="image/png, image/jpeg">
                        </div>

                        <div class="upload_div2" onclick="createVideotrigger()">
                            <div class="upload--image--text">
                                <span>
                                    VIDEO/GIF
                                </span>
                                <span>
                                    Upload
                                </span>
                            </div>
                            <img src="{{ asset('assets/images/ac09f82283b596232e9ef288b8131d7e.png') }}" class="cloud" alt="">
                            <img src="{{ asset('assets/images/video-upload-icon.png') }}" alt="" class="upload--video--last">
                            <input type="file" id="createVideo" style="display: none;" accept="video/*">
                        </div>

                        <div class="cancal-btn">
                            <a herf="javascript:void(0)" onclick="closeModel()" class="btn ">Cancel</a>
                        </div>

                    </div>
                    <div style="display:none; margin-top:20px;" class="create-post-form-section">
                        <span class="text-danger text-center error_message_post" style="display:block;"></span>
                        <form class="create-post-form" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="coverimage" class="edit-cover-image" style="display:none;">


                            <div class="form-group pl-3 pr-3">
                                <label for="Input1">Post Title</label>
                                <textarea class="form-control live-stram-input post_description" name="description" rows="3" id="Input2" placeholder="Post Title "></textarea>
                            </div>
                            <div class="image-preview-section">
                                <div class="row" id="imagePreviewContainer">
                                    <!-- <div class="mainSectioncreate">
                                        <span class="deletecreatepost">
                                            <span>x</span>
                                        </span>
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="createPostImg" alt="">
                                    </div> -->

                                </div>
                            </div>
                            <div class="addmorecontiner" onclick="createImagetrigger()">
                                <img src="{{asset('assets/images/camera.png')}}" width="20" style="margin-bottom: 4px;" alt=""> Add More
                            </div>
                            <div class="form-group pl-3 pr-3">
                                <label for="Select1">Post Type</label>
                                <select name="posttype" class="form-control live-stram-input post_type" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                    <option value="0">Exclusive</option>
                                    <option value="1">Subscription</option>
                                </select>
                            </div>
                            <div class="form-group pl-3 pr-3 price-section">
                                <label for="Select1">Price</label>
                                <select name="price" class="form-control live-stram-input post_price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                    <?php
                                    $price = \App\Models\Price::get();


                                    ?>
                                    @foreach($price as $key =>$value)
                                    <option value="{{ $value->prices }}">{{$value->prices}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pl-3 pr-3 plan-section" style="display:none">
                                <label for="Select1">Choose Subscription</label>
                                <select name="plan" class="form-control live-stram-input post_plans" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
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
                                <button type="button" class="btn btn-cancel-create stream--btn--bg create-post-btn">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                    <div style="display:none; margin-top:20px;" class="create-video-post-form-section">
                        <span class="text-danger text-center error_message_video_post" style="display:block; "></span>
                        <form class="create-video-post-form" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="coverimage" class="edit-cover-image" style="display:none;">


                            <div class="form-group pl-3 pr-3">
                                <label for="Input1">Post Title</label>
                                <textarea class="form-control live-stram-input video_description" name="description" rows="3" id="Input2" placeholder="Post Title "></textarea>
                            </div>
                            <div class="video-preview-section">
                                <div class="row" id="imagePreviewContainer">
                                <video id="videoPreview" width="100%" height="250" controls>
                                    Your browser does not support the video tag.
                                </video>
                                    <!-- <div class="mainSectioncreate">
                                        <span class="deletecreatepost">
                                            <span>x</span>
                                        </span>
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="createPostImg" alt="">
                                    </div> -->

                                </div>
                            </div>
                            <div class="addmorecontiner" onclick="createVideotrigger()">
                                <img src="{{asset('assets/images/camera.png')}}" width="20" style="margin-bottom: 4px;" alt=""> Add More
                            </div>
                            <div class="form-group pl-3 pr-3">
                                <label for="Select1">Post Type</label>
                                <select name="posttype" class="form-control live-stram-input video_post_type" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                    <option value="0">Exclusive</option>
                                    <option value="1">Subscription</option>
                                </select>
                            </div>
                            <div class="form-group pl-3 pr-3 video_price-section">
                                <label for="Select1">Price</label>
                                <select name="price" class="form-control live-stram-input video_price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                    <?php
                                    $price = \App\Models\Price::get();


                                    ?>
                                    @foreach($price as $key =>$value)
                                    <option value="{{ $value->prices }}">{{$value->prices}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pl-3 pr-3 video_plan-section" style="display:none">
                                <label for="Select1">Choose Subscription</label>
                                <select name="plan" class="form-control live-stram-input video_plans" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
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

                            <canvas id="thumbnailCanvas" style="display: none;"></canvas>
                            <img id="thumbnailPreview" style="display: none;" alt="Video Thumbnail" width="320" height="240">

                            <div class="btn-change-cover-section">
                                <button type="button" class="btn btn-cancel-create stream--btn--bg create-video-post-btn">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
            <!-- create post end model -->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{asset('OwlCarousel/dist/owl.carousel.min.js')}}"></script>
    @vite('resources/js/app.js')
    @stack('js')
    <script>
        var canvas = document.getElementById('thumbnailCanvas');
        function createImagetrigger() {

            document.getElementById("createImage").click();
        }
        let imageFiles = [];
        $("#createImage").change(function(event) {
            document.getElementById('loader').classList.add('loader-visible');
            $(".create-post-image-section").hide();
            $(".create-post-form-section").show();

            const files = event.target.files;
            if (files.length > 0) {
                $.each(files, function(index, file) {
                    if (file instanceof Blob) {
                        imageFiles.push(file);
                        previewImage(file,imageFiles.length - 1);
                    } else {
                        console.error('The selected file is not a valid Blob or File.');
                    }
                });
            }
           // previewImage();
            document.getElementById('loader').classList.remove('loader-visible');
        })
        $("#createVideo").change(function(event) {
            $(".create-post-image-section").hide();
            $(".create-post-form-section").hide();
            $(".create-video-post-form-section").show();
            const file = event.target.files[0];
            const video = document.getElementById('videoPreview');
            
            var context = canvas.getContext('2d');
            if (file && file.type.startsWith('video/')) {
                var videoURL = URL.createObjectURL(file);
                video.src = videoURL;
                video.load();
                video.play();
                video.addEventListener('loadeddata', function() {
                    // Set canvas dimensions to match video dimensions
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    // Seek to a specific time (e.g., 2 seconds) to capture the frame
                    video.currentTime = 2;
                    video.addEventListener('seeked', function() {
                        // Draw the video frame onto the canvas
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        // Convert canvas to data URL for thumbnail preview and upload
                        var thumbnailDataURL = canvas.toDataURL('image/jpeg');
                        $('#thumbnailPreview').attr('src', thumbnailDataURL);
                    }, { once: true });
                });
                const videoPreview = document.getElementById('videoPreview');
               // video.src = URL.createObjectURL(file);
                //video.load();
                video.play();
            }else {
                alert('Please select a valid video file.');
            }
        })
        $(".post_type").change(function() {
            if ($(this).val() == '0') {
                $(".plan-section").hide();
                $(".price-section").show();
            } else {
                $(".price-section").hide();
                $(".plan-section").show();
            }
        })
        $(".video_post_type").change(function() {
            if ($(this).val() == '0') {
                $(".video_plan-section").hide();
                $(".video_price-section").show();
            } else {
                $(".video_price-section").hide();
                $(".video_plan-section").show();
            }
        })

        $(".create-post-btn").click(function() {

            if ($('.create-post-form').valid()) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                document.getElementById('loader').classList.add('loader-visible');
                const formData = new FormData();
                $.each(imageFiles, function(index, file) {
                    formData.append('images[]', file);
                });
                
                formData.append('description', $('.post_description').val());
                formData.append('price', $('.post_price').val());
                formData.append('post_type', $('.post_type').val());
                formData.append('plan', $('.post_plans').val());

                $.ajax({
                    url: "{{ route('influencer.post.submit') }}",
                    method: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    },
                    success: function(response) {
                        // $(".create-post-image-section").hide();
                        // $(".create-post-form-section").show();
                        document.getElementById('loader').classList.remove('loader-visible');
                        window.location.href = "{{ route('influencer.success.page') }}";
                    },


                });
            }


        });
        $(".create-video-post-btn").click(function(){
            if ($('.create-video-post-form').valid()) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                document.getElementById('loader').classList.add('loader-visible');
                const formData = new FormData();
                var videoFile = $('#createVideo')[0].files[0];
                formData.append('video', videoFile);
                formData.append('description', $('.video_description').val());
                formData.append('price', $('.video_price').val());
                formData.append('post_type', $('.video_post_type').val());
                formData.append('plan', $('.video_plans').val());
                canvas.toBlob(function(blob) {
                    formData.append('thumbnail', blob, 'thumbnail.jpg');
                    $.ajax({
                        url: "{{ route('influencer.video.post.submit') }}",
                        method: "post",
                        contentType: false,
                        processData: false,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        success: function(response) {
                            // $(".create-post-image-section").hide();
                            // $(".create-post-form-section").show();
                            document.getElementById('loader').classList.remove('loader-visible');
                            window.location.href = "{{ route('influencer.success.page') }}";
                        },

                    });
                   
                }, 'image/jpeg');
                
                
            }
        })

        $('.create-post-form').validate({
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
            errorLabelContainer: '.error_message_post',
            messages: {
                description: {
                    required: "Please enter the post title",
                },
                price: {
                    required: "Please Choose the price",
                    number: "Please enter a valid number",
                },
                plans: {
                    required: "Please Choose the Plan",
                    number: "Please enter a valid number",
                }

            }
        });

        $('.create-video-post-form').validate({
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
            errorLabelContainer: '.error_message_video_post',
            messages: {
                description: {
                    required: "Please enter the post title",
                },
                price: {
                    required: "Please Choose the price",
                    number: "Please enter a valid number",
                },
                plans: {
                    required: "Please Choose the Plan",
                    number: "Please enter a valid number",
                }

            }
        });

        function createVideotrigger() {
            document.getElementById("createVideo").click();
        }

        function closeModel() {
            $('#createmodel').fadeIn(500).css('display', 'none');
            //document.getElementById("createmodel").style.display = "none";
        }

        function OpenModel() {
            // $("#createmodel").animate({
            //     display:"flex"
            // },3000);
            $(".create-post-image-section").show();
            $(".create-post-form-section").hide();
            $(".create-video-post-form-section").hide();

            $('#createmodel').fadeIn(300).css('display', 'flex');
            //alert('hello');
            // document.getElementById("createmodel").style.display = "flex";
        }

        function openMenu() {
            const screenWidth = window.screen.width;

            if (screenWidth <= 425) {
                document.getElementById("mySidebarContainer").style.width = "100%";
                document.getElementById("mySidebar").style.left = "0px";
            } else {
                document.getElementById("mySidebarContainer").style.width = "425px";
                document.getElementById("mySidebar").style.left = "555px";
                document.getElementById("mySidebar").style.visibility = "visible";
            }
        }

        function CloseMenu() {
            const screenWidth = window.screen.width;

            if (screenWidth <= 425) {
                document.getElementById("mySidebarContainer").style.width = "0";
                document.getElementById("mySidebar").style.left = "-250px";
            } else {
                document.getElementById("mySidebarContainer").style.width = "0";
                document.getElementById("mySidebar").style.left = "300px";
                document.getElementById("mySidebar").style.visibility = "collapse";
            }
            
        }

        function previewImage(file,index) {
            const reader = new FileReader();

            reader.onload = function(e) {

                let src = e.target.result;
                html = '<div class="mainSectioncreate"><span class="deletecreatepost" data-index="'+index+'"><span>x</span></span><img src="' + src + '" class="createPostImg" alt="">';

                $('#imagePreviewContainer').append(html);
            };

            // Debugging: Ensure that the file is indeed a Blob before reading it
            if (file && file instanceof Blob) {
                reader.readAsDataURL(file);
            } else {
                console.error('Failed to read the file as it is not a valid Blob or File.');
            }
        }

        $(document).on('click','.deletecreatepost',function(){
            const index = $(this).data('index');
            imageFiles.splice(index, 1);
            $(this).closest('.mainSectioncreate').remove();
            $('#imagePreviewContainer .mainSectioncreate').each(function(i) {
                $(this).attr('data-index', i);
                $(this).find('.deletecreatepost').attr('data-index', i);
            });
        })
    </script>
</body>

</html>
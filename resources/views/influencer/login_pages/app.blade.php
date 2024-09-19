<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
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
                z-index: 9999; /* Make sure it overlays everything */
                visibility: hidden; /* Initially hidden */
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
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Show the loader */
            .loader-visible {
                visibility: visible;
            }

            .addmorecontiner{
                margin:20px;  
                border :1px solid black;
                text-align:center;
                padding:5px 0px 5px 0px;
                cursor: pointer;

            }
            .image-preview-section{
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                width: 100%;
                margin:20px; 
                height:100px;
                
                padding:5px;
                overflow-X:scroll;
                
            }

            #imagePreviewContainer img{
                width:100px;
                height:100px;
                margin:0px 5px 0px 5px;

            }
            ::-webkit-scrollbar {
                display: none;
            }

            /* Optional: This ensures the content is still scrollable */
            .your-element {
                overflow-y: scroll; /* Enable scrolling */
            }
            .post-type-container a {
                padding:20px;
                border:1px solid gray;


            }
            .error{
                display:block;
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
                        <div class="create-post-image-section" >
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
                            <span class="text-danger text-center error_message_post" style="display:block; "></span>
                            <form class="create-post-form" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="coverimage" class="edit-cover-image" style="display:none;" >
                                
                                
                                <div class="form-group pl-3 pr-3">
                                    <label for="Input1">Post Title</label>
                                    <textarea class="form-control live-stram-input description" name="description" rows="3" id="Input2" placeholder="Post Title "></textarea>
                                </div>
                                <div class="image-preview-section" style="" >
                                      <div class="row" id="imagePreviewContainer" >
                                        <!-- <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt=""> -->
                                        
                                      </div>
                                </div>
                                <div class="addmorecontiner" style="" onclick="createImagetrigger()" >
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
                                    <select name="price" class="form-control live-stram-input price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
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
                                    <select name="plan" class="form-control live-stram-input plans" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                    <?php 
                                        if(auth()->check()){
                                            $plans = \App\Models\Influencerplan::where('user_id','=',auth()->user()->id)->get();     
                                        }else{
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
        @stack('js')
        <script>
        function createImagetrigger() {
            
            document.getElementById("createImage").click();
        }
        let imageFiles = [];
        $("#createImage").change(function(event){
            document.getElementById('loader').classList.add('loader-visible');
            $(".create-post-image-section").hide();
            $(".create-post-form-section").show();
            
            const files  = event.target.files;
            if (files.length > 0) {
                $.each(files, function(index, file) {
                    if (file instanceof Blob) {
                        imageFiles.push(file);
                        previewImage(file);
                    } else {
                        console.error('The selected file is not a valid Blob or File.');
                    }
                });
            }
            previewImage();
            document.getElementById('loader').classList.remove('loader-visible');
            
            

        })
        $(".post_type").change(function(){
            if($(this).val() == '0'){
                $(".plan-section").hide();
                $(".price-section").show();
            }else{
                $(".price-section").hide();
                $(".plan-section").show();
            }
        })

        $(".create-post-btn").click(function(){
           
            if($('.create-post-form').valid()){
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                document.getElementById('loader').classList.add('loader-visible');
                const formData = new FormData();
                $.each(imageFiles, function(index, file) {
                    formData.append('images[]', file);
                });
                formData.append('description',$('.description').val());
                formData.append('price',$('.price').val());
                formData.append('post_type',$('.post_type').val());
                formData.append('plan',$('.plans').val());
                
                $.ajax({
                    url : "{{ route('influencer.post.submit') }}",
                    method:"post",
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

        $('.create-post-form').validate({
            rules: {
                description: {
                    required: true
                },
                price: {
                    required: (element)=>{
                        return $('.post_type').val() === '0';
                    },
                    number: true,
                    
                },
                plans:{
                    required:(element)=>{
                        return $('.post_type').val() === '1';
                    }
                }
                
            },
            errorElement : 'span',
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

        function createVideotrigger() {
            document.getElementById("createVideo").click();
        }

        function closeModel() {
            $('#createmodel').fadeIn(500).css('display','none');
            //document.getElementById("createmodel").style.display = "none";
        }

        function OpenModel() {
            // $("#createmodel").animate({
            //     display:"flex"
            // },3000);

            $('#createmodel').fadeIn(300).css('display','flex');
            //alert('hello');
           // document.getElementById("createmodel").style.display = "flex";
        }

        function openMenu() {
            const screenWidth = window.screen.width;

            if(screenWidth <= 425){
                document.getElementById("mySidebar").style.width = "100%";
            }else{
                document.getElementById("mySidebar").style.width = "425px";
            }
            
        }
        function CloseMenu() {
            document.getElementById("mySidebar").style.width = "0";
        }

        function previewImage(file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                
                let src = e.target.result;
                html = '<img src="'+src+'" class="cloud" alt="">';
                
                $('#imagePreviewContainer').append(html);
            };

            // Debugging: Ensure that the file is indeed a Blob before reading it
            if (file && file instanceof Blob) {
                reader.readAsDataURL(file);
            } else {
                console.error('Failed to read the file as it is not a valid Blob or File.');
            }
        }
        
    </script>
    </body>
</html>
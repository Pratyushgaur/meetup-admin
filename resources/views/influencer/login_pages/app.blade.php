<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

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
                border: 8px solid #f3f3f3;
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
                margin:20px; 
                height:150px;
                border :1px solid black;
                padding:5px;
                overflow-y:scroll;
                
            }
            ::-webkit-scrollbar {
                display: none;
            }

            /* Optional: This ensures the content is still scrollable */
            .your-element {
                overflow-y: scroll; /* Enable scrolling */
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
                                <input type="file" id="createImage" style="display: none;" accept="image/*">
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
                                <a herf="javascript:void(0)" onclick="closeModel()" class="btn create-post-btn">Cancel</a>
                            </div>

                        </div>
                        <div style="display:none; margin-top:20px;" class="create-post-form-section">
                            <form class="editmyform" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="coverimage" class="edit-cover-image" style="display:none;" >
                                <input type="hidden" class="editid" name="editid">
                                
                                <div class="form-group pl-3 pr-3">
                                    <label for="Input1">Post Title</label>
                                    <textarea class="form-control live-stram-input description" name="description" rows="3" id="Input2" placeholder="Post Title "></textarea>
                                </div>
                                <div class="image-preview-section" style="" >
                                      <div class="row" id="imagePreviewContainer" >
                                        <div class="col-md-4 col-lg-4 col-xs-4">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xs-4">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xs-4">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xs-4">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xs-4">
                                        <img src="http://127.0.0.1:8000/assets/images/visitors.png" class="cloud" alt="">
                                        </div>
                                      </div>
                                </div>
                                <div class="addmorecontiner" style="" >
                                        <img src="{{asset('assets/images/camera.png')}}" width="20" style="margin-bottom: 4px;" alt=""> Add More
                                </div>

                                <div class="form-group pl-3 pr-3">
                                    <label for="Select1">Price</label>
                                    <select name="price" class="form-control live-stram-input price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                                        
                                    </select>
                                </div>  

                                <div class="btn-change-cover-section">
                                    <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                        

                    </div>
                </div>
                <!-- create post end model -->
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
            imageFiles.push($(this).target.files);
                document.getElementById('loader').classList.remove('loader-visible');
            // setTimeout(() => {
                
            //     $(".create-post-form-section").show();
            //     document.getElementById('loader').classList.remove('loader-visible');

            // }, 5000);
            

        })

        function createVideotrigger() {
            document.getElementById("createVideo").click();
        }

        function closeModel() {
            document.getElementById("createmodel").style.display = "none";
        }

        function OpenModel() {
            document.getElementById("createmodel").style.display = "flex";
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
            const previewContainer = document.getElementById('imagePreviewContainer');

            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'image-preview';

                const img = document.createElement('img');
                img.src = e.target.result;

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-image';
                removeButton.innerText = 'X';
                removeButton.addEventListener('click', function() {
                    previewContainer.removeChild(previewDiv);
                    imageFiles = imageFiles.filter(f => f !== file); // Remove from the array
                });

                previewDiv.appendChild(img);
                previewDiv.appendChild(removeButton);
                previewContainer.appendChild(previewDiv);
            };

            reader.readAsDataURL(file);
        }
    </script>
    </body>
</html>
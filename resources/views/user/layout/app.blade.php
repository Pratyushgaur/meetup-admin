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
            
            @yield('content')
            
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

        // const root = document.querySelector(':root');
        // root.style.setProperty('--profile-theme', "#088F8F");
        // root.style.setProperty('--feature-theme',"rgb(8, 143, 143)");

        function loginForm() {
           
            $('#createmodel').fadeIn(300).css('display', 'flex');
            //document.getElementById("createmodel").style.display = "none";
        }

        function closeLoginModel() {
            $('#createmodel').fadeIn(300).css('display', 'none');
        }

        function openMenu() {
            const screenWidth = window.screen.width;

            if (screenWidth <= 425) {
                document.getElementById("mySidebar").style.width = "100%";
            } else {
                document.getElementById("mySidebar").style.width = "425px";
            }

        }

        function CloseMenu() {
            document.getElementById("mySidebar").style.width = "0";
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
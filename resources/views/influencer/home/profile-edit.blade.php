@extends('influencer.login_pages.app')

@push('css')
<style>
    main {
        background-color: rgba(var(--feature-theme), .05);
    }

    .modal-backdrop {
        display: none;
    }

    #CopperImg{
        width: 100%;
        max-height: 400px;
    }
</style>
@endpush

@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <li class="nav-item">
                <span class="header-text">Edit Profile</span>
            </li>
        </ul>
    </nav>
</header>
<main>
    <!-- Edit Profile Cover -->
    @error('image')
    <h6 class="text-danger text-center" style="margin-top:5px;">{{$message}}</h6>
    @enderror
    <div class="container-fluid edit--profile--cover">
        <div class="edit--cover--background"></div>
        <img src="{{ URL::TO('cover') }}/{{auth()->user()->cover}}" onerror="this.src='{{ asset('assets/images/cover-profile.jpg') }}'" alt="" class="edit--profile--cover--image">
        <button class="btn cover--change--btn">
            Change cover
        </button>
    </div>
    <form action="{{ route('influencer.profile.cover.post'); }}" id="cover-form" method="post" enctype="multipart/form-data">

        <input type="file" name="image" id="cover--change--input" accept="image/png, image/jpeg">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </form>


    <!-- /Edit Profile Cover -->

    <!-- Edit Profile Data -->
    <div class="container-fluid Edit--profile--data">
        <div class="profile--info">
            <div class="profile--image--section" id="myImg">
                <img src="{{ URL::TO('avator') }}/{{auth()->user()->avtar}}" onerror="this.src='{{ asset('assets/images/verify-badge.png') }}'" alt="" class="profile--image" id="profile-image">

                <div class="edit--profile--text">Click to view</div>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01" src="{{ asset('assets/images/verify-badge.png') }}">
                <div id="caption"></div>
            </div>
        </div>

        <div class="edit--profile--image">
            <button class="btn edit--profile--btn">
                <u>Change image</u>
            </button>
            <form action="{{ route('influencer.profile.avator.post'); }}" id="profile-form" method="post" enctype="multipart/form-data">
                <input type="file" name="image" id="profile--change--input" accept="image/png, image/jpeg">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            </form>

        </div>
    </div>
    <!-- /Edit Profile Data -->

    <!-- Edit Profile Form -->

    <form action="" method="post" id="">

        @csrf
        <div class="container-fluid profile--form">
            @if(Session::has('success'))
            <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
            @endif
            <div class="row">
                <div class="col-12 input--group">
                    <label for="name">Display Name</label>
                    <input type="text" name="fullname" value="{{ auth()->user()->name }}" id="name" placeholder="Your Name" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">Your Bio</label>
                    <textarea name="bio" id="bio" class="form-control profile--form--input" rows="5">{{ auth()->user()->bio }}</textarea>
                </div>

                <div class="col-12 input--group">

                    <label for="color--picker--container">App Theme Colour</label>
                    <div class="form-control profile--form--input--color" id="color--picker--container">

                        <p class="color--picker--text">Choose Colour</p>
                        <input type="color" name="appcolor" id="color--picker" value="{{ auth()->user()->app_theme_color }}">
                        <p id="color--code">{{ auth()->user()->app_theme_color }}</p>
                        <label class="input-color-label border" for="color--picker">
                            <img src="{{ asset('assets/images/color-picker.png') }}" alt="" class="color--picker--label">
                        </label>
                    </div>
                </div>



                <div class="col-12 input--group">
                    <label for="name">Instagram username</label>
                    <input type="text" name="instagram" value="{{ auth()->user()->instagram_url }}" id="name" placeholder="@user.name" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">Snapchat username</label>
                    <input type="text" name="snapchat" value="{{ auth()->user()->snapchat_url }}" id="name" placeholder="@user.name" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">Twitter / X username</label>
                    <input type="text" name="twitter" value="{{ auth()->user()->twitter_url }}" id="name" placeholder="Your Name" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">Youtube Channel</label>
                    <input type="text" name="youtube" value="{{ auth()->user()->youtube_url }}" id="name" placeholder="Youtube Video Link" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">Facebook Profile</label>
                    <input type="text" name="facebook" value="{{ auth()->user()->facebook_url }}" id="name" placeholder="@Profile.link" class="form-control profile--form--input">
                </div>

                <div class="col-12 input--group">
                    <label for="name">LinkedIn Profile</label>
                    <input type="text" name="linkedin" value="{{ auth()->user()->linkedin_url }}" id="name" placeholder="@Profile.link" class="form-control profile--form--input">
                </div>
            </div>

        </div>

        <button type="submit" class="btn define--button">
            Update Profile
        </button>
    </form>
    <!-- /Edit Profile Form -->
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="exampleModalLongbtn" data-toggle="modal" data-target="#exampleModalLong">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:black">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="docs-demo">
                                    <div class="img-container">
                                        <img id="CopperImg" src="" alt="Picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                </div>
            </div>
        </div>
    </div>


</main>
@endsection

@push('js')
<script>
    //Submitting Cover Image
    $('.cover--change--btn').click(function() {
        $('#cover--change--input').trigger("click");
    });

    $('#cover--change--input').change(function() {
        let cropper;
        let imageInput = document.getElementById('cover--change--input');
        
        // Destroy previous CropperJS instance if it exists
        if (typeof cropper != 'undefined') {
            console.log("Destroy previous");
            cropper.destroy();
            cropper = null;
        }
        const file = imageInput.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                // console.log(e,e.target);
                const imgResult = e.target.result;

                const image = document.getElementById('CopperImg');
                image.src = imgResult;
                cropper = new Cropper(image, {
                    aspectRatio: 2/1,
                    minContainerHeight  : 300,
                    minContainerWidth   : 350,
                    dragMode            : 'move',
                    crop(event) {
                        $("#submit").attr('disabled', true);
                    },
                    preview: '.preview'
                });
                cropper.setData({"width":821,"height":461.81249999999994})
                $("#exampleModalLongbtn").click();
            };
            reader.readAsDataURL(file);
        }

        $("#crop").click(function() {
            let canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {

                const file = new File([blob], 'croppedImage.png', {
                    type: blob.type
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                const croppedImageInput = document.getElementById('cover--change--input');
                croppedImageInput.files = dataTransfer.files;
                $("#cover-form").submit();
            });
        });
        
        // var formData = new FormData(this);

        // $.ajax({
        //     type:'POST',
        //     url: $(this).attr('action'),
        //     data:formData,
        //     cache:false,
        //     contentType: false,
        //     processData: false,
        //     success:function(data){
        //         console.log("success");
        //         console.log(data);
        //     },
        //     error: function(data){
        //         console.log("error");
        //         console.log(data);
        //     }
        // });
    });

    //Submitting Profile Image
    $('.edit--profile--btn').click(function() {
        $('#profile--change--input').trigger("click");
    });

    $('#profile--change--input').change(function() {
        let cropper;
        let imageInput = document.getElementById('profile--change--input');
        
        // Destroy previous CropperJS instance if it exists
        if (typeof cropper != 'undefined') {
            console.log("Destroy previous");
            cropper.destroy();
            cropper = null;
        }
        const file = imageInput.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                // console.log(e,e.target);
                const imgResult = e.target.result;

                const image = document.getElementById('CopperImg');
                image.src = imgResult;
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    minContainerHeight  : 300,
                    minContainerWidth   : 350,
                    dragMode            : 'move',
                    crop(event) {
                        $("#submit").attr('disabled', true);
                    },
                    preview: '.preview'
                });
                cropper.setData({"width":821,"height":461.81249999999994})
                $("#exampleModalLongbtn").click();
            };
            reader.readAsDataURL(file);
        }

        $("#crop").click(function() {
            let canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {

                const file = new File([blob], 'croppedImage.png', {
                    type: blob.type
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                const croppedImageInput = document.getElementById('profile--change--input');
                croppedImageInput.files = dataTransfer.files;
                $('#profile-form').submit();
            });
        });
        
        console.log('submitting Profile Image');
    });

    $('#color--picker').click(function() {
        console.log($(this).val());
    })

    $('#bio').summernote({
        placeholder: 'Your Bio',
        tabsize: 2,
        height: 100,
        toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
    });

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("profile-image");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Color picker values change
    const colorCodePreviewInput = document.getElementById("color--picker");
    const colorCodeSelectionInput = document.getElementById("color--code");

    // Function to update preview body color input and store value in localStorage
    function updateColor() {

        const colorValue = this.value;

        //console.log(colorValue);
        colorCodeSelectionInput.innerHTML = colorValue;

        rgbColor = hex2rgb(colorValue);
        const root = document.querySelector(':root');

        // set css variable
        root.style.setProperty('--profile-theme', colorValue);
        root.style.setProperty('--feature-theme', rgbColor);

        // to get css variable from :root
        // localStorage.setItem("bodyColor", colorValue);
    }

    const hex2rgb = (hex) => {
        const r = parseInt(hex.slice(1, 3), 16);
        const g = parseInt(hex.slice(3, 5), 16);
        const b = parseInt(hex.slice(5, 7), 16);

        return r + "," + g + "," + b;
    }

    colorCodePreviewInput.addEventListener("input", updateColor);
</script>
@endpush
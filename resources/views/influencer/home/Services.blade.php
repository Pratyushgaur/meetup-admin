@extends('influencer.login_pages.app')

@push('css')
<style>
    #picture__input {
        display: none;
    }
    #picture__input2 {
        display: none;
    }

    .picture {
        
        aspect-ratio: 16/9;
       
        display: flex;
        align-items: center;
        justify-content: center;
       
        border: 2px solid black;
        border-radius:10px;
        cursor: pointer;
        font-family: sans-serif;
        transition: color 300ms ease-in-out, background 300ms ease-in-out;
        outline: none;
        overflow: hidden;
    }

    .picture:hover {
        color: #777;
        background: #ccc;
    }

    .picture:active {
        border-color: turquoise;
        color: turquoise;
        background: #eee;
    }

    .picture:focus {
        color: #777;
        background: #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .picture__img {
        max-width: 100%;
    }
    .picture__img2 {
        max-width: 100%;
    }

</style>
@endpush
@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0)" onclick="history.back()"  class="back--btn">
                    <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
                </a>
                <span class="header-text">Services</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-120">
    <div class="container-fluid">
        <div class="services--heading--page mt-3 service-lable" contenteditable="true">
            {{auth()->user()->service_label_name}}
        </div>
        <a href="javascript:void(0)" class="services--update--button update-service-lable">
            Update
        </a>
        <form id="service-form" action="{{ route('influencer.services.name.post') }}" style="display:none;" method="post">
            @csrf
            <input type="text" name="service_name" class="service_name">
        </form>
        @foreach($service as $key =>$value)
            <div class="services--detail--section">
                <div class="services--section" style="padding:15px 10px 15px 10px; ">
                    <div class="services--msg" style="text-align:center; height:30%;">
                    
                    {{Str::limit($value->service_type, 40, '...')}}
                    </div>
                    <div class="image-section">
                        <img style="border-radius:10px;" src="{{ URL::TO('services_images') }}/{{ $value->image }}" alt="" onerror="this.onerror=null;this.src='{{ URL::TO('services_images') }}/noimage.jpg';" width="70">
                    </div>
                    <div class="services--price" style="text-align:center;">
                        Price: <b>{{number_format($value->price,2)}}</b>
                    </div>
                </div>
                <div class="services--edit--delete--section">
                    <div class="services--delete--icon--section" onclick="deleteConfirm('{{ route('influencer.services.influencer.delete',$value->id) }}')">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="services--delete--icon--img" alt="">
                    </div>
                    <div class="services--edit--icon--section">
                        <a  data-id="{{ $value->id }}" data-image="{{$value->image}}" data-title="{{$value->service_type}}" data-price="{{ $value->price }}" class="edit-btn">
                            <img src="{{ asset('assets/images/edit-icon.png') }}" class="services--edit--icon--img " alt="">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<div class="create--btn--fixed">
    <div class="create-new create--btn--icon">
        Add More
    </div>
</div>
<!-- Edit Section model -->
<div id="edit-section-model" class="edit-section-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Edit Service</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close" alt="">
            </div>
        </div>

        <form action="{{ route('influencer.services.influencer.post') }}" method="post" enctype="multipart/form-data"> 
            @csrf
            <input type="hidden" name="id" class="hidden_id">
            <div class="form-group mt-3 pl-3 pr-3">
                <label for="Input1">Service Type</label>
                <textarea class="form-control live-stram-input service_type_edit_inp" rows="3" id="Input2" name="service_title" placeholder="Enter the Service title" required></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select class="form-control live-stram-input service_price_edit_inp price_sector" name="price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;" required>
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
            
            <div class="form-group " style="padding:5px;">
                <label class="picture" for="picture__input" tabIndex="0">
                <span class="picture__image">

                </span>
                </label>

                <input type="file" name="service_image" class="picture__input" id="picture__input" accept="image/*" >
            </div>
            

            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>
<!-- /Edit Section model -->

<!-- create new section -->
<div id="edit-section-model" class="create-section-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Create Service</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close" alt="">
            </div>
        </div>

        <form  action="{{ route('influencer.services.influencer.create') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group mt-3 pl-3 pr-3">
                <label for="Input1">Service Type</label>
                <textarea class="form-control live-stram-input" name="service_type" rows="3" id="Input2" placeholder="Enter service title" required></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select class="form-control live-stram-input price_sector" name="price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;" required>
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
            <div class="form-group " style="padding:5px;">
                <label class="picture" for="picture__input2" tabIndex="0">
                <span class="picture__image2"></span>
                </label>

                <input type="file" name="service_image" class="picture__input2" id="picture__input2" accept="image/*" required>
            </div>

            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Create
                </button>
            </div>
        </form>

    </div>
</div>
<!-- /create new section -->

@include('influencer.footer.footer')


@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    //
    $(document).ready(function(){
        $('.create-section-model').css('display', 'none');
        $('.edit-section-model').css('display', 'none');
        $(".update-service-lable").click(function(){
            let html = $(".service-lable").html();
            
            $(".service_name").val(html);
            if(html != ""){
                $("#service-form").submit();
            }
        });

        
        $('.create-new').click(function(){
            $(".picture__image").html("");
            $(".create-section-model").css('display', 'flex');
        })
        
        $('.edit-btn').click(function() {
            $(".picture__image").html("");
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-title");
            let price = $(this).attr("data-price");
            let image = $(this).attr("data-image");
           
            let url = "{{ URL::TO('services_images') }}/"+image;
            $(".service_type_edit_inp").text(name);
            
            if ($(`.service_price_edit_inp option[value="${price}"]`).length === 0) {
                // If not, append a new option with the specified value
                $(`.service_price_edit_inp`).append(new Option(price, price));
                $(`.service_price_edit_inp`).val(price);
            }else{
                $(".service_price_edit_inp").val(price);
            }
            $(".hidden_id").val(id);
            if(image !=""){
                $(".picture__image").html("<img class='picture__img' src='"+url+"' >");
            }
            
            $('.edit-section-model').css('display', 'flex');
        })
        $('.live--model--close').click(function() {
            $('#edit-section-model').css('display', 'none');
            $('.create-section-model').css('display', 'none');
        })
        
    })
</script>
<script>
    let inputFile = document.querySelector("#picture__input");
    console.log(inputFile)
    let pictureImage = document.querySelector(".picture__image");
    let pictureImageTxt = "Choose an image";
    pictureImage.innerHTML = pictureImageTxt;

    inputFile.addEventListener("change", function (e) {
       
    let inputTarget = e.target;
    let file = inputTarget.files[0];

    if (file) {
        let reader = new FileReader();

        reader.addEventListener("load", function (e) {
        let readerTarget = e.target;

        let img = document.createElement("img");
        img.src = readerTarget.result;
        img.classList.add("picture__img");

        pictureImage.innerHTML = "";
        pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
    });
    ///

    let inputFile2 = document.querySelector("#picture__input2");
    let pictureImage2 = document.querySelector(".picture__image2");
    let pictureImageTxt2 = "Choose an image";
    pictureImage2.innerHTML = pictureImageTxt;

    inputFile2.addEventListener("change", function (e) {
        
    let  inputTarget2 = e.target;
    let file = inputTarget2.files[0];

    if (file) {
        let reader = new FileReader();

        reader.addEventListener("load", function (e) {
        let readerTarget2 = e.target;

        let img = document.createElement("img");
        img.src = readerTarget2.result;
        img.classList.add("picture__img2");

        pictureImage2.innerHTML = "";
        pictureImage2.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage2.innerHTML = pictureImageTxt;
    }
    });

    function deleteConfirm(url){
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = url;
            }
        });
    }
    $(".price_sector").change(function(){
     
        let $customPriceInput = $(this).closest('.form-group').next('#customPriceInput');
        console.log($(this).val())
        if ($(this).val() == 'custom') {
            console.log($customPriceInput)
            $customPriceInput.show();
            $customPriceInput.find('input').attr('required', true);
            $customPriceInput.find('input').attr('name','price');
            $(this).attr('name','')
            $(this).closest('.form-group').hide();
        } else {
            $customPriceInput.find('input').attr('required', false);
            $customPriceInput.find('input').attr('name','');
            
        }
    })
        
    
</script>
@endpush
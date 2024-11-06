@extends('influencer.login_pages.app')

@push('css')
<style>
    .error{
        display:block;
    }
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
    
    .table th,td{
        text-align:center;
    }
    .table td{
        font-size:12px;
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
                <span class="header-text">Membership</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-70">
    <div class="container-fluid">
        <div class="membership--heading--page mt-3 service-lable" contenteditable="true">
            {{ auth()->user()->plan_label_name }}
        </div>
        <a href="javascript:void(0)" class="membership--update--button update-service-lable">
                Update
        </a>
        <form id="service-form" action="{{ route('influencer.membership.name.post') }}" style="display:none;" method="post">
            @csrf
            <input type="text" name="service_name" class="service_name">
        </form>
        @foreach($plans as $key =>$value)
            <div class="membership--section--ft">
                <?php 
                    $count = \App\Models\Post::where('plan_id','=',$value->id)->where('post_type','=','1')->count();
                    $date = \App\Models\Post::where('plan_id','=',$value->id)->where('post_type','=','1')->orderBy('id','desc')->limit(1)->first();
                    $isSub = \App\Models\UserSubscription::where('plan_id','=',$value->id)->exists();
                ?>
                <div class="membership--img--section">
                    <img src="{{ URL::TO('plans') }}/{{$value->image}}" onerror="this.onerror=null;this.src='{{ URL::TO("plans/default.webp") }}';" class="membership--img" alt="">
                    <div class="edit--delete--section">
                        @if($count > 0)
                        <div class="membership--delete--icon" onclick="alertMessage('You cant delete this plan because some post is you have submited in plan')">
                            <img src="{{ asset('assets/images/delete-btn.jpg') }}"  alt="" class="edit--delete--icons"  height="100%" width="100%">
                        </div>
                        @elseif($isSub)
                        <div class="membership--delete--icon" onclick="alertMessage('You cant delete this plan because User are used')">
                            <img src="{{ asset('assets/images/delete-btn.jpg') }}"  alt="" class="edit--delete--icons"  height="100%" width="100%">
                        </div>
                        @else
                        <div class="membership--delete--icon" onclick="deleteConfirm('{{ route('influencer.membership.influencer.delete',$value->id) }}')">
                            <img src="{{ asset('assets/images/delete-btn.jpg') }}"  alt="" class="edit--delete--icons"  height="100%" width="100%">
                        </div>
                        @endif
                        
                        <div class="membership--edit--icon edit-plan" data-id="{{ $value->id }}" data-image="{{ $value->image  }}" data-name="{{$value->title}}" data-desc="{{$value->description}}" data-price="{{ $value->price }}">
                            <img src="{{ asset('assets/images/edit-icon.png') }}" alt="" class="edit--delete--icons" height="30px" width="30px" data-id="{{ $value->id }}" data-name="{{$value->title}}" data-desc="{{$value->description}}" data-price="{{ $value->price }}">
                        </div>
                    </div>
                </div>
                <div class="membership--content--section">
                    <div class="membership--content--ft">
                        <p class="membership--card--content--heading">{{$value->title}}</p>
                        <a href="#" class="subscriber--list view_subscriber" data-id="{{ $value->id }}" >Subscriber List</a>
                        <p class="membership--card--price--section">
                            Price
                            <b>{{number_format($value->price,2)}} Per Month</b>
                        </p>
                    </div>
                    <div class="membership--lebal">
                        <div class="membership--lebal--post">
                            Total Post: {{$count}}
                        </div>
                        <div class="membership--lebal--lastpost">
                            @if(empty($date))
                            No Post
                            @else
                            Last Post: {{date('d/m/Y',strtotime($date->created_at))}}
                            @endif  
                            
                        </div>
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
<!-- create Membership model -->
<div id="edit-menbership-model" class="create-section-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Create New Subscription </div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close" alt="">
            </div>
        </div>

       
        
        <span class="text-danger text-center error_message" style="display:block; "></span>

        <form class="myform" method="post" action="{{ route('influencer.membership.create') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group pl-3 pr-3" style="padding-top: 30px;">
                <label for="Input1">Name of Membership</label>
                <input type="text" name="membershipname" class="form-control live-stram-input" id="Input1" placeholder="Premium Membership">
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Input1">Description</label>
                <textarea class="form-control live-stram-input" name="description" rows="3" id="Input2" placeholder="Get a personalized birthday wish video from me"></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select name="price" class="form-control live-stram-input price_sector" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                    @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                    @endforeach
                    <option value="custom">Custom</option>
                </select>
                
            </div>
            <div class="form-group pl-3 pr-3" id="customPriceInput" style="display: none;">
                <label for="customPrice">Custom Price</label>
                <input type="number" name="" class="form-control live-stram-input" id="customPrice" placeholder="Enter custom price" min="0">
            </div>
            <div class="form-group " style="padding:5px;">
                <label class="picture" for="picture__input" tabIndex="0">
                <span class="picture__image">

                </span>
                </label>

                <input type="file" name="coverimage" class="picture__input" id="picture__input" accept="image/*" required>
            </div>

            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
<!-- /create Membership model -->

<!-- crea Membership model -->
<div id="edit-menbership-model" class="edit-section-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Edit Subscription </div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section" >
        
        </div>
        
        <span class="text-danger text-center error_message" style="display:block; "></span>

        <form class="editmyform" method="post" action="{{ route('influencer.membership.edit') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="coverimage" class="edit-cover-image" style="display:none;" >
            <input type="hidden" class="editid" name="editid">
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Name of Membership</label>
                <input type="text" name="membershipname" class="membershipname form-control live-stram-input" id="Input1" placeholder="Premium Membership">
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Input1">Description</label>
                <textarea class="form-control live-stram-input description" name="description" rows="3" id="Input2" placeholder="Get a personalized birthday wish video from me"></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select name="price" class="form-control live-stram-input price service_price_edit_inp price_sector" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                    @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                    @endforeach
                    <option value="custom">Custom</option>
                </select>
            </div>
            <div class="form-group pl-3 pr-3" id="customPriceInput" style="display: none;">
                <label for="customPrice">Custom Price</label>
                <input type="number" name="" class="form-control live-stram-input" id="customPrice" placeholder="Enter custom price" min="0">
            </div>
            <div class="form-group " style="padding:5px;">
                <label class="picture" for="picture__input2" tabIndex="0">
                <span class="picture__image2"></span>
                </label>

                <input type="file" name="coverimage" class="picture__input2" id="picture__input2" accept="image/*" >
            </div>

            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>



<!-- /Edit Membership model -->

<!-- subscribelist -->
 <!-- crea Membership model -->
<div id="edit-menbership-model" class="userlist_model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head"> Subscriber list </div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close modelClose" alt="">
            </div>
        </div>
        <div class="usercontainer">
            <table class="table" style="display:none">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>from</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody class="mytbody">
                  
                </tbody>
                
            </table>
            <h5 class="no_data" style="text-align:center; margin-top:20px; display:none;">No Subscriber for this plan</h5>
        </div>
    </div>
</div>
@include('influencer.footer.footer')

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    $(document).ready(function(){
        
       // $(".userlist_model").css('display', 'flex');
        $.validator.addMethod("imageFile", function(value, element) {
            // Allowed file types: jpg, jpeg, png, gif
            return this.optional(element) || /\.(jpg|jpeg|png|gif)$/i.test(value);
        }, "Please upload a valid image file (jpg, jpeg, png).");
        $(".update-service-lable").click(function(){
           
            let html = $(".service-lable").html();
            
            $(".service_name").val(html);
            if(html != ""){
                $("#service-form").submit();

            }
        });

        $('.create-new').click(function(){
            $(".create-section-model").css('display', 'flex');
        })
        $(".add-cover-image").click(function(){
            $('.cover-image').click();

        })
        $(".edit-cover-image-btn").click(function(){
            $('.edit-cover-image').click();

        })

     

        $('.live--model--close').click(function() {
            $('#edit-menbership-model').css('display', 'none');
            $('.edit-section-model').css('display', 'none');
        })

        $(".edit-plan").click(function(){
           
           
            $(".membershipname").val($(this).attr('data-name'));
            $(".description").text($(this).attr('data-desc'));
            $(".price").val($(this).attr('data-price'));
            $(".editid").val($(this).attr('data-id'));
            let url = "{{ URL::TO('plans') }}/"+$(this).attr('data-image');
            let price = $(this).attr('data-price');
            if($(this).attr('data-image') !=""){
                $(".picture__image2").html("<img class='picture__img' src='"+url+"' >");
            }else{
                $(".picture__image2").html("");
            }
            if ($(`.service_price_edit_inp option[value="${price}"]`).length === 0) {
                // If not, append a new option with the specified value
                $(`.service_price_edit_inp`).append(new Option(price, price));
                $(`.service_price_edit_inp`).val(price);
            }else{
                $(".service_price_edit_inp").val(price);
            }

           $(".edit-section-model").css('display', 'flex');
        })

        $('.myform').validate({ // initialize the plugin
            ignore: [],
            rules: {
                membershipname: {
                    required: true,
                    minlength: 3,
                    maxlength: 25,
                },
                description: {
                    required: true,
                    
                },
                coverimage:{
                    required:true,
                    imageFile: true,  
                }
            },
        
            errorElement : 'span',
            errorLabelContainer: '.error_message',
            messages: {
                membershipname:{
                    required:"Name is Required"
                },
                description:{
                    required:"Description is Required"
                },
                price:{
                    required:"Price is Required"
                },
                coverimage:{
                    required:"Cover Image is requred",
                    imageFile: "Only  image File type are allowed.",
                }
            },
        });

        $('.editmyform').validate({ // initialize the plugin
            ignore: [],
            rules: {
                membershipname: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                },
                description: {
                    required: true,
                    
                },
                
            },
        
            errorElement : 'span',
            errorLabelContainer: '.error_message',
            messages: {
                membershipname:{
                    required:"Name is Required"
                },
                description:{
                    required:"Description is Required"
                },
                price:{
                    required:"Price is Required"
                }
                
            },
        });
        
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
            //
        });
    }
    function alertMessage(message){
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: message,
            footer: ''
        });
    }

    $(".view_subscriber").click(function(){
        $.ajax({
            url: "{{ route('influencer.membership.getAllSubscriber') }}",
            data: {id:$(this).attr('data-id')},
            success: function(response) {
                let json  = JSON.parse(response);
                let html = '';
                //usercontainer
                if(json.user.length > 0){
                    json.user.forEach(element => {
                        //html+=  '<div class="userlist"><div class="username"><h6>'+element.name+'</h6><p>'+element.p_date+' - '+element.ex_date+'</p></div></div>';
                        html+= ' <tr><td>'+element.name+'</td><td>'+element.p_date+'</td><td>'+element.ex_date+'</td></tr>';
                    });
                    $(".no_data").hide();
                    $(".table").show();
                    
                    $(".mytbody").html(html);
                    $(".userlist_model").css('display', 'flex');
                }else{

                    $(".no_data").show();
                    $(".table").hide();
                    $(".userlist_model").css('display', 'flex');
                }
                


            },


        });
    })
    $(".modelClose").click(function(){
        $(".userlist_model").css('display', 'none');
    })
</script>
@endpush

@endsection
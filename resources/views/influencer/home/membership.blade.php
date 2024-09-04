@extends('influencer.login_pages.app')

@push('css')
<style>
    .error{
        display:block;
    }
</style>
@endpush
@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
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
        <div class="membership--section--ft">
            @foreach($plans as $key =>$value)
            <div class="membership--img--section">
                <img src="{{ URL::TO('plans') }}/{{$value->image}}" onerror="this.onerror=null;this.src='{{ URL::TO("plans/default.webp") }}';" class="membership--img" alt="">
                <div class="edit--delete--section">
                    <div class="membership--delete--icon">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" alt="" class="edit--delete--icons"  height="100%" width="100%">
                    </div>
                    <div class="membership--edit--icon edit-plan" data-id="{{ $value->id }}" data-name="{{$value->title}}" data-desc="{{$value->description}}" data-price="{{ $value->price }}">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" alt="" class="edit--delete--icons" height="30px" width="30px" data-id="{{ $value->id }}" data-name="{{$value->title}}" data-desc="{{$value->description}}" data-price="{{ $value->price }}">
                    </div>
                </div>
            </div>
            <div class="membership--content--section">
                <div class="membership--content--ft">
                    <p class="membership--card--content--heading">{{$value->title}}</p>
                    <a href="#" class="subscriber--list">Subscriber List</a>
                    <p class="membership--card--price--section">
                        Price
                        <b>{{number_format($value->price,2)}} Per Month</b>
                    </p>
                </div>
                <div class="membership--lebal">
                    <div class="membership--lebal--post">
                        Total Post: 20
                    </div>
                    <div class="membership--lebal--lastpost">
                        Last Post: 20/06/24
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

<div class="create--btn--fixed">
    <img src="{{ asset('assets/images/add-btn-member.png') }}" alt="" class="create--btn--icon create-new">
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

        <div class="btn-change-cover-section" >
            <a href="javascript:void(0)" class="btn btn-change-cover add-cover-image" >
                Add Cover
            </a>
        </div>
        
        <span class="text-danger text-center error_message" style="display:block; "></span>

        <form class="myform" method="post" action="{{ route('influencer.membership.create') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="coverimage" class="cover-image" style="display:none;" >
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Name of Membership</label>
                <input type="text" name="membershipname" class="form-control live-stram-input" id="Input1" placeholder="Premium Membership">
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Input1">Description</label>
                <textarea class="form-control live-stram-input" name="description" rows="3" id="Input2" placeholder="Get a personalized birthday wish video from me"></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select name="price" class="form-control live-stram-input" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                    @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                    @endforeach
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
            <a href="javascript:void(0)" class="btn btn-change-cover edit-cover-image-btn" >
                Edit Cover
            </a>
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
                <select name="price" class="form-control live-stram-input price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                    @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                    @endforeach
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
<!-- /Edit Membership model -->
@include('influencer.footer.footer')

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
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
           $(".edit-section-model").css('display', 'flex');
        })

        $('.myform').validate({ // initialize the plugin
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
@endpush

@endsection
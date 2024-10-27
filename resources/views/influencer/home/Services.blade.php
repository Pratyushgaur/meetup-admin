@extends('influencer.login_pages.app')

@push('css')
<style>

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
                <div class="services--section">
                    <div class="services--msg">
                    {{$value->service_type}}
                    </div>
                    <div class="services--price">
                        Price: <b>{{number_format($value->price,2)}}</b>
                    </div>
                </div>
                <div class="services--edit--delete--section">
                    <div class="services--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="services--delete--icon--img" alt="">
                    </div>
                    <div class="services--edit--icon--section">
                        <a  data-id="{{ $value->id }}" data-title="{{$value->service_type}}" data-price="{{ $value->price }}" class="edit-btn">
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

        <form action="{{ route('influencer.services.influencer.post') }}" method="post"> 
            @csrf
            <input type="hidden" name="id" class="hidden_id">
            <div class="form-group mt-3 pl-3 pr-3">
                <label for="Input1">Service Type</label>
                <textarea class="form-control live-stram-input service_type_edit_inp" rows="3" id="Input2" name="service_title" placeholder="Enter the Service title" required></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select class="form-control live-stram-input service_price_edit_inp" name="price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;" required>
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

        <form  action="{{ route('influencer.services.influencer.create') }}" method="post">
            @csrf

            <div class="form-group mt-3 pl-3 pr-3">
                <label for="Input1">Service Type</label>
                <textarea class="form-control live-stram-input" name="service_type" rows="3" id="Input2" placeholder="Enter service title" required></textarea>
            </div>

            <div class="form-group pl-3 pr-3">
                <label for="Select1">Price</label>
                <select class="form-control live-stram-input" name="price" id="Select1" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;" required>
                    @foreach($price as $key =>$value)
                        <option value="{{ $value->prices }}">{{$value->prices}}</option>
                    @endforeach
                    
                    
                </select>
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
<script>
    //
    $(document).ready(function(){
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
        
        $('.edit-btn').click(function() {
            
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-title");
            let price = $(this).attr("data-price");
           
            $(".service_type_edit_inp").text(name);
            $(".service_price_edit_inp").val(price);
            $(".hidden_id").val(id);
           
            $('.edit-section-model').css('display', 'flex');
        })
        $('.live--model--close').click(function() {
            $('#edit-section-model').css('display', 'none');
            $('.create-section-model').css('display', 'none');
        })
        
    })
</script>
@endpush
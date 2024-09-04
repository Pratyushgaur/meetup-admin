@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Define</span>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <h5 class="define--heading mt-4">What defines you best?</h5>

        <div class="row">
            @foreach($categories as $key => $value)
            <div class="col-6 main-box"  >
                <div class="define-box" data-id="{{ $value->id }}">
                    <h5 class="fitness">{{$value->name}}</h5>
                    <img src="{{ URL::TO('Assets/images/icons') }}/{{ $value->icon }}" class="fitness_img" alt="">
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    <h6 class="text-danger text-center error"></h6>
    <a href="javascript:void(0)" class="define--button">
        Proceed
    </a>
    
</main>
@endsection

@push('js')
<script>
    $(document).ready(function(){
       $(".define-box").click(function(){
        $('.define-box').css("border","none");
        $('.define-box').removeClass("active");

        $(this).css("border","3px solid green");
        $(this).addClass("active");

       });

       $(".define--button").click(function(){
        let element = $('.main-box').find('.active');
        let url = "{{ URL::TO('/') }}/";
        if(element.attr('data-id')){
            window.location.href = ''+url+'infinfluencer-submit-category/'+element.attr('data-id')+'';

        }else{
            $('.error').html("Please Select Category for process");
        }

       })
    })
</script>
@endpush
@extends('influencer.login_pages.app')
@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
   .imageBox{
    width: 100%;  /* or specify any width */
    height: 300px;  /* set the desired height */
    
    background-color: #f0f0f0;
    margin-top:20px;
   }
   .imageBox img {
        width: 100%;
        height: 100%;
        object-fit: cover;  /* ensures the image covers the div while maintaining aspect ratio */
    }
    .planTitle{
        margin-top:20px;
        text-align:center;
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }
    .planDesc{
        text-align:center;
    }
    .pricebox{
        font-size:22px;
    }
    .add_money-box{
        
        margin-top:20px;
        padding:0px 10px 0px 10px;
        
        
    }
    .add_money-box a{
        background:black;
        padding:10px;
        color:white;
        border-radius:30px;
        font-weight:500;
        text-decoration:none;
        display:block;
        text-align:center;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="header-text">Plan</span>
            </li>
        </ul>
    </nav>
</header>
<main class="mb-70">
    <div class="container-fluid">
        @if($plan->image !='')
       <div class="imageBox">
            <img src="{{ URL::TO('plans') }}/{{ $plan->image }}" alt="" widht="100%;">
       </div>
        @endif
        <div class="planTitle">
             <h4>{{ $plan->title }}</h4>
        </div>
        <div class="planDesc">
             <p>{{ $plan->description }}</p>
        </div>
        <div class="pricebox text-center">
             <b>{{ $plan->price }}/- Month</b>
        </div>
        <div class="add_money-box" >
           <a href="#" class="buy_now" @if($plan->price <= auth()->guard('customer')->user()->balance) data-eligble="true" @else data-eligble="false" @endif>Buy Now</a>
        </div>

    </div>
    
</main>

<div id="createmodel">
    <div class="modelbox stream-model" style="min-height:150px;">
        <div class="modelnav">
            <div class="model--nav--head">Recharge</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close " onclick="closeMdel()" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form>
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1"> Amount </label>
                <input type="number" class="form-control live-stram-input" id="Input1" placeholder="Enter Amount You want to recharge ">
            </div>
            
            
            
            <div class="btn-change-cover-section">
                <button type="button" class="btn btn-cancel-create stream--btn--bg">
                    Recharge
                </button>
            </div>
        </form>
    </div>
</div>

@include('user.footer')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    $(document).ready(function(){
        
        $(".buy_now").click(function(){
            if($(this).attr('data-eligble') == 'true'){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't to Buy this Plan !",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#333",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Buy it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let csrfToken = $('meta[name="csrf-token"]').attr('content');
                        document.getElementById('loader').classList.add('loader-visible');
                        $.ajax({
                            url: "{{ route('user.plan.buy',[request()->segment(2),$plan->id]) }}",
                            method: "get",
                        
                            data: {},
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                            },
                            success: function(response) {
                                document.getElementById('loader').classList.remove('loader-visible');
                                let r = JSON.parse(response);
                                
                                if(r.error){
                                    Swal.fire({text:r.message,confirmButtonColor: "#333",});
                                }else{
                                    window.location.reload();
                                }
                                // $(".create-post-image-section").hide();
                                // $(".create-post-form-section").show();
                                
                                //window.location.href = "{{ route('influencer.success.page') }}";
                            },


                        });
                    }
                });
            }else{
                Swal.fire({
                    text:"Insufficient balance in wallet !",
                    confirmButtonColor: "#333",
                });

            }
        })
    })
  
</script>
@endpush
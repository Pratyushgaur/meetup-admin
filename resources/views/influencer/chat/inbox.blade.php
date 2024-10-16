@extends('influencer.login_pages.app')
@push('css')
<style>
    .priceInputer input{
        border-radius:5px;
        width:90%;  

    }
    .priceInputer button{
        background:black;
        padding:5px;
        color:white;
        margin:0px 0px 0px 5px;
        border-radius:5px;

    }
    .priceInputer {
        display:flex;

    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Inbox</span>
        </div>
    </nav>
</header>
<main style="padding-bottom: 30px;">
    <div class="container-fluid">
        <h4 class="private--message--heading mt-4">
            Paid Private Messanging
        </h4>
        <p class="private--message--content">
            Fans have to pay for every message they send you! They can also send you
            gifts here.
        </p>
        <div class="message--price--section">
            <div class="price--short--div">
                <label for="Select1" class="price--label">Update Per Message Price</label>
                <div class="priceSelector" >
                    <select class="form-control price--input priceSelector" id="Select1"
                        style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                        <?php $select = false; ?>
                        @foreach($price as $key =>$value)
                        @if($value->prices == \Auth::user()->per_msg_charge)
                        <option selected>&#8377 {{$value->prices}}</option>
                        <?php $select = true; ?>
                        @else
                        <option>&#8377 {{$value->prices}}</option>
                        @endif
                        <option>&#8377 {{$value->prices}}</option>
                        @endforeach
                        @if($select == false)
                        <option selected value="{{ \Auth::user()->per_msg_charge }}">&#8377 {{\Auth::user()->per_msg_charge}}</option>
                        @endif
                        <option value="Custom">Custom</option>
                    </select>
                </div>
                <div class="priceInputer" style="display:none;">
                    <input type="text" class="custom_price_input">
                    <button class="btn btn-xs btn priceChangeBtn">save</button>
                    
                </div>
                
            </div>
            <div class="price--short--div">
                <label for="" class="price--label">Sort</label>
                <select class="form-control price--input" style="background: url({{ asset('assets/images/select-arrow.png') }}) no-repeat center right 5px;background-size: 25px;">
                    <option selected >Sort by top Spender</option>
                    <option selected >Sort by Low Spender</option>
                    
                </select>
            </div>
        </div>
        
        @forelse ($list  as $key => $value)
        <div class="payment--detail--section" onclick="window.location.href='{{ route('influencer.chat.list',\Crypt::encryptString($value->id)) }}'">
            <div class="name--spent--section mt-2">
                <p class="name--section pl-3">Pratyush Gaur</p>
                <p class="spent--section pl-3">Spent: &#8377 1,000.00</p>
                <p class="spent--section pl-3">Last seen: 10 minutes ago</p>
            </div>
            <div class="payment--icon--section">
                <div class="block--icon--section">
                    <img src="{{ asset('assets/images/private-block.png') }}" class="block--icon--img" alt="">
                </div>
                <div class="msg--icon--section">
                    <img src="{{ asset('assets/images/private-msg.png') }}" class="msg--icon--img" alt="">
                </div>
            </div>
        </div>  
        @empty
        <div class="private--message--heading mt-4">
            No Conversation Found
        </div>

        @endforelse



        

    </div>
</main>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $(".priceSelector").change(function(){
          if($(this).val() == "Custom")  {
            $(".priceSelector").hide();
            $(".priceInputer").show();
          }
        })
        $(document).on('click','.priceChangeBtn',function(){
            if($(".custom_price_input").val() !=""){
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('influencer.perMsgPrice.update') }}",
                    method: "post",
                    data: {price:$(".custom_price_input").val()},
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        Swal.fire({text:response.message,confirmButtonColor: "#333",});
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    },


                });
            }else{
                Swal.fire({text:"Price Required to enter",confirmButtonColor: "#333",});
            }
        })
    })
</script>
@endpush
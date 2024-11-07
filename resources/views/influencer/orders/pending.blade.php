@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Pending Orders</span>
        </div>
    </nav>
</header>
<main>

    <div class="container-fluid main-pending-container">
        @forelse($orders as $Key =>$value)
        <div class="pending_order_container">
            <div class="feature--heading--order mt-1">
                <span style="font-size:14px">Order ID : <b>#{{$value->order_id}}</b></span>
                <span style="font-size:11px">Date {{date('d/m/y h:i A',strtotime($value->created_at))}} </span>
            </div>

            <div class="deliver--detail--content pl-1">
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Service :
                    </div>
                    <div class="col-9 p-0">
                        <b>{{Str::limit($value->title, 50, '...')}}</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Buyer :
                    </div>
                    <div class="col-9 p-0">
                        <b>{{$value->name}}</b>
                    </div>
                </div>
                <div class="row deliver--section--row">
                    <div class="col-3 p-0">
                        Amount :
                    </div>
                    <div class="col-9 p-0">
                        <b>{{$value->amount}}</b>
                    </div>
                </div>
                

                <a href="{{ route('influencer.chat.list',\Crypt::encryptString($value->userid)) }}" class="btn-chat">
                    Chat
                </a>
                <a href="javascript:void(0)" onclick="markDelivered('{{ route('influencer.orders.status.delivered',$value->id) }}')" class="btn-deliver">
                    Mark Delivered
                </a>
            </div>
        </div>
        @empty
        <div class="pending_order_container">
            <div class="deliver--detail--content pl-1 text-center ">
                <h4>No Order Found</h4>
            </div>
        </div>
        @endforelse
    </div>

</main>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function markDelivered(url){
        Swal.fire({
            title: "Are you sure?",
            text: "This action will change this order status to delivered .. Make sure you have delivered this service .",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Change it!"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = url;
            }
        });
    }
</script>
@endpush
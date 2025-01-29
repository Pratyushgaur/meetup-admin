@extends('admin.layout.app')
@section('title', 'Order Transaction')
@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Transactions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Transaction</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<!-- <div class="seperator-header layout-top-spacing">
    <div class="text-center" style="display:inline-block">
        <button type="button" class="btn btn-primary mb-2 mr-2" data-bs-toggle="modal"
            data-bs-target="#PriceModalCenter">
            Add Gift
        </button>
    </div>
</div> -->

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <form action="{{ url()->current() }}" class="form-horizontal" id="search-form" method="get">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-2 col-md-2 col-sm-12 col-12 p-4">
                            <div class="form-group">
                                <label for="">To</label>
                                <input type="date" class="form-control date" placeholder="date" name="todate" value="{{ request()->has('todate') ? request()->get('todate') : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-2 col-sm-12 col-12 p-4">
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" class="form-control date" placeholder="date" name="fromdate" value="{{ request()->has('fromdate') ? request()->get('fromdate') : Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 p-4">
                            <div class="form-group">
                                <label for="">Influencer</label>
                                <select name="influencer" id="influencer" class="form-control id">
                                    <option value='All'>All</option>
                                    @foreach($influencers as $influencer)
                                        <option value="{{ $influencer->id }}" {{ request()->has('influencer') && $influencer->id == request()->get('influencer') ? 'selected' : '' }}>{{ $influencer->name }} &#x2022; {{ $influencer->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 p-4">
                            <div class="form-group">
                                <label for="">User</label>
                                <select name="user" id="user" class="form-control id">
                                    <option value='All'>All</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request()->has('user') && $user->id == request()->get('user') ? 'selected' : '' }}>{{ $user->name }} &#x2022; {{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="widget-content widget-content-area">
                <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="checkbox-column"> Sl. </th>
                            <th>Order Id</th>
                            <th>User Info</th>
                            <th>Order Type</th>
                            <th>Influancer</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Influencer Amount</th>
                            <th>GST</th>
                            <th>Order At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($sl = 1)
                        @foreach($orders as $order)
                            <tr>
                                <td class="checkbox-column"> {{ $sl }} </td>
                                <td class="checkbox-column"> {{ $order->order_id }} </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame me-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle" src="{{ $order->user->image ?? '' }}" onerror="this.src='{{asset('avator/default_avator.png')}}'">
                                        </div>
                                        <p class="align-self-center mb-0 user-name"> {{ $order->user->username ?? 'Unknown User' }} </p>
                                    </div>
                                </td>
                                <td>
                                    <span class="inv-email">
                                        {{ ucfirst(str_replace('_', ' ', $order->order_type)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame me-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle" src="{{ $order->influencer->image ?? '' }}" onerror="this.src='{{asset('avator/default_avator.png')}}'">
                                        </div>
                                        <p class="align-self-center mb-0 user-name"> {{ $order->influencer->username ?? 'Unknown User' }} </p>
                                    </div>
                                </td>
                                <td>
                                    @if($order->order_status == '0')
                                        <span class="badge badge-light-warning inv-status">
                                            Pending
                                        </span>
                                    @elseif($order->order_status == '1')
                                        <span class="badge badge-light-success inv-status">
                                            Completed
                                        </span>
                                    @elseif($order->order_status == '2')
                                        <span class="badge badge-light-danger inv-status">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-light-success inv-status">
                                        {{ $order->amount }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light-danger inv-status">
                                        {{ $order->user_amount }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success inv-status">
                                        {{ round((18 / 100) * $order->amount, 2) }}
                                    </span>
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($order->created_at)->format('d M Y H:i:s')}}
                                </td>
                            </tr>
                            @php($sl++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>
$(document).ready(function() {
    $('.date').change(function() {
        $('#search-form').submit();
    });

    $('.id').change(function() {
        $('#search-form').submit();
    });

    c2 = $('#invoice-list').DataTable({
        columnDefs: [{
            targets: 0,
            width: "30px",
            className: "",
            orderable: !1,
        }],
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "lengthMenu": [5, 10, 20, 50],
        "pageLength": 10
    });

    $('#gift-input').change(function() {
        console.log($(this).val());
    });
})

document.querySelector('#deleterow').addEventListener('click', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#DeletePrice').submit();
        }
    })
})

$(document).on('click', '.edit-btn', function() {
    $('#newname').val($(this).attr('data-name'));
    $('#newprice').val($(this).attr('data-price'));
    var logo = $(this).attr('data-logo');
    console.log(logo);
    $('#viewer2').attr('src', "{{ asset('gift/') }}" + '/' + logo);
    $('#editid').val($(this).attr('data-id'));
    $('#EditPriceModalCenter').modal('show');
})

function readURL(input, viewer) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            console.log(e.target.result);
            $('#' + viewer).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#customFileEg1").change(function() {
    readURL(this, 'viewer');
});

$("#customFileEg2").change(function() {
    readURL(this, 'viewer2');
});
</script>
@endpush
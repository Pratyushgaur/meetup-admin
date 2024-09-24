@extends('admin.layout.app')
@section('title', 'Transaction Influncer List')
@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Transaction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Influncer</li>
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
            <div class="widget-content widget-content-area">
                <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="checkbox-column"> Record no. </th>
                            <th>Invoice Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="checkbox-column"> 1 </td>
                            <td>#098424</td>
                            <td>
                                <div class="d-flex">
                                    <div class="usr-img-frame me-2 rounded-circle">
                                        <img alt="avatar" class="img-fluid rounded-circle"
                                            src="../src/assets/img/profile-12.jpeg">
                                    </div>
                                    <p class="align-self-center mb-0 user-name"> Alma Clarke </p>
                                </div>
                            </td>
                            <td><span class="inv-email"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg> alma.clarke@gmail.com</span></td>
                            <td><span class="badge badge-light-success inv-status">Paid</span></td>
                            <td><span class="inv-amount">$234.40</span></td>
                            <td><span class="inv-date"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg> 10 Feb </span></td>
                            <td>
                                <a class="badge badge-light-primary text-start me-2 action-edit"
                                    href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-3">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg></a>
                                <a class="badge badge-light-danger text-start action-delete"
                                    href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg></a>
                            </td>
                        </tr>
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
    c2 = $('#style-2').DataTable({
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
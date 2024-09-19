@extends('admin.layout.app')

@push('css')
<style>
    .post--preview--section {
        height: 215px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .style-6 {
        border-radius: 0px 0px 10px 10px !important;
    }

    .post-img-top {
        border-radius: 0px !important;
        max-height: 100% !important;
        max-width: 100% !important;
    }

    body.dark .avatar-xl {
        width: 10.125rem;
        height: 10.125rem;
        font-size: 1.70833rem;
    }

    .avatar-xl {
        width: 10.125rem;
        height: 10.125rem;
        font-size: 1.70833rem;
    }

    .contacts-block{
        max-width: 90% !important;
    }
</style>
@endpush
@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.influncers.list') }}">Influncer List</a></li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $profile->name }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing">
    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 mb-4 ms-auto">
        <select class="form-select form-select" aria-label="Default select example">
            <option selected disabled>Category</option>
            <option value="3">Membership</option>
            <option value="1">Exclusive</option>
        </select>
    </div>

    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 mb-4">
        <select class="form-select form-select" aria-label="Default select example">
            <option value="3">Newest</option>
            <option value="1">Low to High Price</option>
            <option value="3">High to Low Price</option>
            <option value="2">Most Viewed</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <a class="card style-6" href="javascript:void(0)">
            <span class="badge badge-primary">NEW</span>
            <div class="post--preview--section">
                <img src="{{asset('admin/src/assets/img/scroll-7.jpeg')}}" class="post-img-top" alt="...">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 mb-4">
                        <b>Nike Green Shoes</b>
                    </div>
                    <div class="col-3">
                        <div class="badge--group">
                            <div class="badge badge-primary badge-dot"></div>
                            <div class="badge badge-danger badge-dot"></div>
                            <div class="badge badge-info badge-dot"></div>
                        </div>
                    </div>
                    <div class="col-9 text-end">
                        <div class="pricing d-flex justify-content-end">
                            <p class="text-success mb-0">$150.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
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
    })
</script>
@endpush
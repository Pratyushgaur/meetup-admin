@extends('admin.layout.app')
@section('title', 'Pending Order')
@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Influncer</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pending Orders</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-2" class="table style-2 dt-table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column dt-no-sorting">S.No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Avatar</th>
                            <th class="text-center">Pending Order</th>
                            <th class="text-center">View Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($sn = 1)
                        @foreach($influencer_list as $value)
                        <tr>
                            <td class="checkbox-column">
                                {{ $sn }}
                            </td>
                            <td class="text-center">
                                {{ $value->name }}
                            </td>
                            <td class="text-center">
                                <div class="avatar avatar-xl">
                                    <img alt="avatar" src="{{ asset('gift/').'/'.$value->image }}" class="rounded" id="viewer" />
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $value->pending_order }}
                            </td>
                            <td class="text-center">
                                <a class="badge badge-light-primary text-start me-2 action-edit edit-btn" href="{{ route('admin.influncers.pending.order.view' , $value->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @php($sn++)
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
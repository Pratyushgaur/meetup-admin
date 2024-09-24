@extends('admin.layout.app')
@section('title', 'Send Notification')
@push('css')
<style>
#profilepreview {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
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
</style>
@endpush

@section('content')
<div class="container">
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Business
                        Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Send Notification</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing">

        <div id="tabsSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Simple Tabs</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area simple-tab">
                    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Send Notification</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Firebase Config</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="simpletabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="col-lg-11 mx-auto">
                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                            <form action="{{ route('admin.business-setup.send.notification.submit') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Name">Title</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="title" placeholder="Enter Title"
                                                                        name="title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="phone">Description</label>
                                                                    <textarea type="text" class="form-control mb-3"
                                                                        id="description" name="description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="w-100" id="profilepreview">
                                                            <div class="avatar avatar-xl">
                                                                <img alt="avatar" src=""
                                                                    onerror="this.src='{{asset('admin/src/assets/img/upload-en.png')}}'"
                                                                    class="rounded" id="viewer" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="email">Select Box</label>
                                                                    <select name="user_influncer"
                                                                        class="form-control mb-3" selected>
                                                                        <option selected disabledvalue="user">User
                                                                        </option>
                                                                        <option value="influncer">Influncer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="customFileEg1">Image</label>
                                                                    <input type="file" class="form-control mb-3"
                                                                        id="customFileEg1" name="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-group text-end">
                                                            <button type="submit"
                                                                class="btn btn-secondary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row layout-spacing">
                                <div class="col-lg-12">
                                    <div class="statbox widget box box-shadow">
                                        <div class="widget-content widget-content-area">
                                            <table id="style-2" class="table style-2 dt-table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="checkbox-column dt-no-sorting"> S.No. </th>
                                                        <th class="text-center">Title</th>
                                                        <th class="text-center">Description</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">User/Influncer</th>
                                                        <th class="text-center dt-no-sorting">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($sn = 1)
                                                    @foreach($send_notification as $value)
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            {{ $sn }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $value->title }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $value->description }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="avatar avatar-xl">
                                                                <img alt="avatar"
                                                                    src="{{ asset('notification-image/').'/'.$value->image }}"
                                                                    class="rounded" id="viewer" />
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $value->sending_to }}
                                                        </td>

                                                        <td class="text-center">
                                                            <a class="badge badge-light-primary text-start me-2 action-edit edit-btn"
                                                                href="javascript:void(0);" data-name="{{$value->name}}"
                                                                data-price="{{$value->price}}"
                                                                data-logo="{{$value->image}}" data-id="{{$value->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-edit-3">
                                                                    <path d="M12 20h9"></path>
                                                                    <path
                                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                            <form action="#" method="post" style="display:inline-block"
                                                                class="DeletePrice">
                                                                @method('delete') @csrf
                                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                                <a class="badge badge-light-danger text-start action-delete deleterow"
                                                                    href="javascript:void(0);">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            </form>
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
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <form action="{{ route('admin.business-setup.send.notificationkey.submit') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="Name">Keybase Key Configration</label>
                                                    <textarea type="text" class="form-control mb-3" id="Name" name="key"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1 mb-4">
                                                <div class="form-group text-end">
                                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
})
</script>
@endpush
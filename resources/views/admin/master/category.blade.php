@extends('admin.layout.app')

@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Masters</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="seperator-header layout-top-spacing">
    <div class="text-center" style="display:inline-block">
        <button type="button" class="btn btn-primary mb-2 mr-2" data-bs-toggle="modal" data-bs-target="#PriceModalCenter">
            Add Category
        </button>
    </div>
</div>
<!-- Create Modal -->
<div class="modal fade" id="PriceModalCenter" tabindex="-1" role="dialog" aria-labelledby="PriceModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PriceModalCenterTitle">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.masters.category.submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="w-100 d-flex justify-content-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="{{ asset('gift/defualt_gift.jpg')}}" class="rounded" id="viewer" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Logo</label>
                        <input type="file" name="icon" class="form-control" id="customFileEg1" accept="image/*">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="flaticon-cancel-12"></i>
                        Discard
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Create Modal -->

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-2" class="table style-2 dt-table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column dt-no-sorting"> S.No. </th>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Category Image</th>
                            <th class="text-center">Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($sn = 1)
                        @foreach($category as $value)
                        <tr>
                            <td class="checkbox-column">
                                {{ $sn }}
                            </td>
                            <td class="text-center">
                                {{ $value->name }}
                            </td>
                            <td class="text-center">
                                <div class="avatar avatar-xl">
                                    <img alt="avatar" src="{{ asset('category/').'/'.$value->icon }}" class="rounded" id="viewer" />
                                </div>
                            </td>
                            <td class="text-center">
                                @if($value->status == 0)
                                <a href="{{ route('admin.masters.category.status', $value->id) }}">
                                    <span class="badge outline-badge-success mb-2 me-4">
                                        Active
                                    </span>
                                </a>
                                @else
                                <a href="{{ route('admin.masters.category.status', $value->id) }}">
                                    <span class="badge outline-badge-danger mb-2 me-4">
                                        Inactive
                                    </span>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="badge badge-light-primary text-start me-2 action-edit edit-btn" href="javascript:void(0);" data-name="{{$value->name}}" data-logo="{{$value->icon}}" data-id="{{$value->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.masters.category.delete') }}" method="post" style="display:inline-block" class="DeletePrice">
                                    @method('delete') @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">
                                    <a class="badge badge-light-danger text-start action-delete deleterow" href="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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

<!-- Edit Modal -->
<div class="modal fade" id="EditPriceModalCenter" tabindex="-1" role="dialog" aria-labelledby="EditPriceModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditPriceModalCenterTitle">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.masters.editcategory.submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="w-100 d-flex justify-content-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="" class="rounded" id="viewer2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Image</label>
                        <input type="file" name="newicon" class="form-control" id="customFileEg2" accept="image/*">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category image</label>
                        <input type="text" name="newtitle" class="form-control" id="newname">
                    </div>
                </div>
                <input type="hidden" name="editid" id="editid">
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="flaticon-cancel-12"></i>
                        Discard
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Edit Modal -->
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

        $(document).on('click', '.edit-btn', function() {
            $('#newname').val($(this).attr('data-name'));
            var logo = $(this).attr('data-logo');
            console.log(logo);
            $('#viewer2').attr('src', "{{ asset('category/') }}" + '/' + logo);
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
    })
</script>
@endpush
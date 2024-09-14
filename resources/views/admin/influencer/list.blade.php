@extends('admin.layout.app')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/src/assets/css/influncer_profile.css') }}">
@endpush

@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Influncer</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
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
                            <th class="text-center">Posts</th>
                            <th class="text-center">Commision</th>
                            <th class="text-center">Views</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Total Income</th>
                            <th class="text-center">View Posts</th>
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
                                    <img alt="avatar" src="{{ asset('gift/').'/'.$value->image }}" class="rounded"
                                        id="viewer" />
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.influncers.post.view', $value->id) }}">
                                    <span class="badge outline-badge-success mb-2 me-4">
                                        {{ $value->post }}
                                    </span>
                                </a>
                                
                            </td>
                            <td class="text-center">
                                {{ $value->price }}
                            </td>
                            <td class="text-center">
                                {{ $value->price }}
                            </td>
                            <td class="text-center">
                                @if($value->status == 0)
                                <a href="{{ route('admin.influncers.status', $value->id) }}">
                                    <span class="badge outline-badge-success mb-2 me-4">
                                        Active
                                    </span>
                                </a>
                                @else
                                <a href="{{ route('admin.influncers.status', $value->id) }}">
                                    <span class="badge outline-badge-danger mb-2 me-4">
                                        Inactive
                                    </span>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $value->price }}
                            </td>
                            <td class="text-center">
                                <a class="badge badge-light-primary text-start me-2 action-edit edit-btn"
                                    href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-eye">
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

<!-- Modal -->
<div class="modal fade" id="EditPriceModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="EditPriceModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditPriceModalCenterTitle">Profile Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="user-profile custom--form">
                            <div class="widget-content widget-content-area">
                                <div class="text-center influncer--profile--layout">
                                    <a href="javascript:void(0)" class="mt-2 edit-profile" id="edit-profile--cover"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>    
                                    <div class="cover--profile--section">
                                        <img src="{{ asset('admin/src/assets/img/sweet-bg.jpg')}}" alt="avatar" id="viewer1">
                                    </div>
                                    <img src="../src/assets/img/profile-3.jpeg" alt="avatar" class="profile--image" id="viewer2" title="Click To change">
                                </div>
                                <input type="file" name="profilecover" id="customFileEg1" hidden>
                                <input type="file" name="profileimage" id="customFileEg2" hidden>
                                <div class="profile--name--section row">
                                    <div class="profile--name--object">
                                        -
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="name" class="profile--input" require dir="rtl" value="Jhon Jhon">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="username" id="username--input" class="profile--input" require value="tumhara Jhonny">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <textarea name="bio" id="influncer--bio" cols="30" rows="10"
                                            >Your Jhonny👩‍❤️‍👩 | Your Jhonny👩‍❤️‍👩 | Your Jhonny👩‍❤️‍👩 | Your Jhonny👩‍❤️‍👩 | Your Jhonny👩‍❤️‍👩 | Your Jhonny👩‍❤️‍👩</textarea>
                                    </div>
                                </div>

                                <div class="influancer--details--section">
                                    <div class="details--sections--1">
                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone me-1">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="number" class="profile--input" name="number" value="1234567890" title="1234567890" require>
                                            </div>
                                        </div>
                                        <div class="detail--content--container">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-1">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            <div class="detail--content--section">
                                                <input type="email" class="profile--input text-truncate" name="number" value="deepanshuprajapati89@gmail.com" title="deepanshuprajapati89@gmail.com" require>
                                            </div>
                                        </div>
                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user me-1">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="text" class="profile--input" value="Male" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details--sections--2">
                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="number" class="profile--input" name="commission" value="40" require>
                                            </div>
                                        </div>
                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag">
                                                    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                                                    <line x1="4" y1="22" x2="4" y2="15"></line>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <select name="Categories" id="Categories" class="profile--input">
                                                    <option value="Category1">Category1</option>
                                                    <option value="Category2">Category2</option>
                                                    <option value="Category2">Category2</option>
                                                    <option value="Category2">Category2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="influancer--details--section">

                                </div>

                                <div class="influancer--details--section">
                                    <div class="details--sections--1">

                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-1">
                                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="number" class="profile--input" name="number" value="1234567890" title="1234567890" require>
                                            </div>
                                        </div>

                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-1">
                                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="email" class="profile--input text-truncate" name="number" value="deepanshuprajapati89@gmail.com" title="deepanshuprajapati89@gmail.com" require>
                                            </div>
                                        </div>

                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube me-1">
                                                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="text" class="profile--input" value="Male">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details--sections--2">
                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin me-1">
                                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                                    <rect x="2" y="9" width="4" height="12"></rect>
                                                    <circle cx="4" cy="4" r="2"></circle>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="number" class="profile--input" name="number" value="1234567890" title="1234567890" require>
                                            </div>
                                        </div>

                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-1">
                                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="email" class="profile--input text-truncate" name="number" value="deepanshuprajapati89@gmail.com" title="deepanshuprajapati89@gmail.com" require>
                                            </div>
                                        </div>

                                        <div class="detail--content--container">
                                            <div class="detail--icon--section">
                                                <svg height="24" width="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 468.339 468.339" xml:space="preserve" fill="#000000" class="me-1">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                                <g id="SVGRepo_iconCarrier"> 
                                                    <path style="fill:#ffffff;" d="M233.962,33.724c62.857,0.021,115.216,52.351,115.292,115.36c0.018,14.758,0.473,28.348,1.306,40.867 c0.514,7.724,6.938,13.448,14.305,13.448c1.085,0,2.19-0.124,3.3-0.384l19.691-4.616c0.838-0.197,1.679-0.291,2.51-0.291 c5.001,0,9.606,3.417,10.729,8.478c1.587,7.152-2.42,14.378-9.35,16.808l-29.89,12.066c-7.546,3.046-11.599,11.259-9.474,19.115 c23.98,88.654,90.959,79.434,90.959,90.984c0,14.504-50.485,16.552-55.046,21.114s-0.198,26.701-10.389,30.987 c-1.921,0.808-4.65,1.089-7.979,1.089c-7.676,0-18.532-1.498-29.974-1.498c-9.925,0-20.291,1.127-29.404,5.337 c-24.176,11.168-47.484,32.028-76.378,32.028s-52.202-20.86-76.378-32.028c-9.115-4.211-19.478-5.337-29.404-5.337 c-11.441,0-22.299,1.498-29.974,1.498c-3.327,0-6.059-0.282-7.979-1.089c-10.191-4.286-5.828-26.425-10.389-30.987 S25,360.062,25,345.558c0-11.551,66.979-2.331,90.959-90.984c2.125-7.855-1.928-16.068-9.475-19.115l-29.89-12.066 c-6.931-2.43-10.938-9.656-9.35-16.808c1.123-5.062,5.728-8.479,10.729-8.478c0.83,0,1.672,0.094,2.51,0.291l19.691,4.616 c1.11,0.26,2.215,0.384,3.3,0.384c7.366,0,13.791-5.725,14.305-13.448c0.833-12.519,1.289-26.109,1.307-40.867 C119.162,86.075,171.104,33.746,233.962,33.724 M233.97,8.724h-0.009h-0.009C215.19,8.73,196.913,12.5,179.631,19.93 c-16.589,7.131-31.519,17.299-44.375,30.222c-12.839,12.906-22.943,27.889-30.031,44.533c-7.37,17.307-11.118,35.599-11.141,54.368 c-0.011,9.215-0.202,18.158-0.57,26.722l-7.326-1.718c-2.688-0.63-5.452-0.95-8.213-0.951c-7.973-0.001-15.838,2.694-22.146,7.588 c-6.581,5.106-11.196,12.377-12.993,20.474c-4.277,19.273,6.365,38.73,24.807,45.572l21.937,8.855 c-14.526,44.586-41.311,53.13-59.348,58.885c-4.786,1.527-8.92,2.846-12.856,4.799C1.693,327.063,0,340.25,0,345.558 c0,10.167,4.812,19.445,13.551,26.124c4.351,3.326,9.741,6.07,16.477,8.389c9.181,3.161,19.824,5.167,28.474,6.775 c0.418,3.205,1.031,6.648,2.064,10.118c4.289,14.411,13.34,20.864,20.178,23.739c6.488,2.729,13.192,3.044,17.67,3.044 c4.38,0,9.01-0.343,13.912-0.706c5.259-0.39,10.697-0.792,16.062-0.792c8.314,0,14.503,0.992,18.92,3.032 c6.065,2.802,12.497,6.58,19.307,10.579c18.958,11.134,40.445,23.754,67.555,23.754s48.596-12.62,67.554-23.754 c6.81-4,13.242-7.777,19.308-10.579c4.417-2.041,10.606-3.032,18.92-3.032c5.365,0,10.803,0.403,16.061,0.792 c4.902,0.363,9.532,0.706,13.912,0.706c4.478,0,11.181-0.315,17.67-3.044c6.838-2.875,15.889-9.328,20.178-23.739 c1.033-3.47,1.647-6.913,2.064-10.118c8.65-1.609,19.294-3.614,28.474-6.775c6.737-2.319,12.126-5.063,16.477-8.389 c8.738-6.679,13.551-15.957,13.551-26.124c0-5.308-1.693-18.495-17.378-26.278c-3.936-1.953-8.07-3.272-12.856-4.799 c-18.037-5.754-44.822-14.299-59.348-58.885l21.936-8.855c18.442-6.842,29.085-26.3,24.808-45.573 c-1.797-8.097-6.412-15.368-12.993-20.474c-6.308-4.893-14.171-7.588-22.142-7.588c-2.761,0-5.525,0.32-8.215,0.95l-7.327,1.718 c-0.368-8.563-0.559-17.506-0.57-26.722c-0.023-18.784-3.801-37.094-11.23-54.424c-7.131-16.636-17.29-31.615-30.194-44.522 c-12.903-12.906-27.875-23.063-44.498-30.188C271.017,12.497,252.727,8.731,233.97,8.724L233.97,8.724z"/> 
                                                </g>
                                                </svg>
                                            </div>
                                            <div class="detail--content--section">
                                                <input type="text" class="profile--input" value="Male">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this, 'viewer1');
        });

        $("#customFileEg2").change(function() {
            readURL(this, 'viewer2');
        });
    })
    $(document).on('click', '.edit-btn', function() {

        $('#EditPriceModalCenter').modal('show');

    })

    $(document).on('click', '.profile--image', function() {
        $('#customFileEg2').click();
        console.log('done');
    })

    $(document).on('click', '#edit-profile--cover', function() {
        $('#customFileEg1').click();
        console.log('done');
    })
</script>
@endpush
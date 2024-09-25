@extends('admin.layout.app')
@section('title', 'Company Setup')
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
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Business Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Company Setup</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->

        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="tab-content" id="animateLineContent-4">
                    <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
                        aria-labelledby="animated-underline-home-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="section general-info">
                                    <div class="info">
                                        <h6 class="">Company Information</h6>
                                        <form action="{{route('admin.business-setup.company.setup.submit')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Name">Company Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control mb-3" id="Name" placeholder="Enter your company name" value="{{ $data->name ?? null }}" name="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">Email <span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control mb-3" id="email"
                                                                placeholder="Enter your email" name="email" value="{{ $data->email ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control mb-3" name="phone"
                                                                placeholder="Enter your phone number" value="{{ $data->mobile_no ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country">Country <span class="text-danger">*</span></label>
                                                            <select class="form-select mb-3" id="country" name="country">
                                                                <option value="india" {{ $data->country ?? null == 'india'? 'selected' : '' }}>India</option>
                                                                <option value="united_state" {{ $data->country ?? null == 'united_state'? 'selected' : '' }}>United States</option>
                                                                <option value="japan" {{ $data->country ?? null == 'japan'? 'selected' : '' }}>Japan</option>
                                                                <option value="china" {{ $data->country ?? null == 'china'? 'selected' : '' }}>China</option>
                                                                <option value="brazil" {{ $data->country ?? null == 'brazil'? 'selected' : '' }}>Brazil</option>
                                                                <option value="norway" {{ $data->country ?? null == 'norway'? 'selected' : '' }}>Norway</option>
                                                                <option value="canada" {{ $data->country ?? null == 'canada'? 'selected' : '' }}>Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" id="" class="form-control mb-3" cols="30" rows="1">{{ $data->address ?? null }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Facebook URL <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control mb-3" name="facebook"
                                                                placeholder="https://www.facebook.com/" value="{{ $data->facebook_url ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Instagram URL <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control mb-3" name="insta"
                                                                placeholder="https://www.instagram.com/" value="{{ $data->instagram_url ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Twitter URL <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control mb-3" name="twitter"
                                                                placeholder="https://www.twitter.com/" value="{{ $data->X_url ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Linkedin URL <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control mb-3" name="linkedin"
                                                                placeholder="https://www.linkedin.com/" value="{{ $data->linkedin_url ?? null }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="customFileEg1">Logo <span class="text-danger">*</span></label>
                                                                <input type="file" class="form-control mb-3"
                                                                    id="customFileEg1" name="logo" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="customFileEg1">Fevicon <span class="text-danger">*</span></label>
                                                                <input type="file" class="form-control mb-3"
                                                                    id="customFileEg2" name="fevicon" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="w-100" id="profilepreview">
                                                            <div class="avatar avatar-xl">
                                                                <img alt="avatar" src="{{ asset('companyimage/').'/'.($data->logo ?? null) }}"
                                                                    onerror="this.src='{{asset('admin/src/assets/img/upload-en.png')}}'"
                                                                    class="rounded" id="viewer" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100" id="profilepreview">
                                                            <div class="avatar avatar-xl">
                                                                <img alt="avatar" src="{{ asset('companyimage/').'/'.($data->fevicon ?? null) }}"
                                                                    onerror="this.src='{{asset('admin/src/assets/img/upload-en.png')}}'"
                                                                    class="rounded" id="viewer2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-1">
                                                    <div class="form-group text-end">
                                                        <button type="submit" class="btn btn-secondary">Submit</button>
                                                    </div>
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
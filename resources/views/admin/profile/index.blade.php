@extends('admin.layout.app')


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
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <div class="col-lg-11 mx-auto">
                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                        <form action="{{ route('admin.profile.profileSubmit') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control mb-3" id="Name" placeholder="Full Name"
                                                    name="name" value="{{ $admin->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" class="form-control mb-3" id="phone"
                                                    placeholder="Enter your phone number" name="phone" value="{{ $admin->mobile}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="w-100" id="profilepreview">
                                        <div class="avatar avatar-xl">
                                            <img alt="avatar" src="{{ asset('adminProfile/').'/'.$admin->profile_image}}"
                                            onerror="this.src='{{asset('admin/src/assets/img/profile-30.png')}}'" class="rounded" id="viewer" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control mb-3" id="email"
                                                    placeholder="Enter your email" name="email" value="{{ $admin->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="customFileEg1">Image</label>
                                                <input type="file" class="form-control mb-3" id="customFileEg1" name="image" accept="image/*">
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
                        <hr>
                        <form action="{{ route('admin.profile.profilepasswordSubmit') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control mb-3" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control mb-3" id="password_confirmation" name="password_confirmation">
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
</script>
@endpush
@extends('admin.layout.app')
@section('title', 'Commission Setup')
@section('content')
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <div class="col-lg-11 mx-auto">
                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                        <form action="{{ route('admin.business-setup.commission.setup.submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="commission">Default Commission <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control mb-3" id="Name"
                                                name="default_commission" value="{{ $data->Influancer_default_commission ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="radio" value="all" name="influncer" id="input1">
                                        <label for="input1"> All Influncer </label><br>
                                        <input type="radio" value="new" name="influncer" id="input2">
                                        <label for="input2"> Only For Upcoming Influncer</label><br>
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

@extends('admin.layout.app')
@section('title', 'Influncer Post View')
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

.contacts-block {
    max-width: 90% !important;
}

.badge {
    z-index: 12;
}

.splide__arrows {
    display: none;
}

.splide__pagination {
    top: 140px;
}

.splide__list{
    height: 215px;
}

.splide__list > li > img{
    height: 100%;
    object-fit: contain;
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
    @foreach($post as $value)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a class="card style-6" href="javascript:void(0)">
                <span class="badge badge-primary">NEW</span>
                <div class="post--preview--section">
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @if($value->file_type == 'image')
                                    <li class="splide__slide">
                                        <img alt="slider-image" class="img-fluid"
                                            src="{{ asset('posts/').'/'.$value->main_file }}">
                                    </li>
                                    @if(!empty($value->more_files))
                                        @php($image = json_decode($value->more_files))
                                        @foreach($image as $value2)
                                        <li class="splide__slide">
                                            <img alt="slider-image" class="img-fluid" src="{{ asset('posts/').'/'.$value2 }}">
                                        </li>
                                        @endforeach
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <b>{{ $value->post_title }}</b>
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
                                <p class="text-success mb-0">{{ $value->price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
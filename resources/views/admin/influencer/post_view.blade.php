@extends('admin.layout.app')
@section('title', 'Influncer Post View')
@push('css')
<style>

.post--preview--section {
    height: 284.5px;
    width: 284.5px;
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

.owl-carousel{
    height: 100%;
}

.owl-stage-outer{
    height: 100%;
}

.owl-dots{
    position: absolute;
    bottom: 0px;
    left: calc(50% - 33px);
}

.fit-img{
    height: 100% !important;
    max-width: 100% !important;
    object-fit: contain !important;
    aspect-ratio: 1/1;
}

.post_type_label {
    display: inline;
    min-width: 30px;
    background-color: blue;
    text-align: center;
    padding: 0px 5px;
    border-radius: 5px;
    margin: 0px 10px 5px 0px;
    min-height: 15px;
    font-size: 12px;
    color: #ffffff;
}
</style>
@endpush
@section('content')
<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.influncers.list') }}">Influncer List</a></li>
            <li class="breadcrumb-item"><a href="#">Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $profile->name }}</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing">
    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 mb-4 ms-auto">
        <form action="{{ route('admin.influncers.post.view', $profile->id) }}" class="form" method="get">
            <select class="form-select form-select search" name="category" aria-label="Default select example">
                <option selected disabled>Category</option>
                <option value="0">Exclusive</option>
                <option value="1">Prime</option>
            </select>
        </form>
        
    </div>

    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 mb-4">
        <form action="{{ route('admin.influncers.post.view', $profile->id) }}" class="form" method="get">
            <select class="form-select form-select search" name="sort" aria-label="Default select example">
                <option value="new">Newest</option>
                <option value="low">Low to High Price</option>
                <option value="high">High to Low Price</option>
                <option value="unlock">Most Unlocked</option>
            </select>
        </form>
        
    </div>
</div>

<div class="row">
    @foreach($profile->post as $value)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card style-6">
                <div class="post--preview--section">
                    <div class="owl-carousel owl-theme">
                        @if($value->file_type == 'image')
                            <div class="item">
                                <img alt="slider-image" class="fit-img"
                                    src="{{ asset('posts/').'/'.$value->main_file }}">
                            </div>
                            @if(!empty($value->more_files))
                                @php($image = json_decode($value->more_files))
                                @foreach($image as $value2)
                                    <div class="item">
                                        <img alt="slider-image" class="fit-img" src="{{ asset('posts/').'/'.$value2 }}">
                                    </div>
                                @endforeach
                            @endif
                        @elseif($value->file_type == 'image')
                            <div class="item">
                                <video class="fit-img" src="{{ asset('posts/').'/'.$value->main_file }}"></video>
                                <!-- <img alt="slider-image" class="img-fluid" src="{{ asset('posts/').'/'.$value->main_file }}"> -->
                            </div>
                        @endif
                    </div>  
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <div class="post_type_label">
                                @if($value->post_type == 0)
                                    Exclusive
                                @else
                                    Prime
                                @endif
                            </div>
                            <div class="post_type_label">
                                @if($value->post_type == 1)
                                    {{ $value->plan_id }}
                                @else
                                    {{ $value->price }}
                                @endif
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <b>{{ $value->post_title }}</b>
                        </div>
                        <div class="col-12 mb-1">
                            <b>{{ $value->created_at->format('d/m/Y') }}</b>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="row">
                                <div class="col-6">
                                    Like: {{ $value->like_count }}
                                </div>
                                <div class="col-6 text-end">
                                    Unlocks: {{ $value->total_unlock }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="row">
                                <div class="col-6">
                                    Earnings: {{ $value->total_earn }}
                                </div>
                                <div class="col-6 text-end">
                                    @if($value->status == 0)
                                    <a href="{{ route('admin.influncers.post.status', $value->id) }}">
                                        <span class="text-success mb-2" style="bottom: 0px;">
                                            Active
                                        </span>
                                    </a>
                                    @else
                                    <a href="{{ route('admin.influncers.post.status', $value->id) }}">
                                        <span class="text-danger mb-2">
                                            Inactive
                                        </span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
        </div>
    @endforeach
</div>
@endsection

@push('js')
<script>
    $('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:false,
    dots:true,
    dotsEach:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$('.search').change(function(){
    $(this).parent('.form').submit();
})
</script>
@endpush
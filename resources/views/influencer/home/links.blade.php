@extends('influencer.login_pages.app')

@push('css')
<style>

</style>
@endpush
@section('content')

<header>
    <nav class="navbar navbar--login">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0)" onclick="history.back()"  class="back--btn">
                    <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
                </a>
                <span class="header-text">My Link</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-120">
    <div class="container-fluid">
        <div class="links--section">
            @foreach($links as $key =>$value)
            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        {{$value->title}}
                    </div>
                    <div class="mylink--links text-truncate">
                    {{$value->link}}
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section edit_btn" data-title="{{$value->title}}" data-link="{{ $value->link }}" data-id="{{ $value->id }}">
                        <img src="{{ asset('assets/images/edit-icon.png') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section" onclick="deleteConfirm('{{ route('influencer.link.delete',$value->id) }}')">
                        <a href="#">
                            <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt=""></a>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</main>
<!-- Create New Link model -->
<div id="create-link-model" class="create-link-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Create New Link</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close close_link_modal" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form method="post" action="{{ route('influencer.links.post') }}" class="create-link-form">
            
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Link Title</label>
                <input type="text" name="title" class="form-control live-stram-input" id="Input1" placeholder="What is it for?">
            </div>
            
            <div class="form-group pl-3 pr-3">
                <label for="Input1">URL</label>
                <input type="text" name="url" class="form-control live-stram-input" id="Input1" placeholder="https://abc.com">
            </div>
            
            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<!-- /Create New Link model -->
<!-- edit model -->
<div id="create-link-model" class="edit-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Edit Link</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close close_edit_link_modal" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form method="post" action="{{ route('influencer.links.edit.post') }}" class="create-link-form">
            <input type="hidden" class="hiddenid" name="id">
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Link Title</label>
                <input type="text" name="title" class="form-control live-stram-input title_inp" id="Input1" placeholder="What is it for?">
            </div>
            
            <div class="form-group pl-3 pr-3">
                <label for="Input1">URL</label>
                <input type="text" name="url" class="form-control live-stram-input link_inp" id="Input1" placeholder="https://abc.com">
            </div>
            
            <div class="btn-change-cover-section">
                <button type="submit" class="btn btn-cancel-create stream--btn--bg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<div class="create--btn--fixed">
    <div class="create-new create--btn--icon add_link">
        Add More
    </div>
</div>

@include('influencer.footer.footer')
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $(document).ready(function(){
        
        $('.add_link').click(function(){
            
            $(".create-link-model").css('display', 'flex');
        })
        $(".close_link_modal").click(function(){
            $(".create-link-model").css('display', 'none');
            
        })
        $(".close_edit_link_modal").click(function(){
            $(".edit-model").css('display', 'none');
            
        })
        $('.create-link-form').validate({
            rules: {
                title: {
                    required: true
                },
                url: {
                    required: true

                },
                

            },
            // errorElement: 'span',
            // errorLabelContainer: '.error_message_post',
            messages: {
                title: {
                    required: "Please enter the  title",
                },
                url: {
                    required: "Please Enter Link",
                   
                }

            }
        });

        $(".edit_btn").click(function(){
            let title = $(this).attr('data-title');
            let link = $(this).attr('data-link');
            let id = $(this).attr('data-id');
            $(".link_inp").val(link);
            $(".title_inp").val(title);
            $(".hiddenid").val(id);
            //
            $(".edit-model").css('display', 'flex');

        })
    })
    function deleteConfirm(url){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = url;
                }
            });
    }
</script>
@endpush

@endsection
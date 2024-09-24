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
                <span class="header-text">My Link</span>
            </li>
        </ul>
    </nav>
</header>

<main class="mb-120">
    <div class="container-fluid">
        <div class="links--section">
            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>

            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>

            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>

            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>

            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>

            <div class="links--section--inner">
                <div class="mylink--section">
                    <div class="mylink--msg text-truncate">
                        New Youtube Video Launch
                    </div>
                    <div class="mylink--links text-truncate">
                        https://youtu.be/_1SGm0VsdoY?si=dRp2CS0TG6wouKuR
                    </div>
                </div>
                <div class="links--edit--delete--section">
                    <div class="links--edit--icon--section">
                        <img src="{{ asset('assets/images/edit-blue-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                    <div class="links--delete--icon--section">
                        <img src="{{ asset('assets/images/delete-btn.jpg') }}" class="links--icon--img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Create New Link model -->
<div id="create-link-model">
    <div class="modelbox stream-model">
        <div class="modelnav">
            <div class="model--nav--head">Create New Link</div>
            <div>
                <img src="{{ asset('assets/images/cross-icon.png') }}" class="model--close live--model--close close_link_modal" alt="">
            </div>
        </div>

        <div class="btn-change-cover-section"></div>

        <form>
            @csrf
            <div class="form-group pl-3 pr-3">
                <label for="Input1">Link Title</label>
                <input type="text" class="form-control live-stram-input" id="Input1" placeholder="What is it for?">
            </div>
            
            <div class="form-group pl-3 pr-3">
                <label for="Input1">URL</label>
                <input type="text" class="form-control live-stram-input" id="Input1" placeholder="https://abc.com">
            </div>
            
            <div class="btn-change-cover-section">
                <button type="button" class="btn btn-cancel-create stream--btn--bg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<!-- /Create New Link model -->

<div class="create--btn--fixed">
    <img src="{{ asset('assets/images/add-btn-member.png') }}" alt="" class="create--btn--icon add_link">
</div>

@include('influencer.footer.footer')
@push('js')
<script>
    $(document).ready(function(){
        $('.add_link').click(function(){
            
            $("#create-link-model").css('display', 'flex');
        })
        $(".close_link_modal").click(function(){
            $("#create-link-model").css('display', 'none');
            
        })
    })
</script>
@endpush

@endsection
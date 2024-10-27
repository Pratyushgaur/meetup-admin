<footer>
    <nav class="bottom--navbar">
        <div class="bottom--nav--item">
            <a href="{{ route('influencer.home') }}">
                <img src="{{ asset('assets/images/bottom-nav-home.png') }}" alt="" class="bottom--nav--image">
            </a>
        </div>
        <div class="bottom--nav--item">
            <div id="feed--nav">
                <a href="{{ route('influencer.post','exclusive') }}">
                    <img src="{{ asset('assets/images/post.png') }}" alt="" class="bottom--nav--image"  id="feed--nav--icon">
                </a>
            </div>
        </div>
        <div class="bottom--nav--item" onclick="OpenModel()">
            <img src="{{ asset('assets/images/bottom-nav-add.png') }}" alt="" class="bottom--nav--image">
        </div>
        <div class="bottom--nav--item">
            <a href="{{ route('influencer.notification') }}">
                <img src="{{ asset('assets/images/bottom-nav-notification.png') }}" alt="" class="bottom--nav--image">
            </a>
        </div>
        <div class="bottom--nav--item bottom--nav--active">
            <a href="{{ route('influencer.profile') }}">
                <img src="{{ asset('assets/images/bottom-nav-user.png') }}" alt="" class="bottom--nav--image">
            </a>
        </div>
    </nav>
</footer>
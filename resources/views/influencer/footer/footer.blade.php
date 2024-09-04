<footer>
    <nav class="bottom--navbar">
        <div class="bottom--nav--item">
            <a href="{{ route('influencer.home') }}"><img src="{{ asset('assets/images/bottom-nav-home.png') }}" alt="" class="bottom--nav--image"></a>
        </div>
        <div class="bottom--nav--item">
            <img src="{{ asset('assets/images/bottom-nav-network.png') }}" alt="" class="bottom--nav--image">
        </div>
        <div class="bottom--nav--item" onclick="OpenModel()">
            <img src="{{ asset('assets/images/bottom-nav-add.png') }}" alt="" class="bottom--nav--image">
        </div>
        <div class="bottom--nav--item">
            <img src="{{ asset('assets/images/bottom-nav-notification.png') }}" alt="" class="bottom--nav--image">
        </div>
        <div class="bottom--nav--item bottom--nav--active">
            <a href="{{ route('influencer.profile') }}"><img src="{{ asset('assets/images/bottom-nav-user.png') }}" alt="" class="bottom--nav--image"></a>
        </div>
    </nav>
</footer>
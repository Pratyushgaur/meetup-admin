<footer>
    <nav class="bottom--navbar">
        <div class="bottom--nav--item  {{ Route::currentRouteName() == 'user.home' ? 'bottom--nav--active' : '' }}">
            <a href="{{ route('user.home',request()->segment(2)) }}"><img src="{{ asset('assets/images/bottom-nav-home.png') }}" alt="" class="bottom--nav--image"></a>
        </div>
        <div class="bottom--nav--item {{ Route::currentRouteName() == 'user.post.exclusive' ? 'bottom--nav--active' : '' }} ">
            <a href="{{ route('user.post.exclusive',request()->segment(2)) }}"><img src="{{ asset('assets/images/lock-icon.png') }}" alt="" class="bottom--nav--image"></a>
        </div>
        
        <div class="bottom--nav--item overider_css_for_navitem   {{ Route::currentRouteName() == 'user.post.prime' ? 'bottom--nav--active' : '' }}" >
            <a href="{{ route('user.post.prime',request()->segment(2)) }}"><img src="{{ asset('assets/images/premium-icon.png') }}" alt="" class="bottom--nav--image"></a>
        </div>
        <!-- <div class="bottom--nav--item bottom--nav--active">
            <a href="{{ route('influencer.profile') }}"><img src="{{ asset('assets/images/bottom-nav-user.png') }}" alt="" class="bottom--nav--image"></a>
        </div> -->
    </nav>
</footer>
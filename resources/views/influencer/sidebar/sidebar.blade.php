<div class="sidebar--main--conatiner" id="mySidebar">
    <div class="sidebar--container">
        <div class="logo-sidebar">
            <img src="{{ asset('assets/images/meet_up_logo.png') }}" class="logo-image" alt="">
            <p class="logo-content">Meet-UpMe.com</p>
        </div>

        <div class="point--section">
            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/pending_order.png') }}" alt="" height="18px" width="18px" class="sidebar--img--icon">
                    <span class="sidebar--span--content">Pending orders</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/order_history.png') }}" alt="" class="sidebar--img--icon" height="23px" width="18px">
                    <span class="sidebar--span--content">Order history</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="{{route('influencer.payout.setting')}}" class="sidebar--point">
                    <img src="{{ asset('assets/images/payout_settings.png') }}" alt="" class="sidebar--img--icon" height="18px" width="19px"> 
                    <span class="sidebar--span--content">Payout settings</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/insights.png') }}" alt="" class="sidebar--img--icon" height="19px" width="19px">
                    <span class="sidebar--span--content">Insights</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/send_notification.png') }}" alt="" class="sidebar--img--icon" height="20px" width="20px">
                    <span class="sidebar--span--content">Send notifications</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/alert.png') }}" alt="" class="sidebar--img--icon" height="17px" width="17px">
                    <span class="sidebar--span--content">Alert settings</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/term_service.png') }}" alt="" class="sidebar--img--icon" height="20px" width="20px">
                    <span class="sidebar--span--content">Terms of service</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="#" class="sidebar--point">
                    <img src="{{ asset('assets/images/support.png') }}" alt="" class="sidebar--img--icon" height="20px" width="20px">
                    <span class="sidebar--span--content">Support</span>
                </a>
            </div>

            <div class="sidebar--point--section">
                <a href="{{ route('influencer.logout') }}" class="sidebar--point">
                    <img src="{{ asset('assets/images/Logout.png') }}" alt="" class="sidebar--img--icon" height="20px" width="20px">
                    <span class="sidebar--span--content">Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sideber--close" onclick="CloseMenu()">

    </div>
</div>
@extends('user.layout.app')


@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript: history.go(-1)" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">Verify OTP</span>
        </div>
    </nav>
</header>
<main>
    <!-- Logo -->
    <div class="container-fluid logo--section">
        <img src="{{ asset('assets/images/verify-badge.png') }}" alt="" class="meetup--logo">
    </div>
    <!-- /Logo -->

    <!-- Text -->
    <div class="container-fluid text-center">
        <p class="verify--text">
            We have send you a 4 digit OTP. Please check your Phone  SMS
        </p>
    </div>
    <!-- /Text -->

    <!-- Sign up form -->
    <div class="container-fluid">
        <form action="{{ route("user.verify.post",request()->segment(2)) }}" method="post" class="verify--form">
            @csrf
            <p class="verify--text">
                Enter OTP
            </p>
            <div class="verify--input--section digit-group">
                <input type="number" id="digit-1" class="form-control form--input otp in1" data-next="digit-2"  name="otp_1" onKeyPress="if(this.value.length==1) return false;" placeholder="0">
                <input type="number" id="digit-2" class="form-control form--input otp in2" data-next="digit-3" data-previous="digit-1" name="otp_2"  onKeyPress="if(this.value.length==1) return false;" placeholder="0">
                <input type="number" id="digit-3" class="form-control form--input otp in3" data-next="digit-4" data-previous="digit-2" name="otp_3" onKeyPress="if(this.value.length==1) return false;" placeholder="0">
                <input type="number" id="digit-4" class="form-control form--input otp in4" data-next="digit-5" data-previous="digit-3" name="otp_4" onKeyPress="if(this.value.length==1) return false;" placeholder="0">
            </div>
            @if(Session::has('otperror'))
                <span class="text-danger">{{ Session::get('otperror') }}</span>
            @endif

            <button class="btn btn--submit mt-3">
                Verify
            </button>
        </form>

        <form action="" method="post" class="verify--resend mt-2">
            <button class="btn btn--verify mt-3">
                Resend OTP
            </button>
        </form>
    </div>
    <!-- Text -->
    <div class="container-fluid text-center mt-3 mb-5">
        <p class="verify--text">
            OTP might take a little longer due to congestion
        </p>
    </div>
    <!-- /Text -->
</main>
@endsection

@push('js')
<script>
    $('.digit-group').find('input').each(function() {
        
        $(this).attr('maxlength', 1);
        $(this).on('keyup', function(e) {
            var parent = $($(this).parent());
            
            if(e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find('input#' + $(this).data('previous'));
                console.log(prev);
                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));
                
                if(next.length) {
                    $(next).select();
                } else {
                    if(parent.data('autosubmit')) {
                        parent.submit();
                    }
                }
            }
        });
    });
</script>
@endpush
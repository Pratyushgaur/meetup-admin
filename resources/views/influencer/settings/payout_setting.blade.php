@extends('influencer.login_pages.app')
@push('css')
<style>
    .error{
        color:red;
    }
</style>
@endpush
@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link payout--billing">Payout & Billing Settings</span>
        </div>
    </nav>
</header>
<main class="mb-70">
    <div class="container-fluid">
    <span class="text-danger text-center error_message" style="display:block; "></span>
        <!-- <form action="{{ route('influencer.payout.setting.post') }}" method="post" enctype="multipart/form-data" id="kyc_form"> -->
        <form action="#" method="post" enctype="multipart/form-data" id="kyc_form">

            @csrf
            <div class="text-decore">
                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" value="@if(isset($kyc->pan_card)){{ $kyc->pan_card }}@endif"  name="pan_card" placeholder="PAN number">
                      @error('pan_card')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror  
                    
                </div>
                <div class="content-billing">
                    1% of your transction value will be deducted towards TDS.TDS (Tax Deducted at Source) is a form of
                    income tax introduced by the indian goverment as part of the income Tax Act.If you are based in
                    India,you are requried to provide this number,we are requird to withhold 5% of all your transaction
                    value.
                </div>
                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" value="@if(isset($kyc->gst_no)){{ $kyc->gst_no }}@endif" name="gst_no" placeholder="GSTIN (optional)">
                    @error('gst_no')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>
                <div class="content-billing">
                    If your aggregate turnover in a financial year is more than 20 lakhs( RS. 10 lakhs for North Eastern &
                    Hill States),you are required to submit your GST number.In such cases the custmors will be charged 18%
                    over and above the transaction value and 1% of the transction value will be deducted towards TCS(Tax
                    Collected at Source).In case you fail to furnish the GST number,the transction value will be treated as
                    inclusive of all applicable taxes.
                </div>

                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" name="aadhar_no" value="@if(isset($kyc->aadhar_no)){{ $kyc->aadhar_no }}@endif" placeholder="Aadhar Number">
                    @error('aadhar_no')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="billing--heading">Billing Details</div>

                <div class="form-group mt-1">
                    <input type="text" class="form-control pan--number" name="billing_name" value="@if(isset($kyc->billing_name)){{ $kyc->billing_name }}@endif"  placeholder="Billing Name">
                    @error('billing_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror 
                </div>

                <div class="form-group mt-4">
                    <textarea id="" placeholder="Address" name="address" rows="4" class="form-control address--input">@if(isset($kyc->address)){{ $kyc->address }}@endif</textarea>
                    @error('address')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control pan--number" name="city" value="@if(isset($kyc->city)){{ $kyc->city }}@endif" placeholder="City">
                        @error('city')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control pan--number" name="pincode" value="@if(isset($kyc->pincode)){{ $kyc->pincode }}@endif" placeholder="Pincode">
                        @error('pincode')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                    </div>
                </div>

                <div class="billing--heading mt-4">Bank Settings</div>

                <div class="form-group mt-4">
                    <label for="upiaddress" class="fw-6">UPI Address</label>
                    <input type="text" class="form-control pan--number" name="upi_address" value="@if(isset($kyc->upi_id)){{ $kyc->upi_id }}@endif" id="upiaddress" placeholder="UPI (VPA Address)">
                    @error('upi_address')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="OR--section">OR</div>

                <div class="fw-6">Bank Transfer</div>

                <div class="form-group mt-1">
                    <input type="text" class="form-control pan--number" value="@if(isset($kyc->bank_name)){{ $kyc->bank_name }}@endif" name="bank_name" placeholder="Bank Name">
                    @error('bank_name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" name="account_number" value="@if(isset($kyc->account_no)){{ $kyc->account_no }}@endif" placeholder="Account Number">
                    @error('account_number')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" name="account_holder" value="@if(isset($kyc->account_holder)){{ $kyc->account_holder }}@endif" placeholder="Account Holder's Name">
                    @error('account_holder')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

                <div class="form-group mt-4">
                    <input type="text" class="form-control pan--number" name="account_ifsc" value="@if(isset($kyc->account_ifsc)){{ $kyc->account_ifsc }}@endif" placeholder="IFSC Code">
                    @error('account_ifsc')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror 
                </div>

            </div>

            
            
            <div class="KYC--section">KYC Documents</div>
            <div class="attention--section">Please upload your PAN & Aadhar below</div>

            <div class="upload--file mt-4" id="ChooseFileBtn">
                <div class="row">
                    <div class="col-4 pl-5 mt-2 mb-3">
                        <img src="{{ asset('assets/images/file_icon.jpg') }}" alt="" width="60" height="50">
                    </div>
                    <div class="col-8 mt-4 pl-4">
                        <b>Choose File</b>
                    </div>
                    <input type="file"  accept="image/*" style="display: none;" id="ChooseFile" onchange="loadFile(event)">
                </div>

            </div>

            <div id="FilePreviewSection">
                @if(isset($kyc))
                    <?php 
                    
                    $images = json_decode($kyc->docs);
                    
                    $PervieweImage = asset('assets/images/gallery_icon.jpg');
                    $ShowImage = asset('assets/images/eye_icon.jpg');
                    $DeleteImage = asset('assets/images/delete_icon.jpg');
                    ?>
                    @if($images !=null)
                    @forelse($images as $key =>$value)
                        
                        <div class="uploaded--picture mt-4"><input type="file" style="display: none;" value="" name="files[]"><div class="upload--show--image"><img src="{{ URL::TO('docs') }}/{{ $value }}" alt=""></div><div class="upload--image--name">doc_{{ $key }}</div><div class="upload--view myImg"><img src="{{ $ShowImage  }}" class="eye--icon" alt="" width="57" height="57"><img src="{{ URL::TO('docs') }}/{{ $value }}" style="display:none;" class="Preview-Image"></div></div>
                    @empty
                        <p>No users</p>
                    @endforelse
                    @endif
                @endif      
                
                
            </div>
            <button type="submit" class="define--button submit_btn" @if(isset($kyc)) @if($kyc->status == "0" || $kyc->status == "1") disabled @endif @endif>
            @if(isset($kyc)) 
                @if($kyc->status == "0") Wait For Approval  @endif
                @if($kyc->status == "1") Approved  @endif
            @else
                Update
            @endif
            </button>

        </form>

    </div>
</main>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection

@push('js')
<script>
    let FileInput = document.getElementById('ChooseFile');
    let PreviewSection = document.getElementById("FilePreviewSection");
    let reader = new FileReader();
    let imageFiles = [];

    var PervieweImage = "{{ asset('assets/images/gallery_icon.jpg') }}";
    var ShowImage = "{{ asset('assets/images/eye_icon.jpg') }}";
    var DeleteImage = "{{ asset('assets/images/delete_icon.jpg') }}";

    $('#ChooseFileBtn').click(function() {
        FileInput.click();
    });


    function loadFile(event) {
        const files  = event.target.files;
        if (files.length > 0) {
            $.each(files, function(index, file) {
                if (file instanceof Blob) {
                    imageFiles.push(file);
                } else {
                    console.error('The selected file is not a valid Blob or File.');
                }
            });
        }
        //let csrfToken = $('meta[name="csrf-token"]').attr('content');
        //document.getElementById('loader').classList.add('loader-visible');
        // const files  = event.target.files;
        // const formData = new FormData();
        // formData.append('images', files[0]);
        // $.ajax({
        //     url : "{{ route('influencer.payout.setting.post.doc') }}",
        //     method:"post",
        //     contentType: false, 
        //     processData: false,
        //     data: formData,
        //     headers: {
        //         'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        //     },
        //     success: function(response) {
        //         // // $(".create-post-image-section").hide();
        //         // // $(".create-post-form-section").show();
        //         // document.getElementById('loader').classList.remove('loader-visible');
        //         // window.location.href = "{{ route('influencer.success.page') }}";
        //     },
            
            
        // });
        // document.getElementById('loader').classList.remove('loader-visible');

        
        var name = event.target.files[0].name;
        var filesSelected = event.target.files[0];
        src = URL.createObjectURL(event.target.files[0]);

        var Section = '<div class="uploaded--picture mt-4"><input type="file" style="display: none;" value="' + event.target.files[0] + '" name="files[]"><div class="upload--show--image"><img src="' + src + '" alt=""></div><div class="upload--image--name">' + name + '</div><div class="upload--view myImg"><img src="' + ShowImage + '" class="eye--icon" alt="" width="57" height="57"><img src="' + src + '" style="display:none;" class="Preview-Image"></div><div class="upload--delete"><img src="' + DeleteImage + '" class="delete--icon" alt="" width="57" height="57"></div></div>';
        PreviewSection.insertAdjacentHTML('beforeend', Section);
    };

    // Get the modal
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");

    $(document).on('click', '.myImg', function() {
        var src = $(this).children('.Preview-Image').attr('src');
        modal.style.display = "block";
        modalImg.src = src;
    })

    $('.close').click(function() {
        modal.style.display = "none";
    })

    $(document).on('click', '.upload--delete', function() {
        $(this).parent('.uploaded--picture').remove();
    });
    $('#kyc_form').validate({ // initialize the plugin
        ignore: [],
        rules: {
            pan_card: {
                required: true,
                
            },
            aadhar_no: {
                required: true,
                number: true,
                minlength: 0,
                maxlength:10
                
            },
            billing_name:{
                required: true,
            },
            address:{
                required: true,
            },
            city:{
                required: true,
            },
            pincode:{
                required: true,
                number: true,
                minlength: 0,
                maxlength:6
            },
            bank_name:{
                required: true,
            },
            account_number:{
                required: true,
            },
            account_holder:{
                required: true,
            },
            account_ifsc:{
                required: true,
            },

            
            
        },
    
        // errorElement : 'span',
        // errorLabelContainer: '.error_message',
        messages: {
            pan_card:{
                required:"Pan card Number is Required"
            },
            aadhar_no:{
                required:"Aadhar card is Required"
            },
            billing_name:{
                required:"Billing name is Required"
            },
            address:{
                required:"Address  is Required"
            },
            address:{
                required:"Address  is Required"
            },
            city:{
                  required:"City  is Required"
            },
            pincode:{
                  required:"pincode  is Required"
            },
            bank_name:{
                required:"bank name  is Required"
            },
            account_number:{
                required:"account number  is Required"
            },
            account_holder:{
                required:"account holder  is Required"
            },
            account_ifsc:{
                required:"account ifsc  is Required"
            },

            
        },
    });

    
    $('#kyc_form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($(this).valid()) {
            $(".submit_btn").prop('disabled', true);
            document.getElementById('loader').classList.add('loader-visible');
            const formData = new FormData();
            $.each(imageFiles, function(index, file) {
                formData.append('images[]', file);
            });
            formData.append('pan_card',$("[name='pan_card']").val());
            formData.append('gst_no',$("[name='gst_no']").val());
            formData.append('aadhar_no',$("[name='aadhar_no']").val());
            formData.append('billing_name',$("[name='billing_name']").val());
            formData.append('address',$("[name='address']").val());
            formData.append('city',$("[name='city']").val());
            formData.append('pincode',$("[name='pincode']").val());
            formData.append('upi_address',$("[name='upi_address']").val());
            formData.append('bank_name',$("[name='bank_name']").val());
            formData.append('account_number',$("[name='account_number']").val());
            formData.append('account_holder',$("[name='account_holder']").val());
            formData.append('account_ifsc',$("[name='account_ifsc']").val());
            $.ajax({
                url : "{{ route('influencer.payout.setting.post') }}",
                method:"post",
                contentType: false, 
                processData: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {
                    // // $(".create-post-image-section").hide();
                    // // $(".create-post-form-section").show();
                     document.getElementById('loader').classList.remove('loader-visible');
                     window.location.reload();
                    //// window.location.href = "{{ route('influencer.success.page') }}";
                },
                
                
            });
            //alert("The form is valid and will now submit.");
            //this.submit(); // Submit the form programmatically
        } 
    })
    // $('#form').submit(function(event) {
    //     event.preventDefault();
    //     // console.log($(event.target));
    //     $.ajax({
    //         url:"",
    //         method:"post",
    //         data:{
    //             _token: "{{ csrf_token() }}",
    //             data: $(event.target).serialize()
    //         },
    //         success:function(result) {
    //             event.target.reset()
    //         },
    //         error:console.error
    //     })
    // })
</script>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset(Helpers_get_favicon())}}" />
    <link href="{{ asset('admin/layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/layouts/vertical-dark-menu/loader.js')}}"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('admin/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/src/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/dark/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/src/table/datatable/datatables.css')}}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/src/plugins/css/light/table/datatable/custom_dt_custom.css')}}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/src/plugins/css/dark/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/src/plugins/css/dark/table/datatable/custom_dt_custom.css')}}">

    <link href="{{ asset('admin/src/plugins/src/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/dark/components/modal.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/font-icons/fontawesome/css/regular.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/font-icons/fontawesome/css/fontawesome.css')}}">
    <link href="{{ asset('admin/src/assets/css/light/components/font-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/src/assets/css/dark/components/font-icons.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
    <link href="{{ asset('admin/src/plugins/css/light/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('admin/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/css/light/editors/markdown/simplemde.min.css')}}">

    <link href="{{ asset('admin/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/css/dark/editors/markdown/simplemde.min.css')}}">

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{ asset('admin/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">

    <link href="{{ asset('admin/src/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/assets/css/light/elements/alert.css')}}">

    <link href="{{ asset('admin/src/plugins/css/light/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/plugins/css/light/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/assets/css/light/forms/switches.css')}}">
    <link href="{{ asset('admin/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admin/src/assets/css/light/users/account-setting.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('admin/richtexteditor/rte_theme_default.css')}}" />

    <link href="{{ asset('admin/src/plugins/css/dark/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/assets/css/dark/elements/alert.css')}}">

    <link href="{{ asset('admin/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/plugins/css/dark/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/assets/css/dark/forms/switches.css')}}">
    <link href="{{ asset('admin/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admin/src/assets/css/dark/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <link href="{{ asset('admin/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/src/assets/css/light/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/src/assets/css/dark/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin/src/assets/css/light/components/media_object.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/src/assets/css/dark/components/media_object.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/src/splide/splide.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/css/light/splide/custom-splide.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/css/dark/splide/custom-splide.min.css')}}">

    @stack('css')
    <style>
        .badge {
            cursor: pointer;
        }
    </style>
</head>

<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    @include('admin.layout.partials.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.layout.partials.sidebar')

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">

                    @yield('content')

                </div>
            </div>

            @include('admin.layout.partials.footer')

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->


    <script type="text/javascript">
        var Months = <?php echo json_encode(Helpers_get_previous_months()) ?>;
    </script>
    <script src="{{ asset('admin/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{ asset('admin/layouts/vertical-dark-menu/app.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/global/vendors.min.js')}}"></script>
    <script src="{{ asset('admin/src/assets/js/custom.js')}}"></script>

    <script src="{{ asset('admin/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/src/assets/js/dashboard/dash_1.js')}}"></script>

    <script src="{{ asset('admin/src/plugins/src/table/datatable/datatables.js')}}"></script>

    <script src="{{ asset('admin/src/plugins/src/highlight/highlight.pack.js')}}"></script>
    <!-- <script src="{{ asset('admin/src/assets/js/scrollspyNav.js')}}"></script> -->

    <script src="{{ asset('admin/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <!-- <script src="{{ asset('admin/src/plugins/src/sweetalerts2/custom-sweetalert.js')}}"></script> -->


    <!-- <script src="{{ asset('admin/src/plugins/src/assets/js/scrollspyNav.js')}}"></script> -->

    <script src="{{ asset('admin/src/plugins/src/editors/markdown/simplemde.min.js')}}"></script>
    <!-- <script src="{{ asset('admin/src/plugins/src/plugins/src/editors/markdown/custom-markdown.js')}}"></script> -->

    <script src="{{ asset('admin/src/plugins/src/filepond/filepond.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImagePreview.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImageCrop.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImageResize.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/FilePondPluginImageTransform.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/sweetalerts2/sweetalerts2.min.js')}}"></script>
    <!-- <script src="{{ asset('admin/src/assets/js/users/account-settings.js')}}"></script> -->

    <script src="{{ asset('admin/src/plugins/src/splide/splide.min.js')}}"></script>
    <script src="{{ asset('admin/src/plugins/src/splide/custom-splide.js')}}"></script>
    
    <script type="text/javascript" src="{{ asset('admin/richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/richtexteditor/plugins/all_plugins.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    @stack('js')

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <?php
                flash()->error("{$error}");
            ?>
        @endforeach
    @endif

    <script>
        $(document).on('click', '.deleterow', function() {
            console.log($(this));
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('.DeletePrice').submit();
                }
            })
        })
    </script>
</body>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('style')
    <style>
        .remove-file-btn {
            cursor: pointer;
            position: absolute;
            right: 85px;
            top: 6px;
            color: red;
            opacity: 0.75;
            z-index: 9999999;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.topnav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidenav')
        <!-- /. Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content">
                @include('component.message')
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('layouts.footer')
        <!-- /. main footer -->

    </div>
    <!-- ./wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <!-- bootstrap button -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <!-- SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });

        function changeFile(e) {
            var input = $(e)[0];
            bsCustomFileInput.init();
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).closest('.file-input-show').find('.img-sequence').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
            if ($(e).val() != '') {
                trashBtn = $(e).closest('.file-input-show').find('.trash-button')
                if (trashBtn.is(":visible")) {

                } else {
                    $(e).siblings('.remove-file-btn').show();
                }
            }
        }

        function clearInput(e) {
            $(e).siblings('input[type="file"]').val('');
            $(e).siblings('label').text('Choose image');
            $(e).closest('.file-input-show').find('img').attr('src', $(e).closest('.file-input-show').find('img').data('img'));
            $(e).hide();
        }

        //DOM
        $(document).ready(function() {
            $('.delete-item').each(function() {
                if ($(this).data('id') == '') {
                    $(this).closest('.trash-button').hide();
                    $(this).siblings('.custom-file').find('label').text('Choose image');
                } else {
                    $(this).closest('.trash-button').show();
                }
            });
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
        //tinymce for without images only
        tinymce.init({
            selector: 'textarea#product_description', // Replace this CSS selector to match the placeholder element for TinyMCE
            branding: false,
            plugins: 'lists table ',
            statusbar: false,
            toolbar: 'undo redo | blocks | bold italic alignleft aligncenter alignright | indent outdent bullist numlist | table',
        });
    </script>
    @yield('js')
</body>

</html>
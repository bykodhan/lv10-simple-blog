<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@stack('title') - {{ __('Yönetim Panelim') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('back/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @stack('css')
</head>

<body class="sb-nav-fixed bg-light">
    <!-- Top Navbar -->
    @include('back.layouts.header')
    <!-- Top Navbar -->

    <div id="layoutSidenav">
        <!-- Left Sidebar -->
        @include('back.layouts.left_sidebar')
        <!-- Left Sidebar -->

        <div id="layoutSidenav_content">
            <main>
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="container pt-3">
                        <div class="row">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger d-flex align-items-center mb-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <div>
                                        {{ $error }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Error Messages -->

                <!-- Page Content -->
                @yield('content')
                <!-- Page Content -->
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('back/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @stack('js')
</body>

</html>

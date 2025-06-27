<!DOCTYPE html>

<html
lang="en"
class="light-style layout-menu-fixed layout-compact"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assets/"
data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>{{ config('app.name', 'SISNA') }}</title>

        <meta name="description" content="" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        {{-- <link rel="icon" type="image/x-icon" href="{{ asset('public\images\favicon\logo1.ico') }}" /> --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/logo.png') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome/css/all.min.css') }}" /> --}}

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" />
        
        <!-- Page CSS -->
        
        
        <!-- Helpers -->
        <script src="{{ asset('vendor/js/helpers.js') }}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('js/config.js') }}"></script>
        
        {{-- Toaster CDN --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/> --}}
        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}" />

        {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
        @livewireStyles
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                
                @include('layouts.components.menu')
                <div class="layout-page">
                
                    
                    <div class="main-img" style="background-image: url('{{ asset('images/bg/home.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                    @include('layouts.components.nav')
                    
                    <div class="content-wrapper">

                        @yield('content')

                        
                        <div class="content-backdrop fade"></div>
                    </div>
                    
                </div>
                @include('layouts.components.footer')
                </div>
            </div>
            
            
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div></div>

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('js/dashboards-analytics.js') }}"></script>
        <script src="{{ asset('js/form-basic-inputs.js') }}"></script>
        
        {{-- Toaster CDN --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

        @stack('scripts')

        @livewireScripts
    </body>
</html>

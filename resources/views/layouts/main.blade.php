<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="/dist/css/demo.min.css" rel="stylesheet" />
    <link href="/dist/css/tabler-icons.min.css" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <script src="/dist/js/demo-theme.min.js"></script>
    <div class="page">
        <!-- Navbar -->
        @include('partials.header')
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                {{ $title }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container">
                    @yield('container')
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>

    <!-- Libs JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/dist/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
    <script src="/dist/libs/jsvectormap/dist/maps/world.js"></script>
    <script src="/dist/libs/jsvectormap/dist/maps/world-merc.js"></script>
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js"></script>
    <script src="/dist/js/demo.min.js"></script>
    @stack('script')
</body>

</html>

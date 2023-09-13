<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <title>{{ config('app.name') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


        <link href="{{ mix('css/adminlte.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js" defer="defer"></script>
        @include('includes.styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" style="overflow-x: hidden;">
        <main>
            <div class="wrapper">
                @include('includes.sidebar')
                <div class="wrapper">
                    @include('includes.navbar')
                    @yield('content')
                    @include('includes.footer')
                </div>
            </div>
        </main>

        <script src="{{ mix('js/adminlte.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        @stack('scripts')
        @yield('script')
        @include('includes.script')
    </body>
</html>
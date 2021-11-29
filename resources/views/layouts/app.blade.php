<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

  
    <!--Custom Scripts and Css-->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('/sbadmin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

</head>

<body class="sb-nav-fixed">
    
        @include('layouts.headerNav')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('layouts.nav')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('layouts.footer')
            </div>
        </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/sbadmin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('/sbadmin/js/datatables-simple-demo.js') }}"></script>
    @yield('scripts')
</body>

</html>
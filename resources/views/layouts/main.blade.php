<!DOCTYPE>
<html>

    <head>
        <title>JobMeter</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="/css/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css?v=1.1" />
    </head>

    <body class="bg" style="min-height: 100vh">

    @include('navbar')

    <div class="container blue customSelectContainer">
        <div style="overflow-x:auto;">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid container bg-dark">
        <footer class="bg-dark text-center text-lg-start text-white container">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-6 col-md-12 ">
                        <h5 class="text-uppercase">Footer text</h5>

                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                            molestias.
                        </p>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); margin-left: -24px; margin-right: -24px;">
                © 2022 Copyright: <a style="color: #86f4ff">Traditional Hungarian Devteam</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>

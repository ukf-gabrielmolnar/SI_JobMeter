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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container mb-4 fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand navbarpadding title" href="/">JobMeter</a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Student
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/praxReg">PraxReg</a></li>
                                <li><a class="dropdown-item" href="/jobAdd">JobAdd</a></li>
                                <li><a class="dropdown-item" href="/feedback">Feedback</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Manager
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('manager.show_users')}}">Evidovane studenti</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_companies')}}">Evidovane pracoviska</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_contracts')}}">Evidovane pracovne ponuky</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                PPPFpvAi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/unapprovedContracts">View contracts</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                CEO
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Nyisti</a></li>

                            </ul>
                        </li>

                    @endauth

                    <?php if (auth()->user()?->inRole('admin')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/rbac">RBAC</a></li>
                            <li><a class="dropdown-item" href="/adminView">Show Users</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('student')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/praxReg">Prax</a>
                    </li>
                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('manager')): ?>

                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('ppp')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Praxy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Requesty</a>
                    </li>
                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('ceo')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/rbac/users">RBAC</a>
                    </li>
                    <?php endif; ?>

                </ul>

                <ul class="navbar-nav">
                    <?php if (auth()->user()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= auth()->user()->firstname. ' '. auth()->user()->lastname?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/userInfo">Profile</a></li>
                            <li><a class="dropdown-item" href="/userSettings">Settings</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    </div>


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
                © 2022 Copyright: <a style="color: #000000">Traditional Hungarian Devteam</a>
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

<!DOCTYPE>
<html>

    <head>
        <title>JobMeter</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="/css/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/style.css?v=1.1" />
    </head>

    <body class="bg" style="min-height: 100vh">

    @include('navbar')
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Student
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/praxReg">PraxReg</a></li>
                                <li><a class="dropdown-item" href="/jobAdd">JobAdd</a></li>
                                <li><a class="dropdown-item" href="/jobList">JobList</a></li>
                                <li><a class="dropdown-item" href="/feedback">Feedback</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Manager
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('manager.show_users')}}">Evidované študenti</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_companies')}}">Evidované pracoviská</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_contracts')}}">Evidované pracovné ponuky</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.add_supervisor')}}">Priradiť povereného pracovníka pracoviska</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_certificates')}}">Prehliadať certifikáty</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                PPPFpvAi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/unapprovedContracts">View contracts</a></li>
                                <li><a class="dropdown-item" href="/feedbackContracts">Write feedback</a></li>
                                <li><a class="dropdown-item" href="/archiveContracts">Archive contracts</a></li>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Graphs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('graf.graf_1')}}">Graph_1</a></li>
                                <li><a class="dropdown-item" href="{{route('graf.graf_2')}}">Graph_2</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/rbac">RBAC</a></li>
                                <li><a class="dropdown-item" href="/adminView">Show Users</a></li>
                            </ul>
                        </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/roleRequest" role="button">
                            Role request
                        </a>
                    </li>

                    @if (auth()->user()->inRole('admin'))
                    @endif

                    @if (auth()->user()->inRole('student'))
                    @endif

                    @if (auth()->user()->inRole('manager'))
                    @endif

                    @if (auth()->user()->inRole('ppp'))
                    @endif

                    @if (auth()->user()->inRole('ceo'))
                    @endif

                    @if (auth()->user()->inRole('dev'))
                    @endif
                    @endauth

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

    <div class="container blue customSelectContainer" style="padding-bottom: 80px">
        <div style="overflow-x:auto;">
            @yield('content')
        </div>
    </div>

@include('footer')

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>

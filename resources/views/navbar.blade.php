<nav class="navbar roundcorner navbar-expand-lg navbar-dark bg-dark container mb-4 static-top">
    <div class="container-fluid" style="padding-top: 20px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand navbarpadding title" href="/">JobMeter</a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @auth

                    @if (auth()->user()->inRole('dev'))

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
                                <li><a class="dropdown-item" href="/rbac/users">Používatelia</a></li>
                                <li><a class="dropdown-item" href="/rbac/roles">Role</a></li>
                                <li><a class="dropdown-item" href="/adminView">Show Users</a></li>
                            </ul>
                        </li>

                    @endif


                    @if (auth()->user()->inRole('admin'))

                        <li class="nav-item"><a class="nav-link" href="/rbac/users">Používatelia</a></li>
                        <li class="nav-item"><a class="nav-link" href="/rbac/roles">Roly</a></li>
                        <li class="nav-item"><a class="nav-link" href="/adminView">Show Users</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Grafy
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('graf.graf_1')}}">Graph_1</a></li>
                                <li><a class="dropdown-item" href="{{route('graf.graf_2')}}">Graph_2</a></li>
                            </ul>
                        </li>

                    @endif

                    @if (auth()->user()->inRole('manager'))

                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_users')}}">Evidovane studenti</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_companies')}}">Evidovane pracoviska</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_contracts')}}">Evidovane pracovne ponuky</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Grafy
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('graf.graf_1')}}">Graph_1</a></li>
                                <li><a class="dropdown-item" href="{{route('graf.graf_2')}}">Graph_2</a></li>
                            </ul>
                        </li>

                    @endif

                    @if (auth()->user()->inRole('ppp'))

                        <li class="nav-item"><a class="nav-link" href="/unapprovedContracts">View contracts</a></li>
                        <li class="nav-item"><a class="nav-link" href="/feedbackContracts">Write feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="/archiveContracts">Archive contracts</a></li>

                    @endif

                    @if (auth()->user()->inRole('student'))
                        <li class="nav-item"><a class="nav-link" href="/praxReg">Registrácia na prax</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jobAdd">Pridať pracoviska</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jobList">Pracovné ponuky</a></li>
                    @endif

                    @if (auth()->user()->inRole('ceo'))

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

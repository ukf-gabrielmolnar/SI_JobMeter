<nav class="navbar navbar-expand-lg navbar-dark bg-dark container mb-4 fixed-top">
    <div class="container-fluid">
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
                                Študent
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/praxReg">Registrácia na prax</a></li>
                                <li><a class="dropdown-item" href="/jobAdd">Pridať prácu</a></li>
                                <li><a class="dropdown-item" href="/jobList">Zoznam prác</a></li>
                                <li><a class="dropdown-item" href="/feedback">Spätná väzba</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Manažér
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('manager.show_users')}}">Evidované študenti</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_companies')}}">Evidované pracoviská</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_contracts')}}">Evidované pracovné ponuky</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.add_supervisor')}}">Priradiť pracovníka</a></li>
                                <li><a class="dropdown-item" href="{{route('manager.show_certificates')}}">Prehliadať certifikáty</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                PPPFpvAi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/unapprovedContracts">Zobraziť zmluvy</a></li>
                                <li><a class="dropdown-item" href="/feedbackContracts">Napísať spätnú väzbu</a></li>
                                <li><a class="dropdown-item" href="/archiveContracts">Archivované zmluvy</a></li>

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
                                Grafy
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
                                <li><a class="dropdown-item" href="/adminView">Zobraziť používateľov</a></li>
                                <li><a class="dropdown-item" href="/adminViewCompanies">Zobraziť firiem a organizácií</a></li>
                                <li><a class="dropdown-item" href="/jobIndex">Zobraziť pracovné ponuky</a></li>
                                <li><a class="dropdown-item" href="/contactView">Zobraziť kontaktné osoby firmov</a></li>
                                <li><a class="dropdown-item" href="/roleRequest">Nové Registrácie</a></li>
                            </ul>
                        </li>

                    @endif


                    @if (auth()->user()->inRole('admin'))

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Zobrazenie
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/adminView">Zobraziť používateľov</a></li>
                                <li><a class="dropdown-item" href="/adminViewCompanies">Zobraziť firiem a organizácií</a></li>
                                <li><a class="dropdown-item" href="/jobIndex">Zobraziť pracovné ponuky</a></li>
                                <li><a class="dropdown-item" href="/contactView">Zobraziť kontaktné osoby firmov</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Grafy
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('graf.graf_1')}}">Graf 1</a></li>
                                <li><a class="dropdown-item" href="{{route('graf.graf_2')}}">Graf 2</a></li>
                            </ul>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="/roleRequest">Nové Registrácie</a></li>

                    @endif

                    @if (auth()->user()->inRole('manager'))

                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_users')}}">Evidované študenti</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_companies')}}">Evidované pracoviská</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_contracts')}}">Evidované pracovné ponuky</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.add_supervisor')}}">Priradiť pracovníka</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('manager.show_certificates')}}">Prehliadať certifikáty</a></li>

                    @endif

                    @if (auth()->user()->inRole('ppp'))

                        <li class="nav-item"><a class="nav-link" href="/unapprovedContracts">Zobraziť zmluvy</a></li>
                        <li class="nav-item"><a class="nav-link" href="/feedbackContracts">Napísať spätnú väzbu</a></li>
                        <li class="nav-item"><a class="nav-link" href="/archiveContracts">Archivované zmluvy</a></li>

                    @endif

                    @if (auth()->user()->inRole('student'))
                        <li class="nav-item"><a class="nav-link" href="/praxReg">Registrácia na prax</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jobAdd">Pridať pracoviska</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jobList">Pracovné ponuky</a></li>
                        <li class="nav-item"><a class="nav-link" href="/feedback">Spätná väzba</a></li>

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
                        <li><a class="dropdown-item" href="/userInfo">Konto</a></li>
                        <li><a class="dropdown-item" href="/userSettings">Nastavenie</a></li>
                        <li><a class="dropdown-item" href="/logout">Odhlásiť sa</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Prihlásiť sa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Registrácia</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

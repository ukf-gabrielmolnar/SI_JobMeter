<!DOCTYPE>
<html>
    <head>
        <title>JobMeter</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css" />
    </head>
    <body class="bg" style="min-height: 100vh">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container mb-4">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand navbarpadding_left" href="/">JobMeter</a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/praxReg">Prax</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    @endauth

                    <?php if (auth()->user()?->inRole('student')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/praxReg">Prax</a>
                        <div class="dropdown">
                            <button class="dropbtn">Prax
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="#">Link 1</a>
                                <a href="#">Link 2</a>
                                <a href="#">Link 3</a>
                            </div>
                        </div>
                        <a class="nav-link" href="/rbac/users">Prax</a>
                    </li>
                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/rbac/users">RBAC</a>
                    </li>
                    <?php endif; ?>

                </ul>

                <ul class="navbar-nav ">
                    <?php if (auth()->user()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout (<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>)</a>
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

    <div class="container blue">
        @yield('content')
    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $selectedCompanyId = 0;

        $(function() {
            $.get('/companies', function(data) {
                var companies = $('#companies');
                $.each(data, function(index, company) {
                    companies.append('<option value="' + company.id + '">' + company.name + '</option>');
                });
            });

            $('#companies').on('change', function() {
                console.log($('#companyform').serialize())
                $selectedCompanyId = $(this).children(":selected").attr("value");
                document.getElementById("proba").innerHTML = $selectedCompanyId;

            });

        });



    </script>
    </body>
</html>

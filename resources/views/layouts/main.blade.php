<!DOCTYPE>
<html>
    <head>
        <title>JobMeter</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="../../../public/favicon.png">

        <style>
            body{
                background: #497e9f;
                min-height: 100vh;
            }
        </style>

    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container mb-4">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Jobmeter</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/praxReg">Prax</a>
                    </li>
                    @endauth
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

    <div class="container">
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

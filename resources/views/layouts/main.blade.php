<!DOCTYPE>
<html>
    <head>
        <title>My App</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    </head>
    <body style="min-height: 100vh">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container mb-4">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Jobmeter</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (auth()->user()?->inRole('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/rbac/users">RBAC</a>
                    </li>
                    <?php endif; ?>

                </ul>
                <ul class="navbar-nav ">
                    <?php if (auth()->user()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout (<?= auth()->user()->name?>)</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
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
        $(function() {
            $.get('/members', function(data) {
                var members = $('#members');
                $.each(data, function(index, member) {
                    members.append('<option value="' + member.id + '">' + member.name + '</option>');
                });
            });

            $('#members').on('change', function() {
                console.log($('#memberform').serialize())
            });



        });
    </script>
    </body>
</html>

<!DOCTYPE>
<html>

    <head>
        <title>JobMeter</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="/css/favicon.png">
        <link rel="stylesheet" href="/css/style.css?v=1.1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body class="bg" style="min-height: 100vh">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand navbarpadding title" href="/">JobMeter</a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/praxReg">Prax</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/adminView">Table</a>
                    </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="{{route('manager.show_users')}}" >Evidované študenti</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="{{route('manager.show_companies')}}" >Evidované pracoviská</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="{{route('manager.show_contracts')}}" >Evidované pracovné ponuky</a>
                        </li>

                    @endauth

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

                    <?php if (auth()->user()?->inRole('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/rbac/users">RBAC</a>
                    </li>
                    <?php endif; ?>

                    <?php if (auth()->user()?->inRole('ceo')): ?>
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
    </div>


    <div class="container blue customSelectContainer" style="transition: height 2s;">
        <div >
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
    <script>
        var fades = [true,true,true];
        var selectedCompanyId = 1;
        var selectedJobId = 1;
        var selectedContractId = 1;

        document.getElementById('jobform').style.display = 'none';
        document.getElementById('contactform').style.display = 'none';
        document.getElementById('timePickerForm').style.display = 'none';
        document.getElementById('submitButtonPrax').style.display = 'none';

        $.get('/companies', function(data) {
            var companies = $('#companies');
            $.each(data, function(index, company) {
                companies.append('<option value="' + company.id + '">' + company.name + '</option>');
            });
        });

        $('#companies').on('change', function() {
            var jobForm = $('#jobform');
            if (fades[0]){

                fades[0] = false;
            }
            jobForm.fadeToggle(1000);

            $("#jobs_id").empty();
            $selectedCompanyId = $(this).children(":selected").attr("value");


            $.get('/jobs', function(data) {
                var jobs = $('#jobs_id');
                jobs.append('<option value="" selected disabled hidden>Choose here</option>');
                $.each(data, function(index, job) {
                    if (job.companies_id == $selectedCompanyId){
                        jobs.append('<option value="' + job.id + '">' + job.job_type + '</option>');
                    }
                });
            });
        });

        $('#jobs_id').on('change', function() {
            var contactForm = $('#contactform');
            if (fades[2]){
                contactForm.fadeToggle(1000);
                fades[2] = false;
            }
            $("#contacts_id").empty();
            selectedJobId = $(this).children(":selected").attr("value");

            $.get('/contacts', function(data) {
                var contacts = $('#contacts_id');
                contacts.append('<option value="" selected disabled hidden>Choose here</option>');
                $.each(data, function(index, contact) {
                    if (contact.companies_id == $selectedCompanyId){
                    contacts.append('<option value="' + contact.id + '">' + contact.firstname +'</option>');
                    }
                });
            });
        });

        $('#contacts_id').on('change', function (){
            var timePickerForm = $('#timePickerForm');
            var submitButtonPrax = $('#submitButtonPrax');

            if (fades[3]){
                timePickerForm.fadeToggle(1000);
                submitButtonPrax.fadeToggle(2500);
                fades[3] = false;
            }

        });

    </script>
    </body>
</html>

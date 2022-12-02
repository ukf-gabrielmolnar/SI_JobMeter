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
<div style="margin-top: -20px">
@include('navbar')
</div>


@yield('content')

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

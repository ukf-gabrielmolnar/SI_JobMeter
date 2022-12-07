@extends('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))


        <h1>
            Tento graf percentovo zobrazuje ročníky študenta
        </h1>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php echo $chartData?>
            ]);

            var options = {
                title: 'Years'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">Nie ste prihlásený!</h1>

@endif

@endsection

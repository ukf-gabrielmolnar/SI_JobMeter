@extends ('layouts.main')
@section('content')

    @if (auth()->user())

    <div class="row">
        <div class="column">
            <img class="profile-picture" src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        </div>
    <div class="card text-center profile-card column" style="width: 20rem;">

        <div class="card-body">
            <ul class="list-group list-group-flush">

                @if (auth()->user()->inRole('admin'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Admin</p>
                    </li>
                @elseif (auth()->user()->inRole('manager'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Manažér</p>
                    </li>
                @elseif (auth()->user()->inRole('ppp'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Poverený pracovník pracoviska FPVaI</p>
                    </li>
                @elseif (auth()->user()->inRole('student'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Študent</p>
                    </li>
                @elseif (auth()->user()->inRole('ceo'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Ceo</p>
                    </li>
                @elseif (auth()->user()->inRole('dev'))
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Vývojár</p>
                    </li>
                @else
                    <li class="list-group-item">
                        <p><h6>Rola: </h6>Ešte nepriradená</p>
                    </li>
                @endif

                <li class="list-group-item">
                    <p><h6>Meno: </h6> <?= auth()->user()->firstname ?></p>
                </li>
                <li class="list-group-item">
                    <p><h6>Priezvisko: </h6> <?= auth()->user()->lastname ?></p>
                </li>
                <li class="list-group-item">
                    <p><h6>E-mail: </h6> <?= auth()->user()->email ?></p>
                </li>
                @if (auth()->user()->inRole('student'))
                    <li class="list-group-item">
                        <input hidden name="year_id_hidden" id = "year_id_hidden" value="<?= auth()->user()->years_id?>">
                        <p id="years_id_print" name="years_id_print"></p>
                    </li>
                @elseif (auth()->user()->inRole('ceo'))
                    @foreach($company as $c)
                        @if ($c->id == auth()->user()->companies_id)
                            <li class="list-group-item">
                                <p><h6>Organizácia</h6>{{$c->name}}</p>
                            </li>
                        @endif
                    @endforeach
                @elseif (auth()->user()->inRole('dev'))
                    <li class="list-group-item">
                        <input hidden name="year_id_hidden" id = "year_id_hidden" value="<?= auth()->user()->years_id?>">
                        <p id="years_id_print" name="years_id_print"></p>
                    </li>
                    @if ((auth()->user()->companies_id === Null))
                        <li class="list-group-item">
                            <p><h6>Organizácia</h6>Zatiaľ nepridaná</p>
                        </li>
                    @else
                        @foreach($company as $c)
                            @if ($c->id == auth()->user()->companies_id)
                                <li class="list-group-item">
                                    <p><h6>Organizácia</h6>{{$c->name}}</p>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
    </div>
    </div>

    <script>
        window.onload = function (){
            var SP_print = document.getElementById("years_id_print");
            var dataSP = @json($study_programs);
            var dataY = @json($year);
            var year_id = document.getElementById("year_id_hidden").value;

            if (year_id !== ""){
                var year_SP;
                $.each(dataY, function (index, data){
                    console.log(data.id);
                    if(data.id == year_id){
                        year_SP = data;
                        return false;
                    }
                });

                var SP;
                $.each(dataSP, function (index, data){
                    if(data.id == year_SP.study_programs_id){
                        SP = data;
                        return false;
                    }
                });

                var text = year_SP.year + " " + SP.study_program;
                SP_print.innerHTML =  '<p><h6>Študijný program</h6>' + text + '</p>';
            }
            else {
                SP_print.innerHTML =  '<p><h6>Študijný program</h6> Zatiaľ nepridaný </p>';
            }
        }
    </script>

    @else

        <div class="alert alert-warning" role="alert">
            Nie ste prihlásený!
        </div>

    @endif

@endsection

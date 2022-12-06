@extends ('layouts.main')
@section('content')

    @if (auth()->user())

    <div class="row">
        <div class="column">
            <img class="profile-picture" src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        </div>
    <div class="card text-center column profile-card" style="width: 20rem;">
        <div class="card-body">
            @if (auth()->user()->inRole('student') || auth()->user()->inRole('dev'))
            <input hidden name="years_id_hidden" id = "years_id_hidden" value="<?=auth()->user()->years_id?>">
            @endif
            @if (auth()->user()->inRole('ceo') || auth()->user()->inRole('dev'))
            <input hidden name="companies_id_hidden" id = "companies_id_hidden" value="<?=auth()->user()->companies_id?>">
            @endif
            <form method="post" action="{{ route('user.update') }}">
                @csrf
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6>Meno: </h6>
                        <input type="text" value="<?= auth()->user()->firstname ?>" id="firstname" name="firstname">
                    </li>
                    <li class="list-group-item">
                        <h6>Priezvisko: </h6>
                        <input type="text" value="<?= auth()->user()->lastname ?>" id="lastname" name="lastname">
                    </li>
                    <li class="list-group-item">
                        <h6>E-mail: </h6>
                        <input type="email" value="<?= auth()->user()->email ?>" id="email" name="email">
                    </li>

                    @if (auth()->user()->inRole('student') || auth()->user()->inRole('dev'))
                        <li class="list-group-item">
                            <label for="years_id" class="form-label"><h6>Študijný program</h6></label>
                            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="years_id" name="years_id">
                            </select>
                        </li>
                    @endif
                    @if (auth()->user()->inRole('ceo') || auth()->user()->inRole('dev'))
                        <li class="list-group-item">
                            <label for="companies_id" class="form-label"><h6>Organizácia</h6></label>
                            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies_id" name="companies_id">
                            </select>
                        </li>
                    @endif

                </ul>
                <button id="submitButtonPrax" class="btn text-white" type="submit">Uložiť</button>
            </form>
        </div>
    </div>
  </div>

    <script>
        window.onload = function (){

            var select = $('#years_id');
            var dataY = @json($year);
            var dataSP = @json($study_programs);

            var selectC = $('#companies_id');
            var dataC = @json($company);

            $.each(dataC, function (index, company){
               selectC.append('<option value="' + company.id + '">' + company.name + '</option>');
            });

            $.each(dataY, function (index, year){
                var SP_id = year.study_programs_id;
                var Sp;
                $.each(dataSP, function (index, sp){
                    if (sp.id === SP_id){
                        Sp = sp;
                        return false;
                    }
                });

                select.append('<option value="' + year.id + '">' + year.year + ' ' + Sp.study_program + '</option>');
            });


            document.getElementById("years_id").value = document.getElementById("years_id_hidden").value;

            document.getElementById("companies_id").value = document.getElementById("companies_id_hidden").value;
        }
    </script>

    @else

        <h1 style="text-align: center;">Nie ste prihlásený!</h1>

    @endif

@endsection

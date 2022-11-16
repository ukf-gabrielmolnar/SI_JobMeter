@extends ('layouts.main')
@section('content')

    <div class="card text-center" style="width: 20rem;">
        <img src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        <div class="card-body">
            <input hidden name="years_id_hidden" id = "years_id_hidden" value="<?=auth()->user()->years_id?>">
            <form method="post" action="{{ route('user.update') }}">
                @csrf
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6>Firstname: </h6>
                        <input type="text" value="<?= auth()->user()->firstname ?>" id="firstname" name="firstname">
                    </li>
                    <li class="list-group-item">
                        <h6>Lastname: </h6>
                        <input type="text" value="<?= auth()->user()->lastname ?>" id="lastname" name="lastname">
                    </li>
                    <li class="list-group-item">
                        <h6>E-mail: </h6>
                        <input type="email" value="<?= auth()->user()->email ?>" id="email" name="email">
                    </li>
                    <li class="list-group-item">
                        <label for="years_id" class="form-label"><h6>Study plan</h6></label>
                        <select class="form-select form-select-lg mb-3 text-dark custom-select" id="years_id" name="years_id">

                        </select>
                    </li>
                </ul>
                <button id="submitButtonPrax" class="btn bg-secondary text-bg-danger" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        window.onload = function (){

            var select = $('#years_id');
            var dataY = @json($year);
            var dataSP = @json($study_programs);

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
        }
    </script>



@endsection

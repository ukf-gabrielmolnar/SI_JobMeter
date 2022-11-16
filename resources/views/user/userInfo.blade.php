@extends ('layouts.main')
@section('content')

    <div class="card text-center" style="width: 20rem;">
        <img src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <p><h6>Firstname: </h6> <?= auth()->user()->firstname ?></p>
                </li>
                <li class="list-group-item">
                    <p><h6>Lastname: </h6> <?= auth()->user()->lastname ?></p>
                </li>
                <li class="list-group-item">
                    <p><h6>E-mail: </h6> <?= auth()->user()->email ?></p>
                </li>
                <li class="list-group-item">
                    <input hidden name="year_id_hidden" id = "year_id_hidden" value="<?= auth()->user()->years_id?>">
                    <p id="years_id_print" name="years_id_print"></p>
                </li>
            </ul>
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
                SP_print.innerHTML =  '<p><h6>Study plan</h6>' + text + '</p>';
            }
            else {
                SP_print.innerHTML =  '<p><h6>Study plan</h6> Not added yet </p>';
            }
        }
    </script>

@endsection

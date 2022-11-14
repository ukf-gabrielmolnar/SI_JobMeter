@extends ('layouts.main')
@section('content')

    <div class="card text-center" style="width: 20rem;">
        <img src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        <div class="card-body">
            <form>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6>Firstname: </h6>
                        <input type="text" value="<?= auth()->user()->firstname ?>">
                    </li>
                    <li class="list-group-item">
                        <p><h6>Lastname: </h6> <?= auth()->user()->lastname ?></p>
                    </li>
                    <li class="list-group-item">
                        <p><h6>E-mail: </h6> <?= auth()->user()->email ?></p>
                    </li>
                    <li class="list-group-item">
                        <input hidden name="study_id_hidden" id = "study_id_hidden" value="<?=auth()->user()->study_programs_id?>">
                        <p id="study_id" name="study_id"></p>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <script>
        window.onload = function (){

            var studyP = document.getElementById("study_id");
            var studyPdata = @json($study_programs);
            var studentST_id = document.getElementById("study_id_hidden").value;

            for (var i = 0; i < studyPdata.length; i++){
                if (studentST_id == studyPdata[i].id){
                    var STname =  studyPdata[i].year + " " + studyPdata[i].study_program;
                    studyP.innerHTML = '<p><h6>Study program: </h6>'+ STname +'</p>';
                }
            }

        }
    </script>

@endsection

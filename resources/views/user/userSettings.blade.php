@extends ('layouts.main')
@section('content')

    <div class="row">
        <div class="column">
            <img class="profile-picture" src="/css/user.png" class="card-img-top" alt="<?= auth()->user()->firstname. ' '. auth()->user()->lastname?>">
        </div>
    <div class="card text-center column profile-card" style="width: 20rem;">
        <div class="card-body">
            <input hidden name="study_id_hidden" id = "study_id_hidden" value="<?=auth()->user()->study_programs_id?>">
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
                        <label for="study_programs_id" class="form-label"><h6>Study plan</h6></label>
                        <select class="form-select form-select-lg mb-3 text-dark custom-select" id="study_programs_id" name="study_programs_id">
                            @foreach($study_programs as $st)
                                <option value={{$st->id}}>
                                    {{$st->study_program}}{{"  "}}{{$st->year}}
                                </option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                <button id="submitButtonPrax" class="btn bg-secondary text-bg-danger" type="submit">Submit</button>
            </form>
        </div>
    </div>
  </div>

    <script>
        window.onload = function (){

            document.getElementById("study_programs_id").value = document.getElementById("study_id_hidden").value;
        }
    </script>



@endsection

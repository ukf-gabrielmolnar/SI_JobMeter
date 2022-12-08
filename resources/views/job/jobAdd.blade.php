@extends ('layouts.main')
@section('content')

@if (auth()->user())

    @if (!(auth()->user()->inRole('ceo')))

    <div>
            <form action="{{ route('job.saveData') }}" method="post">
               @csrf

                <div class="row3">
                   <div class="column3">
                   <h3 align="center">Firma</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="company_name"><h6> Názov firmy </h6></label>
                       <input type="text" id="company_name" name="company_name" required>
                       <p></p>
                       <label for="company_address"><h6> Adresa </h6></label>
                       <input type="text" id="company_address" name="company_address" required>
                   </li>
                   </div>

                   <div class="column3">
                   <h3 align="center">Kontakt</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="firstname"><h6> Meno </h6></label>
                       <input type="text" id="firstname" name="firstname" required>
                       <p></p>
                       <label for="lastname"><h6> Priezvisko </h6></label>
                       <input type="text" id="lastname" name="lastname" required>
                       <p></p>
                       <label for="phone"><h6> Telefónne číslo </h6></label>
                       <input type="tel" id="phone" name="phone" required>
                       <p></p>
                       <label for="email"><h6> E-mail </h6></label>
                       <input type="email" id="email" name="email" required>
                   </li>
                   </div>

                   <div class="column3">
                   <h3 align="center">Práca</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="company_name"><h6> Meno </h6></label>
                       <input type="text" id="job_type" name="job_type" required>
                       <p></p>
                       <label for="study_programs_id"><h6> Študijný program </h6></label>
                       <select class="form-select form-select-lg mb-3 text-dark custom-select" id = "study_programs_id" name="study_programs_id" required>
                           @foreach($study_programs as $sp)
                               <option value={{$sp->id}}>
                                   {{ $sp->study_program }}
                               </option>
                           @endforeach
                       </select>
                   </li>
                   </div>
        </div>

               <button id="buttonform" class="add-new-job-save" type="submit"> Uložiť </button>
           </form>

    </div>

    <script>
        window.onload = function (){
            var id = @json($SP_id);
            id = id[0].id;
            document.getElementById("study_programs_id").value = id;

        }
    </script>

    @else

        @include('nopermission')

    @endif

@else

    <div class="alert alert-warning" role="alert">
        Nie ste prihlásený!
    </div>

@endif

@endsection

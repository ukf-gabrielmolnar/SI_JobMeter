@extends ('layouts.main')
@section('content')

    <div class="card text-center" style="width: 15rem;">
        <div class="card-body">
            <form action="{{ route('job.saveData') }}" method="post">
               @csrf
               <ul class="list-group list-group-flush">
                   <h3>Company</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="company_name"><h6> Name </h6></label>
                       <input type="text" id="company_name" name="company_name" required>
                       <p></p>
                       <label for="company_address"><h6> Address </h6></label>
                       <input type="text" id="company_address" name="company_address" required>-->
                   </li>

                   <div id="contactform">
                   <h3>Contact</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="firstname"><h6> Firstname </h6></label>
                       <input type="text" id="firstname" name="firstname" required>
                       <p></p>
                       <label for="lastname"><h6> Lastname </h6></label>
                       <input type="text" id="lastname" name="lastname" required>
                       <p></p>
                       <label for="phone"><h6> Phone </h6></label>
                       <input type="tel" id="phone" name="phone" required>
                       <p></p>
                       <label for="email"><h6> E-mail </h6></label>
                       <input type="email" id="email" name="email" required>
                   </li>
                   </div>

                   <div id="jobform">
                   <h3>Job</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="company_name"><h6> Name </h6></label>
                       <input type="text" id="job_type" name="job_type" required>
                       <p></p>
                       <label for="study_programs_id"><h6> Study plan </h6></label>
                       <select class="form-select form-select-lg mb-3 text-dark custom-select" id = "study_programs_id" name="study_programs_id" required>
                           @foreach($study_programs as $sp)
                               <option value={{$sp->id}}>
                                   {{ $sp->study_program }}
                               </option>
                           @endforeach
                       </select>
                   </li>
                   </div>
               </ul>
               <button id="buttonform" type="submit"> Save </button>
           </form>

        </div>
    </div>

    <script>
        window.onload = function (){
            var id = @json($SP_id);
            id = id[0].id;
            document.getElementById("study_programs_id").value = id;

        }
    </script>



@endsection

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
                       <label for="comapny_name"><h6> Name </h6></label>
                       <input type="text" value=" " id="comapny_name" name="comapny_name">
                       <p></p>
                       <label for="comapny_address"><h6> Address </h6></label>
                       <input type="text" value=" " id="comapny_address" name="comapny_address">
                   </li>

                   <h3>Contacts</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="firstname"><h6> Firstname </h6></label>
                       <input type="text" value=" " id="firstname" name="firstname">
                       <p></p>
                       <label for="lastname"><h6> Lastname </h6></label>
                       <input type="text" value=" " id="lastname" name="lastname">
                       <p></p>
                       <label for="phone"><h6> Phone </h6></label>
                       <input type="tel" value=" " id="phone" name="phone">
                       <p></p>
                       <label for="email"><h6> E-mail </h6></label>
                       <input type="email" value=" " id="email" name="email">
                   </li>

                   <h3>Job</h3>
                   <li class="list-group-item">
                       <p></p>
                       <label for="comapny_name"><h6> Name </h6></label>
                       <input type="text" value=" " id="comapny_name" name="comapny_name">
                       <p></p>
                       <label for="comapny_address"><h6> Address </h6></label>
                       <input type="text" value=" " id="comapny_address" name="comapny_address">
                   </li>
               </ul>
               <button type="submit"> Save </button>
           </form>

        </div>
    </div>

    <script>
        window.onload = function (){

            //document.getElementById("study_programs_id").value = document.getElementById("study_id_hidden").value;
        }
    </script>



@endsection

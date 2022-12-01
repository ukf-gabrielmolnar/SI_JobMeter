@extends ('layouts.main')
@section('content')

    <div class="feedback_design" style="width: 15rem;">
        <div class="card-body">
            <form method="post" action="{{ route('feedback.store') }}" >
                @csrf
                <input hidden id="users_id" name="users_id" value="{{auth()->user()->id}}">

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <label for="contracts_id"><h6> Prax </h6></label>
                        <select class="form-select form-select-lg mb-3 text-dark custom-select" id = "contracts_id" name="contracts_id" required>

                        </select>
                    </li>

                    <li class="list-group-item">
                        <p></p>
                        <label for="subject"><h6> Subject </h6></label>
                        <input type="text" id="subject" name="subject" required>


                    <li class="list-group-item">
                        <p></p>
                        <label for="text"><h6> Text </h6></label>
                        <!--rows="10" cols="50"  ha akartok fix sizet neki adni-->
                        <textarea type="text" id="text" name="text"  style="resize: none" required></textarea>
                    </li>


                </ul>
                <button id="buttonform" type="submit"> Send </button>
            </form>

        </div>
    </div>

    <script>
        window.onload = function (){

            var dataContracts = @json($contracts);
            var dataJobs = @json($jobs);

            $.each(dataContracts, function (index, dataC){
                var job;
                var job_id = dataC.jobs_id;

                $.each(dataJobs, function (index, dataJ) {
                    if (job_id == dataJ.id){
                        job = dataJ;
                        return false;
                    }
                });

                $('#contracts_id').append('<option value="' + dataC.id + '">' + job.job_type + '</option>')
            });

        }
    </script>

@endsection

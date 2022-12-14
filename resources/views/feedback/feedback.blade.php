@extends ('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('student') || auth()->user()->inRole('dev'))

    <div class="feedback_design">
        <div style="width: 100%">
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
                        <label for="subject"><h6> Predmet </h6></label>
                        <input type="text" id="subject" name="subject" required placeholder="Zadajte predmet sem...">


                    <li class="list-group-item">
                        <p></p>
                        <label for="text"><h6> Text </h6></label>
                        <textarea type="text" id="text" name="text"  style="resize: none" required placeholder="Píšte správu sem..."></textarea>
                    </li>


                </ul>
                <button id="buttonform" class="feedback_send_button"  type="submit"> Odoslať </button>
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

    @else

        @include('nopermission')

    @endif

@else

    <div class="alert alert-warning" role="alert">
        Nie ste prihlásený!
    </div>

@endif

@endsection

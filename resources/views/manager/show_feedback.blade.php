@extends('layouts.main')

@section('content')

    @if (auth()->user())

        @if (auth()->user()->inRole('admin') || auth()->user()->inRole('manager') || auth()->user()->inRole('dev'))
            <table class="table table-white table-hover" id="myTable">
                <thead>
                <tr>
                    <th scope="col">Študent</th>
                    <th scope="col">Práca</th>
                    <th scope="col">Spätná väzba</th>
                </tr>
                </thead>
                <tbody>
                @foreach($feedbacks as $feedback)
                    @foreach($contracts as $contract)
                        @if($feedback->contracts_id === $contract->id)
                            @foreach($users as $user)
                                @if($user->id === $contract->users_id)
                                    <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                                @endif
                            @endforeach
                            @foreach($jobs as $job)
                                @if($job->id === $contract->jobs_id)
                                    <td>{{$job->job_type}}</td>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <td>
                        <a class="show-modal btn btn-sm btn-outline-warning" style="border-radius: 1px" onclick="showModal({{$feedback->id}})">Zobraziť</a>
                    </td>
                @endforeach
                </tbody>
            </table>

            <div class="modal" id="myModal" tabindex="-1" aria-hidden="true">

                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                    </div>
                    <h1 id="modal_user" style="margin-left: 20px"></h1>
                    <h2 id="modal_job" style="margin-left: 20px"></h2>
                    <div class="modal-body" style="padding-bottom: 50px" id="modal_body">

                    </div>
                </div>

            </div>
            <script src="/vendor/jquery/jquery.min.js"></script>
            <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
            <script>
                $
                var span = document.getElementsByClassName("close")[0];
                var modal = document.getElementById("myModal");
                function showModal(id){
                    var selectedFeedback = id;
                    var feedbacks = @json($feedbacks);
                    var users = @json($users);
                    var jobs = @json($jobs);
                    var contracts = @json($contracts);
                    $.each(feedbacks, function(feedbackIndex, feedback){
                        if(feedback.id == selectedFeedback) {
                            $.each(contracts, function (contractsIndex, contract) {
                                if (feedback.contracts_id === contract.id) {
                                    $.each(users, function (userIndex, user) {
                                        if (contract.users_id === user.id) {
                                            $("#modal_user").html(user.firstname + " " + user.lastname);
                                        }
                                    })
                                    $.each(jobs, function (jobIndex, job) {
                                        if (contract.jobs_id === job.id) {
                                            $("#modal_job").html(job.job_type);
                                        }
                                    })
                                }
                            })
                            $("#modal_body").html(feedback.text);
                        }
                    })
                    modal.style.display = "block";

                }
                span.onclick = function() {
                    modal.style.display = "none";
                }




            </script>

        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">Nie ste prihlásený!</h1>

    @endif

@endsection


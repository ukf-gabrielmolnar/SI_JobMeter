@extends('layouts.main')

@section('content')

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Student</th>
            <th scope="col">Prace</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Potvrdene</th>
            <th scope="col">Ukoncene</th>
            <th scope="col">Add feedback</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if(auth()->user()->id == $contract->ppp_id)
                <tr>
                    @foreach($users as $user)
                        @if($contract->users_id === $user->id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                            <input hidden value="{{ $user->firstname." ".$user->lastname }}" id="user_name" name="user_name">
                            <input hidden value="{{ $user->id }}" id="user_id" name="user_id">
                        @endif
                    @endforeach
                    @foreach($jobs as $job)
                        @if($contract->jobs_id === $job->id)
                            <td>{{$job->job_type}}</td>
                            <input hidden value="{{ $job->job_type }}" id="job_type" name="job_type">
                        @endif
                    @endforeach
                    <td>{{$contract->od}}</td>
                    <td>{{$contract->do}}</td>
                    <td>
                        @if($contract->approved == null)
                            Nie
                        @else
                            Ano
                        @endif
                    </td>
                    <td>
                        @if($contract->closed == null)
                            Nie
                        @else
                            Ano
                        @endif
                    </td>
                    <td>
                        <input hidden value="{{ $contract->id }}"  id="contract_id" name="contract_id">
                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#feedbackForm" onclick="fillData()">Add feedback</button>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>

        <div class="modal fade" id="feedbackForm" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Feedback</h1>
                        <!-- x kilepes -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="get" action="{{ route('ppp.saveFeedback') }}">
                        <div class="modal-body">

                            <input hidden id="contracts_id" name="contracts_id">
                            <input hidden id="users_id" name="users_id">

                            <h5> Student </h5>
                            <p id="fill_name"> </p>
                            <h5> Job </h5>
                            <p id="fill_job"> </p>

                            <br>
                            <label for="companies" class="form-label">Subject</label>
                            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="subject" name="subject" required>
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="Kommentar"> Kommentar </option>
                                <option value="Hodnotenie"> Hodnotenie </option>
                            </select>

                            <br>
                            <textarea type="text" id="text" name="text"  style="resize: none" required></textarea>

                        </div>
                        <div class="modal-footer">
                            <!-- aljan kilepes -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </table>

    <script>

        function fillData(){

            var user_name = $('#user_name')
            var user_id = $('#user_id')
            var job_type = $('#job_type')
            var contract_id = $('#contract_id')

            $('#fill_name').append(user_name.val())
            $('#fill_job').append(job_type.val())

            $('#users_id').val(user_id.val())
            $('#contracts_id').val(contract_id.val())
        }

    </script>
@endsection

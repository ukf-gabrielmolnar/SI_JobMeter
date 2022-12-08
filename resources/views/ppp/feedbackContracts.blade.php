@extends('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('ppp') || auth()->user()->inRole('dev'))

    @php
        $help = 0;
            foreach ($contracts as $contract) {
                $help++;
            }
    @endphp

    @if ($help == 0)
        <h1 style="text-align: center">Tabuľka je prázdna</h1>
    @else

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successPopup" name="successPopup">
        <p id="popupText"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Študent</th>
            <th scope="col">Práce</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Potvrdené</th>
            <th scope="col">Ukončené</th>
            <th scope="col">Pridať spätnú väzbu</th>
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

                            @foreach($jobs as $job)
                                @if($contract->jobs_id === $job->id)
                                    <td>{{$job->job_type}}</td>
                                    <input hidden value="{{ $job->job_type }}" id="job_type" name="job_type">

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
                                        <input hidden value="{{ $contract->id }}"  id="contracts_id_modal" name="contracts_id_modal">
                                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#feedbackForm{{$contract->id}}" onclick="fillData()">Pridať spätnú väzbu</button>
                                    </td>

                                    <div class="modal fade" id="feedbackForm{{$contract->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Feedback</h1>
                                                    <!-- x kilepes -->
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="get" action="{{ route('ppp.saveFeedback') }}">
                                                    <div class="modal-body">

                                                        <input hidden id="contracts_id" name="contracts_id" value="{{ $contract->id }}">
                                                        <input hidden d="users_id" name="users_id" value="{{ $user->id }}" i>

                                                        <h5> Student </h5>
                                                        <p>{{ $user->firstname." ".$user->lastname }}</p>
                                                        <h5> Job </h5>
                                                        <p>{{ $job->job_type }}</p>

                                                        <br>
                                                        <label for="companies" class="form-label">Predmet</label>
                                                        <select class="form-select form-select-lg mb-3 text-dark custom-select" id="subject" name="subject" required>
                                                            <option value="" selected disabled hidden>Vyber možnosť</option>
                                                            <option value="Kommentar"> Komentár </option>
                                                            <option value="Hodnotenie"> Hodnotenie </option>
                                                        </select>

                                                        <br>
                                                        <textarea type="text" id="text" name="text"  style="resize: none" required></textarea>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

    <script>

        function fillData(){

            $('#text').empty()

        }

        window.onload = function (){
            var json = @json($popupMessage);
            var popupText = $('#popupText');
            var popup = $('#successPopup');
            document.getElementById('successPopup').style.display = 'none';

            if (json != ''){

                popupText.empty();
                switch (json){
                    case "successPPPFeedback":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Správa bola úspešne odoslaná');
                        break;
                }
                popup.alert();
            }

        }

    </script>

    @endif

    @else

        @include('nopermission')

    @endif

@else

    <div class="alert alert-warning" role="alert">
        Nie ste prihlásený!
    </div>

@endif

@endsection

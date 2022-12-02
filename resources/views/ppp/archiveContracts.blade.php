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
            <th scope="col">Archive</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if(auth()->user()->id == $contract->ppp_id && $contract->closed != null)
                <form method="get" action="{{ route('ppp.contractsPDF') }}" target="_blank">
                    <tr>
                        @foreach($users as $user)
                            @if($contract->users_id === $user->id)
                                <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
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
                            <input hidden value="{{ auth()->user()->id }}" id="ppp_id" name="ppp_id">
                            <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="pdf">Create archive</button>
                            <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="page">Preview archive</button>
                        </td>
                    </tr>
                </form>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection

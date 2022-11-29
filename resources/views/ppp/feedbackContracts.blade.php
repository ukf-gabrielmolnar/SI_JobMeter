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
                        @endif
                    @endforeach
                    @foreach($jobs as $job)
                        @if($contract->jobs_id === $job->id)
                            <td>{{$job->job_type}}</td>
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
                        <form method="get" action="#">
                            <input hidden id="id" name="id" value="{{ $contract->id }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-warning" type="submit">Add feedback</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endsection

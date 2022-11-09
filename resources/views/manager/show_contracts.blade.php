@extends('manager.index')

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
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
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
                <td>{{$contract->approved}}</td>
                <td>{{$contract->closed}}</td>
                <a class="btn btn-sm btn-outline-warning" href="{{route('contract.show', $contract->id)}}">Show</a>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

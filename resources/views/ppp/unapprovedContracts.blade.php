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
            <th scope="col">Detajly</th>
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
                    <form method="get" action="{{ route('ppp.approveContracts') }}">
                        <input hidden id="id" name="id" value="{{ $contract->id }}">
                    @csrf
                    @if($contract->approved == null)
                        <button class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                            <input hidden id="approved" name="approved" value="1">
                    @else
                        <button class="btn btn-sm btn-outline-success" type="submit">Ano</button>
                            <input hidden id="approved" name="approved" value="">
                    @endif
                    </form>
                </td>
                <td>
                    <form method="get" action="{{ route('ppp.approveContracts') }}">
                        <input hidden id="id" name="id" value="{{ $contract->id }}">
                    @csrf
                    @if($contract->closed == null)
                        <button class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                            <input hidden id="approved" name="closed" value="1">
                    @else
                        <button class="btn btn-sm btn-outline-success" type="submit">Ano</button>
                            <input hidden id="approved" name="closed" value="">
                    @endif
                    </form>
                </td>
                <td>
                    <form method="get" action="#">
                        <input hidden id="id" name="id" value="{{ $contract->id }}">
                        @csrf
                            <button class="btn btn-sm btn-outline-warning" type="submit">Ukáž</button>
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endsection

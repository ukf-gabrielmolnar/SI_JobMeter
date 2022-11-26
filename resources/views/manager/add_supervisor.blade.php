@extends('layouts.main')

@section('content')


    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Student</th>
            <th scope="col">Prace</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Nadriadeny</th>
            <th scope="col"> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if($contract->approved === 1 && $contract->ppp_id === NULL)
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
                        <form method="get" action="{{ route('contract.add_ppp') }}">
                            <input hidden id="id" name="id" value="{{ $contract->id }}">
                            @csrf
                            <select class="form-select" id="ppp_id" name="ppp_id">
                                <option value="0" selected="selected" hidden>
                                    {{__('Vyberte nadriadeneho')}}
                                </option>
                                @foreach($users as $user)
                                    <!-- ide jön az r(i)ba(n)c auth hogy csak azok legyenek ott akik tanarok -->
                                    <option value={{$user}}>
                                        {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                    </option>

                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="get" action="{{ route('contract.add_ppp') }}">
                            <input hidden id="id" name="id" value="{{ $contract->id }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-warning" type="submit">Ulozit</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endsection

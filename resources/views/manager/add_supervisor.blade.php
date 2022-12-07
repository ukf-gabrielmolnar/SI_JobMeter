@extends('layouts.main')

@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('manager') || auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))


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
                        <form method="get" action="{{ route('contract.add_ppp') }}">
                            @csrf
                            <td>
                            <input hidden id="id" name="id" value="{{ $contract->id }}">

                            <select class="form-select" id="ppp_id" name="ppp_id">
                                <option value="0" selected="selected" hidden>
                                    {{__('Vyberte nadriadeneho')}}
                                </option>
                                @foreach($users as $user)
                                    <!-- ide jön az r(i)ba(n)c auth hogy csak azok legyenek ott akik tanarok -->
                                    <option value="{{$user->id}}" id="ppp" name="ppp">
                                        {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                    </option>

                                @endforeach
                            </select>
                            </td>
                            <td>
                            <input hidden id="id" name="id" value="{{ $contract->id }}">
                            <button class="btn btn-sm btn-outline-warning" type="submit">Ulozit</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">Nie ste prihlásený!</h1>

@endif

@endsection

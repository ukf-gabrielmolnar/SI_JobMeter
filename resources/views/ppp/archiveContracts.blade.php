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

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Študent</th>
            <th scope="col">Práce</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Potvrdené</th>
            <th scope="col">Ukončené</th>
            <th scope="col">Archív</th>
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
                            <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="pdf">Vygenerovať certifikát</button>
                            <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="page">Náhľad certifikátu</button>
                        </td>
                    </tr>
                </form>
            @endif
        @endforeach
        </tbody>
    </table>

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

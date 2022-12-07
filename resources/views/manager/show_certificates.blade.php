@extends('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('manager') || auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

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
            <th scope="col">Pracovná pozícia</th>
            <th scope="col">Firma</th>
            <th scope="col">Ukončené dňa</th>
            <th scope="col">Prax dozoroval</th>
            <th scope="col">Firemný kontakt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if($contract->closed === 1)

                <tr id="{{$contract->id}}tr">
                    @foreach($users as $user)
                        @if($contract->users_id === $user->id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                        @endif
                    @endforeach
                    @foreach($jobs as $job)
                        @if($contract->jobs_id === $job->id)
                            <td>{{$job->job_type}}</td>
                        @endif
                        @foreach($companies as $company)
                            @if($job->companies_id === $company->id)
                                <td>{{$company->name}}</td>
                            @endif
                        @endforeach
                    @endforeach
                    <td>{{$contract->do}}</td>
                    @foreach($users as $user)
                        @if($user->id === $contract->ppp_id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                        @endif
                    @endforeach
                        @foreach($contacts as $contact)
                            @if($contact->id === $contract->contact_id)
                                <td>{{$contact->firstname}}{{" "}}{{$contact->lastname}}</td>
                            @endif
                        @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    @endif

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">Nie ste prihlásený!</h1>

@endif

@endsection



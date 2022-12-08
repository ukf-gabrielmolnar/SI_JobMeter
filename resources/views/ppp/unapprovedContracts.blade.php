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

    <form method="get" action="{{ route('ppp.filterContracts') }}">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="col-sm-2">
                <select class="form-select" id="filter1" name="filter1">
                    @if($filter1 == 1)
                    <option value="1" selected>Všetky</option>
                    <option value="2">Schválené</option>
                    <option value="3">Neschválené</option>
                    @endif
                    @if($filter1 == 2)
                        <option value="1">Všetky</option>
                        <option value="2" selected>Schválené</option>
                        <option value="3">Neschválené</option>
                    @endif
                    @if($filter1 == 3)
                        <option value="1">Všetky</option>
                        <option value="2">Schválené</option>
                        <option value="3" selected>Neschválené</option>
                    @endif
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-select" id="filter2" name="filter2">
                    @if($filter2 == 1)
                        <option value="1" selected>Všetky</option>
                        <option value="2">Zatvorené</option>
                        <option value="3">Otvorené</option>
                    @endif
                    @if($filter2 == 2)
                        <option value="1">All</option>
                        <option value="2" selected>Zatvorené</option>
                        <option value="3">Otvorené</option>
                    @endif
                    @if($filter2 == 3)
                        <option value="1">Všetky</option>
                        <option value="2">Zatvorené</option>
                        <option value="3" selected>Otvorené</option>
                    @endif
                </select>
            </div>
            <button type="submit" style="border-radius: 6px" class="btn btn-outline-secondary"> Použiť filtre </button>
        </div>
    </form>

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Študent</th>
            <th scope="col">Práce</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Potvrdené</th>
            <th scope="col">Ukončené</th>
            <th scope="col">Detaily</th>
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
                        <input hidden id="filter1" name="filter1" value="{{ $filter1}}">
                        <input hidden id="filter2" name="filter2" value="{{ $filter2 }}">
                    @csrf
                    @if($contract->approved == null)
                        <button class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                            <input hidden id="approved" name="approved" value="1">
                    @else
                        <button class="btn btn-sm btn-outline-success" type="submit">Áno</button>
                            <input hidden id="approved" name="approved" value="0">
                    @endif
                    </form>
                </td>
                <td>
                    <form method="get" action="{{ route('ppp.approveContracts') }}">
                        <input hidden id="id" name="id" value="{{ $contract->id }}">
                        <input hidden id="filter1" name="filter1" value="{{ $filter1}}">
                        <input hidden id="filter2" name="filter2" value="{{ $filter2 }}">
                    @csrf
                    @if($contract->closed == null)
                        <button class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                            <input hidden id="approved" name="closed" value="1">
                    @else
                        <button class="btn btn-sm btn-outline-success" type="submit">Áno</button>
                            <input hidden id="approved" name="closed" value="0">
                    @endif
                    </form>
                </td>
                <td>
                    <form method="get" action="{{ route('ppp.contractsPDF') }}">
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

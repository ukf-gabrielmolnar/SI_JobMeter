@extends('layouts.main')

@section('content')


    <form method="get" action="{{ route('ppp.filterContracts') }}">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="col-sm-2">
                <select class="form-select" id="filter1" name="filter1">
                    @if($filter1 == 1)
                    <option value="1" selected>All</option>
                    <option value="2">Approved</option>
                    <option value="3">Unapproved</option>
                    @endif
                    @if($filter1 == 2)
                        <option value="1">All</option>
                        <option value="2" selected>Approved</option>
                        <option value="3">Unapproved</option>
                    @endif
                    @if($filter1 == 3)
                        <option value="1">All</option>
                        <option value="2">Approved</option>
                        <option value="3" selected>Unapproved</option>
                    @endif
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-select" id="filter2" name="filter2">
                    @if($filter2 == 1)
                        <option value="1" selected>All</option>
                        <option value="2">Closed</option>
                        <option value="3">Unclosed</option>
                    @endif
                    @if($filter2 == 2)
                        <option value="1">All</option>
                        <option value="2" selected>Closed</option>
                        <option value="3">Unclosed</option>
                    @endif
                    @if($filter2 == 3)
                        <option value="1">All</option>
                        <option value="2">Closed</option>
                        <option value="3" selected>Unclosed</option>
                    @endif
                </select>
            </div>
            <button type="submit"> Apply filters </button>
        </div>
    </form>

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
                        <input hidden id="filter1" name="filter1" value="{{ $filter1}}">
                        <input hidden id="filter2" name="filter2" value="{{ $filter2 }}">
                    @csrf
                    @if($contract->approved == null)
                        <button class="btn btn-sm btn-outline-danger" type="submit">Nie</button>
                            <input hidden id="approved" name="approved" value="1">
                    @else
                        <button class="btn btn-sm btn-outline-success" type="submit">Ano</button>
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
                        <button class="btn btn-sm btn-outline-success" type="submit">Ano</button>
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

@endsection

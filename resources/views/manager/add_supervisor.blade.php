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

    <div class="row mb-3">
        <div class="col-md-6">
            <select class="form-select form-select-lg mb-3" id="povereny_pracovnik" name="povereny_pracovnik">
                <option value="0" selected>Vsetky praxe</option>
                <option value="1">Praxe bez školitela</option>
                <option value="2">Praxe so školitelom</option>
            </select>
        </div>
    </div>

    <table class="table table-white table-hover" id="myTable">
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
                    @endforeach
                    <td>{{$contract->od}}</td>
                    <td>{{$contract->do}}</td>
                    <form method="get" action="{{ route('contract.add_ppp') }}">
                         @csrf
                         <td>
                         <input hidden id="id" name="id" value="{{ $contract->id }}">
                         <select class="form-select" id="ppp_id" name="ppp_id">
                             <option value="0" selected="selected" hidden>Vyberte nadriadeneho</option>
                             @foreach($roles as $role)
                                @if(($role->role_id === 3) || $role->role_id === 6)
                                    @foreach($users as $user)
                                        @if($role->user_id === $user->id)
                                            @if($contract->ppp_id === $user->id)
                                                 <option value="{{$user->id}}" id="ppp" name="ppp" selected>
                                                     {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                                 </option>
                                            @else
                                                <option value="{{$user->id}}" id="ppp" name="ppp">
                                                    {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                             @endforeach
                         </select>
                         </td>
                         <td>
                            <input hidden id="id" name="id" value="{{ $contract->id }}">
                            <button class="btn btn-sm btn-outline-warning" type="submit">Ulozit</button>
                         </td>
                    </form>

                </tr>

        @endforeach
        </tbody>
    </table>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>

        $('#povereny_pracovnik').on('change', function (){
            var selectedOption = 0;
            selectedOption = $(this).children(":selected").attr("value");
            var contracts = @json($contracts);
            switch (selectedOption){
                case '0':{
                    $.each(contracts, function (index, contract){
                        document.getElementById(contract.id + "tr").style.display = "";
                    })
                    break;
                }
                case '1':{
                    $.each(contracts, function (index, contract){
                        if(contract.ppp_id === null){
                            document.getElementById(contract.id + "tr").style.display = "";
                        }else{
                            document.getElementById(contract.id + "tr").style.display = "none";
                        }

                    })
                    break;
                }
                case '2':{
                    $.each(contracts, function (index, contract){
                        if(contract.ppp_id === null){
                            document.getElementById(contract.id + "tr").style.display = "none";
                        }else{
                            document.getElementById(contract.id + "tr").style.display = "";
                        }

                    })
                    break;
                }
            }

        })


    </script>

    @endif

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">Nie ste prihlásený!</h1>

@endif

@endsection

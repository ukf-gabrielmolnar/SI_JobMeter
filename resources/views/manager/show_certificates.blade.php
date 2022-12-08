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
        <div class="col-md-3">
            <select class="form-select form-select-lg mb-3" id="student_select" name="student_select">
                <option value="0" selected>Všetky študenti</option>
                @foreach($roles as $role)
                    @if($role->role_id === 4)
                        @foreach($users as $user)
                            @if($role->user_id === $user->id)
                                <option value="{{$user->id}}">{{$user->firstname}}{{" "}}{{$user->lastname}}</option>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select form-select-lg mb-3" id="company_select" name="company_select">
                <option value="0" selected>Všetky firmy</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Študent</th>
            <th scope="col">Pracovná pozícia</th>
            <th scope="col">Firma</th>
            <th scope="col">Ukončené dňa</th>
            <th scope="col">Prax dozoroval</th>
            <th scope="col">Firemný kontakt</th>
            <th scope="col"> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            @if($contract->certificate === 1)
                <form method="get" action="{{ route('ppp.contractsPDF') }}" target="_blank">
                <tr id="{{$contract->id}}tr">
                    @foreach($users as $user)
                        @if($contract->users_id === $user->id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                            <input hidden value="{{ $user->id }}" id="user_id" name="user_id">
                        @endif
                    @endforeach
                    @foreach($jobs as $job)
                        @if($contract->jobs_id === $job->id)
                            <td>{{$job->job_type}}</td>
                            @foreach($companies as $company)
                                @if($job->companies_id === $company->id)
                                    <td>{{$company->name}}</td>
                                @endif
                            @endforeach
                        @endif

                    @endforeach
                    <td>{{$contract->do}}</td>
                    @foreach($users as $user)
                        @if($user->id === $contract->ppp_id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
                        @endif
                    @endforeach
                    @foreach($contacts as $contact)
                        @if($contact->id === $contract->contacts_id)
                            <td>{{$contact->firstname}}{{" "}}{{$contact->lastname}}</td>
                        @endif
                    @endforeach
                    <td>
                        <input hidden value="{{ $contract->id }}"  id="contract_id" name="contract_id">
                        <input hidden value="{{ auth()->user()->id }}" id="ppp_id" name="ppp_id">
                        <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="pdf">Vytvoriť archív</button>
                        <button class="btn btn-sm btn-outline-warning" type="submit" name="show_form" value="page">Ukážka archívu</button>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>


        $('#student_select').on('change', function (){
            fillTable()

        })
        $('#company_select').on('change', function (){
            fillTable();
        })

        function fillTable(){
            var selectedStudent = 0;
            var selectedCompany = 0;
            selectedStudent = $(document.getElementById('student_select')).children(":selected").attr("value");
            selectedCompany = $(document.getElementById('company_select')).children(":selected").attr("value");
            var contracts = @json($contracts);
            var jobs = @json($jobs);
            var podmienka = 0;
            if(selectedStudent == 0 && selectedCompany == 0) podmienka = 0;
            if(selectedStudent == 0 && selectedCompany != 0) podmienka = 1;
            if(selectedStudent != 0 && selectedCompany == 0) podmienka = 2;
            if(selectedStudent != 0 && selectedCompany != 0) podmienka = 3;
            switch (podmienka){
                case 0:{
                    $.each(contracts, function (index, contract){
                        document.getElementById(contract.id + "tr").style.display = "";
                    })
                    break;
                }
                case 1:{
                    $.each(contracts, function (index, contract){
                        $.each(jobs, function (jobindex, job){
                            if(contract.jobs_id === job.id){
                                if(job.companies_id == selectedCompany){
                                    document.getElementById(contract.id + "tr").style.display = "";
                                }
                                else{
                                    document.getElementById(contract.id + "tr").style.display = "none";
                                }
                            }

                        })
                    })
                    break;
                }
                case 2:{
                    $.each(contracts, function (index, contract){
                        if(contract.users_id == selectedStudent){
                            document.getElementById(contract.id + "tr").style.display = "";
                        }
                        else{
                            document.getElementById(contract.id + "tr").style.display = "none";
                        }
                    })
                    break;
                }
                case 3:{
                    $.each(contracts, function (index, contract){
                        $.each(jobs, function (jobindex, job){
                            if(contract.jobs_id === job.id){
                                if(job.companies_id == selectedCompany){
                                    if(contract.users_id == selectedStudent){
                                        document.getElementById(contract.id + "tr").style.display = "";
                                    }
                                    else{
                                        document.getElementById(contract.id + "tr").style.display = "none";
                                    }
                                }
                            }
                        })


                    })
                    break;
                }
            }
        }


    </script>
    
    @endif

        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">Nie ste prihlásený!</h1>

    @endif


@endsection



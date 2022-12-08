@extends('layouts.main')
@section('content')

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

@if (auth()->user())

    @if (auth()->user()->inRole('admin') || auth()->user()->inRole('manager') || auth()->user()->inRole('dev'))

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
            <th scope="col">Podrobnosti</th>
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
                @if($contract->approved === 1)
                    <td>Áno</td>
                @elseif($contract->approved === 0)
                    <td>Nie</td>
                @else
                    <td>Prebieha</td>
                @endif
                @if($contract->closed === 1)
                    <td>Áno</td>
                @elseif($contract->closed === 0)
                    <td>Nie</td>
                @else
                    <td>Prebieha</td>
                @endif
                <td>
                    <a class="show-modal btn btn-sm btn-outline-warning" style="border-radius: 1px" onclick="showModal({{$contract->id}})">Podrobnosti</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal" id="myModal" tabindex="-1" aria-hidden="true">

        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2 id="modal_header"></h2>
            </div>
            <div class="modal-body" style="padding-left: 12%;">
                <table style="width:100%">
                    <tr>
                    <td><label class="form-label" style="color:black; font-weight: bold">Študent: </label></td>
                    <td><label class="form-label" style="color:black" id="student_label"></label></td>
                    </tr>

                    <tr>
                        <td><label class="form-label" style="color:black; font-weight: bold">Pracovisko: </label></td>
                        <td><label class="form-label" style="color:black" id="company_label"></label></td>
                    </tr>

                    <tr>
                        <td><label class="form-label" style="color:black; font-weight: bold">Pracovná pozícia: </label></td>
                        <td><label class="form-label" style="color:black" id="job_label"></label></td>
                    </tr>

                    <tr>
                        <td><label class="form-label" style="color:black; font-weight: bold">Začiatok praxe: </label></td>
                        <td><label class="form-label" style="color:black" id="od_label"></label></td>
                    </tr>

                    <tr>
                        <td><label class="form-label" style="color:black; font-weight: bold">Koniec praxe: </label></td>
                        <td><label class="form-label" style="color:black" id="do_label"></label></td>
                    </tr>

                    <tr>
                        <td><label class="form-label" style="color:black; font-weight: bold">Nadriadený: </label></td>
                        <td><label class="form-label" style="color:black" id="contact_label"></label></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        var span = document.getElementsByClassName("close")[0];
        var modal = document.getElementById("myModal");
        function showModal(id){
            var selectedContract = id;
            var users = @json($users);
            var jobs = @json($jobs);
            var contracts = @json($contracts);
            var companies = @json($companies);
            for(var g = 0; g < contracts.length; g++){
                if(selectedContract == contracts[g].id){
                    $("#od_label").html(contracts[g].od);
                    $("#do_label").html(contracts[g].do);
                    for(var j = 0; j < users.length; j++){
                        if(users[j].id == contracts[g].users_id){
                            $("#student_label").html(users[j].firstname + " " + users[j].lastname);
                        }

                    }
                    for(var k = 0; k < jobs.length; k++){
                        if(contracts[g].jobs_id == jobs[k].id){
                            $("#job_label").html(jobs[k].job_type);
                            for(var n = 0; n < companies.length; n++){
                                if(jobs[k].companies_id == companies[n].id){
                                    $("#company_label").html(companies[n].name);
                                    for(var p = 0; p < users.length; p++){
                                        if(contracts[g].ppp_id == users[p].id){
                                            $("#contact_label").html(users[p].firstname + " " + users[p].lastname);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            modal.style.display = "block";
            console.log(id);
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

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
            var nieco = 0;
            if(selectedStudent == 0 && selectedCompany == 0) nieco = 0;
            if(selectedStudent == 0 && selectedCompany != 0) nieco = 1;
            if(selectedStudent != 0 && selectedCompany == 0) nieco = 2;
            if(selectedStudent != 0 && selectedCompany != 0) nieco = 3;
            console.log(nieco);
            switch (nieco){
                case 0:{
                    $.each(contracts, function (index, contract){
                        console.log(selectedStudent + " " + selectedCompany + " student0 company0");
                        document.getElementById(contract.id + "tr").style.display = "";
                    })
                    break;
                }
                case 1:{
                    $.each(contracts, function (index, contract){
                        $.each(jobs, function (jobindex, job){
                            if(contract.jobs_id === job.id){
                                if(job.companies_id == selectedCompany){
                                    console.log(selectedStudent + " " + selectedCompany + " student0 company?");
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
                            console.log(selectedStudent + " " + selectedCompany + " student? company0");
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
                                        console.log(contract.jobs_id + " " + job.id + " " + job.companies_id + " " + selectedCompany + " " + contract.users_id + " " + selectedStudent);
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

    <div class="alert alert-warning" role="alert">
        Nie ste prihlásený!
    </div>

@endif

@endsection

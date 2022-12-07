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

        @if (auth()->user()->inRole('manager') || auth()->user()->inRole('admin') || auth()->user()->inRole('dev'))

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
            @if($contract->certificate === 1)

                <tr id="{{$contract->id}}tr">
                    @foreach($users as $user)
                        @if($contract->users_id === $user->id)
                            <td>{{$user->firstname}}{{" "}}{{$user->lastname}}</td>
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

        @else

            @include('nopermission')

        @endif

    @else

        <h1 style="text-align: center;">Nie ste prihlásený!</h1>

    @endif

@endsection


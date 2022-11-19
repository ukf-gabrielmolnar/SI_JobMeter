@extends('layouts.main')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <select class="form-select form-select-lg mb-3">

                <option value="0" selected="selected">
                    {{__('Vsetky studijne programy')}}
                </option>
                @foreach($study_programs as $st)
                    <option value={{$st->id}}>
                        {{$st->study_program}}{{"  "}}{{$st->year}}
                    </option>
                @endforeach
            </select>


        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <select class="form-select form-select-lg mb-3" id="study_id" name="study_id">

                <option value="0" selected="selected">
                    {{__('Vsetky studijne programy')}}
                </option>
                @foreach($study_programs as $st)
                    <option value={{$st->id}}>
                        {{$st->study_program}}{{"  "}}{{$st->year}}
                    </option>
                @endforeach
            </select>


        </div>
    </div>

    <table class="table table-white table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">Meno</th>
            <th scope="col">Priezvisko</th>
            <th scope="col">E-mail</th>
            <th scope="col">Studijný program</th>
            <th scope="col">Ročník</th>
            <th scope="col">Osvedčenia</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @foreach($years as $year)
                @if($user->years_id === $year->id)
                    @foreach($study_programs as $stud)
                        @if($stud->id === $year->study_programs_id)
                            <tr>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$stud->study_program}}</td>
                                <td>{{$year->year}}</td>
                                <td>
                                    <a class="show-modal btn btn-sm btn-outline-warning" onclick="showModal({{$user->id}})">Podrobnosti</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>

    <div class="modal" id="myModal" tabindex="-1" aria-hidden="true">

        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2 id="modal_header"></h2>
            </div>
            <div class="modal-body">
                <table class="table table-white table-hover" id="modal_table">
                    <thead>
                    <tr>
                        <th scope="col">Pozicia</th>
                        <th scope="col">Firma</th>
                        <th scope="col">Od</th>
                        <th scope="col">Do</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $
        var span = document.getElementsByClassName("close")[0];
        var modal = document.getElementById("myModal");
        function showModal(id){
            var selectedUser = id;
            var users = @json($users);
            var jobs = @json($jobs);
            var contracts = @json($contracts);
            var companies = @json($companies);
            var table = document.getElementById("modal_table");
            clearTable(table);
            for(var i = 0; i < users.length; i++){
                if(selectedUser == users[i].id){
                    $("#modal_header").html(users[i].firstname + " " + users[i].lastname);
                    for(var j = 0; j < contracts.length; j++){
                        if(contracts[j].users_id == selectedUser){
                            for(var k = 0; k < jobs.length; k++){
                                if(jobs[k].id == contracts[j].jobs_id){
                                    for(var n = 0; n < companies.length; n++){
                                        if(companies[n].id == jobs[k].companies_id){
                                            var row =  `<tr>
                                                            <td>${jobs[k].job_type}</td>
                                                            <td>${companies[n].name}</td>
                                                            <td>${contracts[j].od}</td>
                                                            <td>${contracts[j].do}</td>
                                                        </tr>`
                                            table.innerHTML += row;
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




        function clearTable(table){
            var tableHeader = 1;
            var tbl = table;
            var rowCount = tbl.rows.length;
            for(var i = tableHeader; i < rowCount; i++){
                tbl.deleteRow(tableHeader);
            }
        }

        $('#study_id').on('change', function (){
            var selectedStudyId = 0;
            selectedStudyId = $(this).children(":selected").attr("value");
            var data = @json($users);
            var stdpln = @json($study_programs);
            var table = document.getElementById("myTable");
            clearTable(table);
            for(var i = 0; i < data.length; i++){
                if (selectedStudyId == 0 || selectedStudyId == data[i].study_programs_id){
                    for(var j = 0; j < stdpln.length; j++){
                        if(data[i].study_programs_id == stdpln[j].id){
                            var row =  `<tr>
                                        <td>${data[i].firstname}</td>
                                        <td>${data[i].lastname}</td>
                                        <td>${data[i].email}</td>
                                        <td>${stdpln[j].study_program}</td>
                                        <td>${stdpln[j].year}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-warning" onclick="showModal(${data[i].id})">Podrobnosti</a>
                                        </td>
                                    </tr>`
                            table.innerHTML += row;
                        }
                    }

                }
            }

        })



    </script>

@endsection

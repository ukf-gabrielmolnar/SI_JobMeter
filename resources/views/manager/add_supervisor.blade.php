@extends('layouts.main')

@section('content')
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
                             <option value="0" selected="selected" hidden>Vyberte nadriadeneho</option>
                             @foreach($roles as $role)
                                @if($role->role_id === 3)
                                    @foreach($users as $user)
                                        @if($role->user_id === $user->id)
                                            <option value="{{$user->id}}" id="ppp" name="ppp">
                                                {{$user->firstname}}{{"  "}}{{$user->lastname}}
                                            </option>
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
        $

        function clearTable(table){
            var tableHeader = 1;
            var tbl = table;
            var rowCount = tbl.rows.length;
            for(var i = tableHeader; i < rowCount; i++){
                tbl.deleteRow(tableHeader);
            }
        }

        $('#povereny_pracovnik').on('change', function (){
            var selectedOption = 0;
            selectedOption = $(this).children(":selected").attr("value");

            var users = @json($users);
            var jobs = @json($jobs);
            var contracts = @json($contracts);
            var roles = @json($roles);
            var ppps = [];
            var user_name = "";
            var job_name = "";
            var ppp_name = "";
            var povereny_id = 0;
            var row_num = 0;
            var table = document.getElementById("myTable");
            clearTable(table);
            for(var i = 0; i < contracts.length; i++){
                switch (selectedOption){
                    case '0':{
                        for(var u = 0; u < users.length; u++){
                            console.log("toto efte pife");
                            if(users[u].id === contracts[i].users_id){
                                user_name = users[u].firstname + " " + users[u].lastname;
                            }
                            for(var r = 0; r < roles.length; r++){
                                if(roles[r].role_id === 3 && roles[r].user_id === users[u].id){
                                    ppps.push(users[u]);
                                    if(contracts[i].ppp_id === users[u].id){
                                        ppp_name = users[u].firstname + " " + users[u].lastname;
                                        povereny_id = users[u].id;
                                    }
                                }
                            }
                        }
                        for(var j = 0; j < jobs.length; j++){
                            if(contracts[i].jobs_id === jobs[j].id){
                                job_name = jobs[j].job_type;
                            }
                        }
                        var row = `<tr>
                                        <td>${user_name}</td>
                                        <td>${job_name}</td>
                                        <td>${contracts[i].od}</td>
                                        <td>${contracts[i].do}</td>
                                        <form method="get" action="/manager/saveSupervisor">

                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <select class="form-select" id="${row_num}_drp" name="ppp_id">
                                                    <option value="0" selected="selected" hidden>
                                                        Vyberte nadriadeneho
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <a  class="btn btn-sm btn-outline-warning edit" id="${row_num}_btn" type="submit">Priradit</a>
                                            </td>
                                        </form>
                                    </tr>`
                        row_num++;
                        break;
                    }
                    case '1':{
                        if(contracts[i].ppp_id === null) {
                            for (var u = 0; u < users.length; u++) {
                                console.log("aj toto");
                                if (users[u].id === contracts[i].users_id) {
                                    user_name = users[u].firstname + " " + users[u].lastname;
                                }
                                for (var r = 0; r < roles.length; r++) {
                                    if (roles[r].role_id === 3 && roles[r].user_id === users[u].id) {
                                        ppps.push(users[u]);
                                        if (contracts[i].ppp_id === users[u].id) {
                                            ppp_name = users[u].firstname + " " + users[u].lastname;
                                            povereny_id = users[u].id;
                                        }
                                    }
                                }
                            }
                            for (var j = 0; j < jobs.length; j++) {
                                if (contracts[i].jobs_id === jobs[j].id) {
                                    job_name = jobs[j].job_type;
                                }
                            }
                            var row = `<tr>
                                        <td>${user_name}</td>
                                        <td>${job_name}</td>
                                        <td>${contracts[i].od}</td>
                                        <td>${contracts[i].do}</td>
                                        <form method="get" action="/manager/saveSupervisor">
                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <select class="form-select" id="${row_num}_drp" name="ppp_id">
                                                    <option value="0" selected="selected" hidden>
                                                        Vyberte nadriadeneho
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <a  class="btn btn-sm btn-outline-warning edit" id="${row_num}_btn" type="submit">Priradit</a>
                                            </td>
                                        </form>
                                    </tr>`
                            row_num++;
                        }
                        break;
                    }
                    case '2':{
                        if(contracts[i].ppp_id !== null) {
                            for (var u = 0; u < users.length; u++) {
                                console.log("toto efte pife tento");
                                if (users[u].id === contracts[i].users_id) {
                                    user_name = users[u].firstname + " " + users[u].lastname;
                                }
                                for (var r = 0; r < roles.length; r++) {
                                    if (roles[r].role_id === 3 && roles[r].user_id === users[u].id) {
                                        ppps.push(users[u]);
                                        if (contracts[i].ppp_id === users[u].id) {
                                            ppp_name = users[u].firstname + " " + users[u].lastname;
                                            povereny_id = users[u].id;
                                        }
                                    }
                                }
                            }
                            for (var j = 0; j < jobs.length; j++) {
                                if (contracts[i].jobs_id === jobs[j].id) {
                                    job_name = jobs[j].job_type;
                                }
                            }
                            var row = `<tr>
                                        <td>${user_name}</td>
                                        <td>${job_name}</td>
                                        <td>${contracts[i].od}</td>
                                        <td>${contracts[i].do}</td>
                                        <form method="get" action="/manager/saveSupervisor">
                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <select class="form-select" id="${row_num}_drp" name="ppp_id">
                                                    <option value="0" selected="selected" hidden>
                                                        Vyberte nadriadeneho
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input hidden id="id" name="id" value="${contracts[i].id}">
                                                <a  class="btn btn-sm btn-outline-warning edit" id="${row_num}_btn" type="submit">Priradit</a>
                                            </td>
                                        </form>
                                    </tr>`
                            row_num++;
                        }
                        break;
                    }
                }
            }
            populateDropdown(row_num);
        })


        function populateDropdown(num){
            var users = @json($users);
            var roles = @json($roles);
            console.log(num);
            for(var i = 0; i < num; i++){
                var dd = document.getElementById(i + "_drp");
                var newOption = document.createElement('option');
                for(var j = 0; j < users.length; j++){
                    for(var r = 0; r < roles.length; r++){
                        if(roles[r].role_id === 3 && roles[r].user_id === users[j].id){

                            newOption.appendChild(document.createTextNode(users[j].firstname + " " + users[j].lastname));
                            newOption.setAttribute('value',users[j].id);
                            newOption.setAttribute('id', "ppp");
                            newOption.setAttribute('name', "ppp");
                            dd.appendChild(newOption);
                        }
                    }

                }
            }
        }


    </script>

@endsection

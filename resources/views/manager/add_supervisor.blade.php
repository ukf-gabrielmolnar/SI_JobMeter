@extends('layouts.main')

@section('content')
    <head>
        <meta name="crsf-token" content="{{csrf_token()}}">
    </head>
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

        </tbody>
    </table>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
            var row_num = 0;
            var users = @json($users);
            var contracts = @json($contracts);
            var jobs = @json($jobs);
            var table = document.getElementById("myTable");
            for(var i = 0; i < contracts.length; i++){
                if(contracts[i].approved == 1 && contracts[i].ppp_id == null){
                    for(var k = 0; k < jobs.length; k++) {
                        if (contracts[i].jobs_id == jobs[k].id) {
                            for (var j = 0; j < users.length; j++) {
                                if (contracts[i].users_id == users[j].id) {
                                    var row = `<tr>
                                                <td>${users[j].firstname} ${users[j].lastname}</td>
                                                <td>${jobs[k].job_type}</td>
                                                <td>${contracts[i].od}</td>
                                                <td>${contracts[i].do}</td>
                                                <td>
                                                    <select class="form-select" id="${row_num}_drp" name="contact_id">
                                                        <option value="0" selected="selected" hidden>
                                                            Vyberte nadriadeneho
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a  class="btn btn-sm btn-outline-warning edit" data-id="${contracts[i].id}" id="${row_num}_btn">Priradit</a>
                                                </td>
                                            </tr>`
                                    table.innerHTML += row;
                                    row_num++;
                                }
                            }
                        }
                    }
                }
            }
            populateDropdown(row_num);

        });

        function populateDropdown(num){
            var users = @json($users);
            for(var i = 0; i < num; i++){
                var dd = document.getElementById(i + "_drp");
                for(var j = 0; j < users.length; j++){
                    var newOption = document.createElement('option');
                    newOption.appendChild(document.createTextNode(users[j].firstname + " " + users[j].lastname));
                    newOption.setAttribute('value',users[j].id);
                    dd.appendChild(newOption);
                }
            }
        }

    </script>
@endsection

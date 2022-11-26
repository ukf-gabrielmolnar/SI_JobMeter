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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
        $(document).on('click', '.edit', function(e){
            var contractId = $(this).data('id');
            var btn_id = $(this).attr('id').charAt(0);
            var drp = document.getElementById(btn_id + "_drp");
            console.log(contractId + " " + $(drp).val());
            $.ajax({
                url:'manager.save_Supervisor',
                method:'post',
                data: {id:contractId,ppp_id:$(drp).val()},
                processData:false,
                contentType:false,
                beforeSend: function (){

                },
                success: function (data){

                }

            })
        });



        /*
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.edit', function(e){
                e.preventDefault();

                //var form = $(this).serialize();
                //var url = $(this).attr('href');
                var drpdwn = document.getElementsByName('contact_id');
                var rows = document.querySelectorAll('tr');
                //console.log(form + " " + url);
                for(var i = 0; i < rows.length; i++) {
                    rows[i].onclick = function (clickedRow) {
                        clickedRow = this.rowIndex;
                        for (var j = 0; j < drpdwn.length; j++) {
                            if (j == this.rowIndex - 1) {
                                $.post("", function (data) {
                                    data.id = contractId;
                                    data.ppp = $(drpdwn[j]).children(":selected").attr("value");
                                    console.log(data.id + " " + data.ppp);
                                })
                            }
                        }
                    }
                }
            });
        });









        $(document).on("click",".update", function (){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var contractId = $(this).data('id');
            var rows = document.querySelectorAll('tr');
            var clickedRow;
            var drpdwn = document.getElementsByName('contact_id');
            var ppp = null;
            for(var i = 0; i < rows.length; i++){
                rows[i].onclick = function(clickedRow){
                    clickedRow = this.rowIndex;
                    for(var j = 0; j < drpdwn.length; j++){
                        if(j == this.rowIndex-1){
                            console.log(clickedRow, $(drpdwn[j]).children(":selected").attr("value"));
                            $.ajax({
                                url:,
                                type: 'post',
                                cache: false,
                                data: {
                                    _token: CSRF_TOKEN, contact: $(drpdwn[j]).children(":selected").attr("value"), contract: contractId
                                }
                            })
                        }
                    }

                };
            }*/
        /*
                    for(var j = 0; j < drpdwn.length; j++){
                        if(clickedRow === j){
                           ppp = $(drpdwn[j]).children(":selected").attr("value");

                        }
                  }
                    console.log(clickedRow + " " + ppp);
                    /*
                    var selectedContact = $(this).prevUntil("select.lofasz");
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    }) */


        /* var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         var ele = document.getElementById("contact_id");
         var selectedSup = ele.options[ele.selectedIndex].value;
         if(ele.id != null){
             $.ajax({
                 url: 'saveSupervisor',
                 type: 'post',
                 cache: false,
                 data: {
                     _token: CSRF_TOKEN, contact: ele.id, contract: contract
                 }
             })*/



    </script>
@endsection

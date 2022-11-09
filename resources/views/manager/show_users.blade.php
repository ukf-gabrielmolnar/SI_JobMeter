@extends('manager.index')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <select class="form-select form-select-lg mb-3" id="study_id" name="study_id">
                <option selected disabled hidden>Zobrazit podla studijneho planu</option>
                <option value="0">
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
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $


        document.getElementById("study_id");

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

                                    </tr>`
                            table.innerHTML += row;
                        }
                    }

                }
            }

        })



    </script>

@endsection

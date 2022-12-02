@extends('layouts.main')

@section('content')
    <table class="table table-white table-hover">
        <thead>
        <tr>
            <th scope="col">Student</th>
            <th scope="col">Prace</th>
            <th scope="col">od</th>
            <th scope="col">do</th>
            <th scope="col">Potvrdene</th>
            <th scope="col">Ukoncene</th>
            <th scope="col">Podrobnosti</th>
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
                @if($contract->approved === 1)
                    <td align="center"><img src="https://www.pngfind.com/pngs/m/42-423686_clipart-transparent-check-mark-computer-icons-royalty-green.png" width="25" height="25"></td>
                @elseif($contract->approved === 0)
                    <td align="center"><img src="https://www.pngfind.com/pngs/m/3-31254_red-cross-mark-clipart-black-background-red-x.png" width="25" height="25"></td>
                @else
                    <td align="center"><img src="https://w7.pngwing.com/pngs/848/254/png-transparent-computer-icons-question-mark-window-window-blue-furniture-window-thumbnail.png" width="25" height="25"></td>
                @endif
                @if($contract->closed === 1)
                    <td align="center"><img src="https://www.pngfind.com/pngs/m/42-423686_clipart-transparent-check-mark-computer-icons-royalty-green.png" width="25" height="25"></td>
                @elseif($contract->closed === 0)
                    <td align="center"><img src="https://www.pngfind.com/pngs/m/3-31254_red-cross-mark-clipart-black-background-red-x.png" width="25" height="25"></td>
                @else
                    <td align="center"><img src="https://w7.pngwing.com/pngs/848/254/png-transparent-computer-icons-question-mark-window-window-blue-furniture-window-thumbnail.png" width="25" height="25"></td>
                @endif
                <td>
                    <a class="show-modal btn btn-sm btn-warning" style="border-radius: 1px" onclick="showModal({{$contract->id}})">Podrobnosti</a>
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
    </script>
@endsection

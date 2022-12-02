@extends('layouts.main')
@section('content')

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successPopup" name="successPopup">
        <p id="popupText"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <h1> Aktivna prava </h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nazov pracoviska</th>
            <th scope="col">Nazov prace</th>
            <th scope="col">Pridat zaznam</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!----------Contract---------->
            @foreach($contracts as $contract)
                @if($contract->users_id == auth()->user()->id)
                    <input hidden name="contractIdIn" id="contractIdIn" value="{{$contract->id}}">
                    <!----------Job---------->
                    @foreach($jobs as $job)
                        @if($job->id == $contract->jobs_id)
                            <!----------Company---------->
                            @foreach($companies as $company)
                                @if($company->id == $job->companies_id)
                                    <td>
                                        {{$company->name}}
                                    </td>
                                @endif
                            @endforeach
                            <!--------------------------->
                            <td>
                                {{$job->job_type}}
                            </td>
                        @endif
                    @endforeach
                    <!----------------------->
                    <td>
                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#recordForm" onclick="fillData()">Pridat zaznam</button>
                    </td>
                @endif
            @endforeach
            <!---------------------------->
        </tr>
        </tbody>
    </table>
    <div class="modal fade" id="recordForm"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pridat odpracovane hodiny</h1>
                    <!-- x kilepes -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="get" action="{{ route('dashboard.saveRecord') }}">
                    <div class="modal-body">
                        <input hidden id="contracts_id" name="contracts_id">

                        <h5>Datum</h5>
                        <p><?php echo date('Y-m-d');?></p>
                        <input hidden value="<?php echo date('Y-m-d');?>" id="date" name="date">

                        <h5>Hodiny</h5>
                        <select id="hours" name="hours">
                            <?php
                            for ($i=1; $i<=12; $i ++)
                            {
                                ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ulozit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h1> Archivovane prace </h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nazov pracoviska</th>
            <th scope="col">Datum</th>
            <th scope="col">Hodnotenie</th>
            <th scope="col">Pracovne hodiny</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!----------Contract---------->
            @foreach($contracts as $contract)
                @if($contract->users_id == auth()->user()->id && $contract->certificate == )
                    <input hidden name="contractIdIn" id="contractIdIn" value="{{$contract->id}}">
                    <!----------Job---------->
                    @foreach($jobs as $job)
                        @if($job->id == $contract->jobs_id)
                            <!----------Company---------->
                            @foreach($companies as $company)
                                @if($company->id == $job->companies_id)
                                    <td>
                                        {{$company->name}}
                                    </td>
                                @endif
                            @endforeach
                            <!--------------------------->
                            <td>
                                {{$job->job_type}}
                            </td>
                        @endif
                    @endforeach
                    <!----------------------->
                    <td>
                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#recordForm" onclick="fillData()">Pridat zaznam</button>
                    </td>
                @endif
            @endforeach
            <!---------------------------->
        </tr>
        </tbody>
    </table>


    <script>
        function fillData(){

            $('#contracts_id').val($('#contractIdIn').val())
        }

        window.onload = function (){
            var json = @json($popupMessage);
            var popupText = $('#popupText');
            var popup = $('#successPopup');
            document.getElementById('successPopup').style.display = 'none';

            if (json != ''){

                popupText.empty();
                switch (json){
                    case "successPraxReg":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Registrácia na prax bol úspešný');
                        break;
                    case "successJobAdd":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Práca bola úspešne pridaná');
                        break;
                    case "successStudentFeedback":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Správa bola úspešne odoslaná');
                        break;
                    case "successAddRecord":
                        document.getElementById('successPopup').style.display = 'block';
                        popupText.append('Údaje boli uspešne odoslané');
                        break;
                }
                popup.alert();
            }
        }
    </script>

@endsection

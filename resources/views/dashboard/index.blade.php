@extends('layouts.main')
@section('content')

    @auth()

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successPopup" name="successPopup">
        <p id="popupText"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @if (auth()->user()->inRole('manager'))

        {{ route('manager.show_contracts') }}

    @elseif (auth()->user()->inRole('ppp'))

        {{ route('ppp.unapprovedContracts') }}

    @elseif (auth()->user()->inRole('admin'))

        {{ route('majd ha marknak kesz') }}

    @elseif (auth()->user()->inRole('ceo'))

        {{ route('majd ha marknak kesz') }}

    @elseif (auth()->user()->inRole('student') || auth()->user()->inRole('dev'))

        <div style="background-color: #e0eaec; padding: 20px">
        <h1> Aktívna práca </h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Názov pracoviska</th>
                <th scope="col">Názov práce</th>
                <th scope="col">Pridať záznam</th>
            </tr>
            </thead>
            <tbody>
                <!----------Contract---------->
                @foreach($contracts as $contract)
                    <tr>
                    @if($contract->users_id == auth()->user()->id && $contract->approved == 1 && $contract->closed == 0)
                        <!----------Job---------->
                        @foreach($jobs as $job)
                            @if($job->id == $contract->jobs_id)
                                <!----------Company---------->
                                @foreach($companies as $company)
                                    @if($company->id == $job->companies_id)
                                        <td>
                                            {{$company->name}}
                                        </td>
                                        <td>
                                            {{$job->job_type}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#recordForm">Pridat zaznam</button>
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
                                                                <input hidden id="contracts_id" name="contracts_id" value="{{$contract->id}}">

                                                                <h5>Datum</h5>
                                                                <p><?php echo date('Y-m-d');?></p>
                                                                <input hidden value="<?php echo date('Y-m-d');?>" id="date" name="date">

                                                                <h5>Hodiny</h5>
                                                                <select id="hours" name="hours" style="border-radius: 3px; border-color: #41565b; width: 60px; height: 25px">
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
                                        </td>
                                    @endif
                                @endforeach
                                <!--------------------------->
                            @endif
                        @endforeach
                        <!----------------------->

                    @endif
                    </tr>
                @endforeach
                <!---------------------------->
            </tbody>
        </table>
        </div>

    <br><br>

        <div style="background-color: #e0eaec; padding: 20px">
        <h1> Archivované práce </h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Názov pracoviska</th>
                <th scope="col">Názov práce</th>
                <th scope="col">Dátum</th>
                <th scope="col">Hodnotenie</th>
                <th scope="col">Pracovné hodiny</th>
                <th scope="col">Certifikát</th>
            </tr>
            </thead>
            <tbody>
                <!----------Contract---------->
                @foreach($contracts as $contract)
                    <tr>
                    @if($contract->users_id == auth()->user()->id && $contract->closed == 1)
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
                            {{ $contract->do }}
                        </td>
                        <td>
                            @foreach($feedbackReports as $feedback)
                                @if($feedback->users_id == auth()->user()->id && $feedback->contracts_id == $contract->id)
                                    @if($feedback->subject == "Hodnotenie")
                                        {{ $feedback->text }}
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @php
                                $h = 0  ;
                            @endphp
                            @foreach($records as $record)
                                @if($record->contracts_id == $contract->id)
                                    @php
                                        $h += $record->hours;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                echo $h;
                            @endphp
                        </td>

                        <td>
                            <button class="btn btn-sm btn-outline-warning" type="button">Stiahnut certifikat</button>
                        </td>
                    @endif
                    </tr>
                @endforeach
                <!---------------------------->
            </tbody>
        </table>
            </div>
            @endif
        @endauth



        <script>

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

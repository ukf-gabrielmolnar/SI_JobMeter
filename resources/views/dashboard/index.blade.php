@extends('layouts.main')
@section('content')

    @if (auth()->user())

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successPopup" name="successPopup">
        <p id="popupText"></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @if (auth()->user()->inRole('manager'))

        @php
            header("Location: manager/contracts");
            exit();
        @endphp

    @elseif (auth()->user()->inRole('ppp'))

        @php
            header("Location: /unapprovedContracts");
            exit();
        @endphp

    @elseif (auth()->user()->inRole('admin'))

        @php
            header("Location: /adminView");
            exit();
        @endphp

    @elseif (auth()->user()->inRole('ceo'))

        @php
            header("Location: /ceoView");
            exit();
        @endphp

    @elseif (auth()->user()->inRole('student') || auth()->user()->inRole('dev'))

        @php
            $empty = 0;
                foreach ($contracts as $contract){
                    if($contract->users_id == auth()->user()->id){
                        $empty++;
                    }
                }
        @endphp

        @if ($empty == 0 && auth()->user()->years_id != null)

            <h1 style="text-align: center">Registruj na prax!</h1>

        @elseif ($empty == 0 && auth()->user()->years_id == null)

            <h1 style="text-align: center">Aby si vedel zaregistrovať na prax, najprv zadaj svoj študijný program!</h1>

        @endif

        @php
            $help = 0;
                foreach ($contracts as $contract){
                    if($contract->users_id == auth()->user()->id && $contract->approved == 1 && $contract->closed != 1){
                        $help++;
                    }
                }
        @endphp

        @if ($help > 0)

        <div style="background-color: #454a50; padding: 20px; width: 100%; overflow-x:auto;">
        <h1 style="color: #b3dfe7"> Aktívna práca </h1>
            <br>

        <table class="table" style="vertical-align: middle; color: #b3dfe7;">
            <thead>
            <tr>
                <th scope="col">Názov pracoviska</th>
                <th scope="col">Názov práce</th>
                <th scope="col">Komentáre</th>
                <th scope="col">Končí</th>
                <th scope="col">Pridať záznam</th>
                <th scope="col">Priebeh</th>
            </tr>
            </thead>
            <tbody>
                <!----------Contract---------->
                @foreach($contracts as $contract)
                    <tr>
                    @if($contract->users_id == auth()->user()->id && $contract->approved == 1 && $contract->closed != 1)
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
                                            @php
                                                $num = 0;
                                                foreach ($feedbackReports as $feedback){
                                                    if ($feedback->users_id == auth()->user()->id && $feedback->contracts_id == $contract->id){
                                                        if($feedback->subject == "Komentár"){
                                                            $num++;
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#kommentarModal">Komentáre ({{$num}})</button>
                                            <div class="modal" id="kommentarModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Komentáre</h1>
                                                            <!-- x kilepes -->
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Meno</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Datum</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($feedbackReports as $feedback)
                                                                        @if($feedback->users_id == auth()->user()->id && $feedback->contracts_id == $contract->id)
                                                                            @if($feedback->subject == "Komentár")
                                                                                @foreach($users as $user)
                                                                                    @if($user->id == $contract->ppp_id)
                                                                                        <tr>
                                                                                            <td>{{$user->fistname." ".$user->lastname}}</td>
                                                                                            <td>{{$user->email}}</td>
                                                                                            <td>{{$feedback->created_at}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3">{{$feedback->text}}</td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        <td>
                                            {{ $contract->do }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#recordForm">Pridat zaznam</button>
                                            <div class="modal" id="recordForm"  aria-hidden="true">
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
                                                                <input type="date" id="date" name="date" value='<?php echo date('Y-m-d');?>'>

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
                                        <td class="progress-column">
                                            @php
                                                $start = new DateTime($contract->od);
                                                $end = new DateTime($contract->do);
                                                $today = new DateTime(date('Y-m-d'));
                                                $fullInterval = $start->diff($end);
                                                $intervalFromToday = $start->diff($today);
                                                $currentInPercent = round(($intervalFromToday->days / $fullInterval->days ) * 100, 2);
                                            @endphp
                                            <a style="font-size: 12px">{{ $currentInPercent."%" }}</a>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $currentInPercent."%" }};" aria-valuenow="{{ $currentInPercent}}" aria-valuemin="0" aria-valuemax="100"></div>
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

        @endif

        @php
            $helper1 = 0;
            $helper2 = 0;
                foreach ($contracts as $contract){
                    if($contract->users_id == auth()->user()->id && $contract->approved != 1 && $contract->closed != 1){
                        $helper1++;
                    }
                }
        @endphp

        @if ($helper1 > 0)

            <br>

            <div style="background-color: #cfe9f1; padding: 20px">
                <h1>Ešte neschválené práce</h1>
                <br>

                <table class="table" style="vertical-align: middle">
                    <thead>
                    <tr>
                        <th scope="col">Názov pracoviska</th>
                        <th scope="col">Názov práce</th>
                        <th scope="col">Dátum</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!----------Contract---------->
                    @foreach($contracts as $contract)
                        <tr>
                            @if($contract->users_id == auth()->user()->id && $contract->closed != 1 && $contract->approved != 1)
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
                                    {{ $contract->od }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <!---------------------------->
                    </tbody>
                </table>
            </div>
        @endif

        @php
        $help2 = 0;
            foreach ($contracts as $contract){
                if($contract->users_id == auth()->user()->id && $contract->closed == 1 && $contract->approved == 1){
                    $help2++;
                }
            }
        @endphp

        @if ($help2 > 0)

            <br>

        <div style="background-color: #f0f9fc; padding: 20px">
        <h1> Archivované práce </h1>
            <br>

    <table class="table" style="vertical-align: middle">
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
                @if($contract->users_id == auth()->user()->id && $contract->closed == 1 && $contract->approved == 1)
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
                            @if($record->contracts_id == $contract->id && $record->approved == 1)
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
                        <form style="margin-bottom: 0px" method="get" action="{{ route('ppp.contractsPDF') }}" target="_blank">
                            <input hidden id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                            <input hidden id="contract_id" name="contract_id" value="{{ $contract->id }}">
                            <input hidden id="ppp_id" name="ppp_id" value="{{ $contract->ppp_id }}">
                            @if ($contract->certificate != 1)
                                <button class="btn btn-sm btn-outline-secondary" disabled type="submit" name="show_form" value="pdf">Stiahnuť</button>
                            @else
                                <button class="btn btn-sm btn-outline-secondary" type="submit" name="show_form" value="pdf">Stiahnuť</button>
                            @endif
                        </form>
                    </td>
                @endif
                </tr>
            @endforeach
            <!---------------------------->
        </tbody>
    </table>
        </div>
            @endif

    @else

        <h1 style="text-align: center">Počkajte, kým bude vaša rola prijatá.</h1>

    @endif

    @else

        @php
            header("Location: /login");
            exit();
        @endphp

    @endif

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

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        h1 {
            text-align: center;
            margin-top: 30px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        td:first-child {
            font-weight: bold
        }

        .center {
            text-align: center;
        }

        div{
            margin-left: auto;
            margin-right: auto;
            font-family: arial, sans-serif;
            width: 80%;
            margin-top: 50px;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>

</head>
<header>
    <h1>Certifikát o praktickej činnosti</h1>
</header>

<body>
<table>
    <tr>
    <td>Meno študenta: </td> <td>{{ $user->firstname." ".$user->lastname }}</td>
    </tr>
    <tr>
<td>Odbor: </td><td>{{ $year->year." ".$sp->study_program }}</td>
    </tr>
    <tr>
<td>Nadriadená osoba:</td><td> Meno a priezvisko: 	&nbsp;	&nbsp;{{ $ppp->firstname." ".$ppp->lastname }}<br> E-mail: 	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;{{ $ppp->email }}</td>
    </tr>
    <tr>
<td>Pracovisko: </td><td>{{ $company->name }}</td>
    </tr>
    <tr>
        <td>Adresa pracovisku:</td><td> {{ $company->address }}</td>
    </tr>
    <tr>
        <td>Kontaktná osoba:</td><td> Meno a priezvisko: &nbsp;	&nbsp;{{ $contact->firstname." ".$contact->lastname }}<br>E-mail:	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;{{ $contact->email }}<br>Tel. číslo:	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;{{ $contact->tel }}</td>
    </tr
    <tr>
        <td>Pozícia v pracovisku:</td><td> {{ $job->job_type }}</td>
    </tr>
    <tr>
        <td>Od:</td><td> {{ $contract->od }}</td>
    </tr>
    <tr>
        <td>Do:</td><td> {{ $contract->do }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>Počet odpracovaných hodín: </td>
        <td>
            @php
                $h = 0;
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
    </tr>
    <tr>
        <td>Meno a priezvisko CEO</td><td>{{ $ceo->firstname." ".$ceo->lastname }}</td>
    </tr>
</table>

<div>
    <h4>Hodnotenie študenta:</h4>
    <p>@foreach($feedbackR as $feedback)
            @if($feedback->users_id == $user->id && $feedback->contracts_id == $contract->id)
                @if($feedback->subject == "Hodnotenie")
                    {{ $feedback->text }}
                @endif
            @endif
        @endforeach</p>
</div>

</body>

</html>


<html>
<head>
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
            width: 50%;
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
            width: 50%;
            margin-top: 50px;
        }
    </style>
</head>
<header>
    <h1>Lorem ipsum dolor sit amet</h1>
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
<td>Nadriadená osoba:</td><td> {{ $ppp->firstname." ".$ppp->lastname }}, email: {{ $ppp->email }}</td>
    </tr>
    <tr>
<td>Pracovisko: </td><td>{{ $company->name }}</td>
    </tr>
    <tr>
        <td>Adresa pracovisku:</td><td> {{ $company->address }}</td>
    </tr>
    <tr>
        <td>Kontaktná osoba:</td><td> {{ $contact->firstname." ".$contact->lastname }} {{ $contact->email }} {{ $contact->tel }}</td>
    </tr>
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
        <td>Počet odpracovaných hodín: </td> <td>itt lesz egy olyan h student mennyi orat dolgozott</td>
    </tr>
    <tr>
        <td>Meno a priezvisko CEO</td><td>meno...</td>
    </tr>
    <tr>
        <td>Potrvdil CEO</td><td>Ano/Nie</td>
    </tr>
</table>

<div>
    <h4>Hodnotenie študenta:</h4>
    <p>ide jön az értékelés...</p>
</div>

</body>

</html>


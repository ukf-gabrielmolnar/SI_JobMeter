<html>
<header>
    <h1> hi </h1>
</header>
<body>

<a>Meno studenta: {{ $user->firstname." ".$user->lastname }}</a><br>
<a>{{ $year->year." ".$sp->study_program }}</a><br>
<br>
<a>Nadriadena osoba: {{ $ppp->firstname." ".$ppp->lastname }} email: {{ $ppp->email }}</a><br>
<br>
<a>Pracovisko: {{ $company->name }}</a><br>
<a>Adresa pracovisku: {{ $company->address }}</a><br>
<a>Kontaktna osoba: {{ $contact->firstname." ".$contact->lastname }} {{ $contact->email }} {{ $contact->tel }}</a><br>
<br>
<a>Pozicia v pracovisku: {{ $job->job_type }}</a><br>
<a>Od: {{ $contract->od }}</a><br>
<a>Do: {{ $contract->do }}</a><br>
<br>
<a>itt lesz egy olyan h student mennyi orat dolgozott, es h ala e irta a CEO</a><br>
<a>ceo neve aki confirmolja h ott dolgozott</a><br>
<br>

<table>

</table>

</body>
<footer>

</footer>

</html>


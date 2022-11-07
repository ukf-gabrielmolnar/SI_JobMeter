@extends('layouts.main')
@section('content')

    <form action="" id="companyform">
        <label for="companies" class="form-label">Firma</label>
        <select class="form-select form-select-lg mb-3 text-dark" id="companies" name="company">
            <option value="" selected disabled hidden>Choose here</option>
        </select>
    </form>

    <p id = "proba"></p>

    <form action="" id="jobform">
        <label for="jobs" class="form-label">Firma</label>
        <select class="form-select form-select-lg mb-3 text-dark" id="jobs" name="job">
            <option value="" selected disabled hidden>Choose here</option>
        </select>
    </form>
@endsection

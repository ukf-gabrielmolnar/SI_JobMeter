@extends('layouts.main')
@section('content')

    <div style="align-content: center">
        <form action="" id="companyform">
            <label for="companies" class="form-label">Firma</label>
            <select class="form-select form-select-lg mb-3 text-dark" id="companies" name="company">
                <option value="" selected disabled hidden>Vybrať</option>
            </select>
        </form>

        <form action="" id="jobform">
            <label for="jobs" class="form-label">Typ práce</label>
            <select class="form-select form-select-lg mb-3 text-dark" id="jobs" name="job">
                <option value="" selected disabled hidden>Vybrať</option>
            </select>
        </form>
    </div>
@endsection

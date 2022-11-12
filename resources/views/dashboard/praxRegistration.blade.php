@extends('layouts.main')
@section('content')
    @auth
    <form method="post" action="{{ route('contract.store') }}">
        @csrf


        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--UserID hidden!-->
        <input hidden id="users_id" name="users_id" value="{{auth()->user()->id}}">

        <div class="h6" id="companyform">
            <label for="companies" class="form-label">Firma</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies" name="companies">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </div>

        <div class="h6" id="jobform">
            <label for="jobs_id" class="form-label">Job</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="jobs_id" name="jobs_id">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </div>

        <div class="h6" id="contactform">
            <label for="contacts_id" class="form-label">Contract</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="contacts_id" name="contacts_id">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </div>

        <p id="probaC"> </p>

        <div id="timePickerForm">
            <label class="h6" for="od">Datum do</label>
            <p></p>
            <input type="date" id="od" name="od" value='<?php echo date('Y-m-d');?>'>
            <p></p>
            <label class="h6" for="do">Datum do</label>
            <p></p>
            <input type="date" id="do" name="do" value='<?php echo date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));?>'>
        </div>

        <br>
        <button id="submitButtonPrax" class="btn bg-secondary text-bg-danger" type="submit">Submit</button>
    </form>
    @endauth

@endsection

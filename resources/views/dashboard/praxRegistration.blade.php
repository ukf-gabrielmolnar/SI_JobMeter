@extends('layouts.main')
@section('content')

    <form>
        <form class="h6" action="" id="companyform">
            <label for="companies" class="form-label">Firma</label>
            <select class="form-select form-select-lg mb-3 text-dark" id="companies" name="company">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </form>


        <form class="h6" action="" id="jobform">
            <label for="jobs" class="form-label">Job</label>
            <select class="form-select form-select-lg mb-3 text-dark" id="jobs" name="job">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </form>

        <form class="h6" action="" id="contactform">
            <label for="contacts" class="form-label">Contract</label>
            <select class="form-select form-select-lg mb-3 text-dark" id="contacts" name="contact">
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </form>

        <p id="probaC"> </p>

        <div id="timePickerForm">
            <label class="h6" for="start">Datum do</label>
            <p></p>
            <input type="date" id="start" value='<?php echo date('Y-m-d');?>'>
            <p></p>
            <label class="h6" for="stop">Datum do</label>
            <p></p>
            <input type="date" id="stop" value='<?php echo date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));?>'>
        </div>

        <br>
        <a id="submitButtonPrax" class="btn bg-secondary text-bg-danger" type="submit">Submit</a>
    </form>

@endsection

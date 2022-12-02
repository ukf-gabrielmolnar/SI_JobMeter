@extends('layouts.main')
@section('content')

@if (auth()->user())

    @if (auth()->user()->inRole('student'))

        @if(auth()->user()->years_id == null)
            <h1> ide mar dizajnoltok vlm szepet :)</h1>
            <a class="btn-danger" href="/userSettings"> GOMB Settingsre</a>
        @else
    <form method="post" action="{{ route('contract.store') }}">
        @csrf

        <!--UserID hidden!-->
        <input hidden id="users_id" name="users_id" value="{{auth()->user()->id}}">

        <div class="h6" id="companyform">
            <label for="companies" class="form-label">Firma</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="companies" name="companies" required>
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </div>

        <div class="h6" id="jobform">
            <label for="jobs_id" class="form-label">Job</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="jobs_id" name="jobs_id" required>
                <option value="" selected disabled hidden>Choose here</option>
            </select>
        </div>

        <div class="h6" id="contactform">
            <label for="contacts_id" class="form-label">Contact</label>
            <select class="form-select form-select-lg mb-3 text-dark custom-select" id="contacts_id" name="contacts_id" required>
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
        <button id="submitButtonPrax" style="width: 100%" class="btn" type="submit">Submit</button>
    </form>
    @endif

    <script>

        var fades = [true,true,true];
        var selectedCompanyId = 1;
        var selectedJobId = 1;
        var selectedContractId = 1;


        document.getElementById('jobform').style.display = 'none';
        document.getElementById('contactform').style.display = 'none';
        document.getElementById('timePickerForm').style.display = 'none';
        document.getElementById('submitButtonPrax').style.display = 'none';


        window.onload = function () {

            var companies = $('#companies');
            var data = @json($companies);
            $.each(data, function (index, company) {
                companies.append('<option value="' + company.id + '">' + company.name + '</option>');
            });


            $('#companies').on('change', function () {
                var jobForm = $('#jobform');

                if (fades[0]) {
                    jobForm.fadeToggle(1000);
                    fades[0] = false;
                }

                $("#jobs_id").empty();
                $selectedCompanyId = $(this).children(":selected").attr("value");

                var jobs = $('#jobs_id');
                var data = @json($jobs);
                jobs.append('<option value="" selected disabled hidden>Choose here</option>');
                $.each(data, function (index, job) {
                    if (job.companies_id == $selectedCompanyId) {
                        jobs.append('<option value="' + job.id + '">' + job.job_type + '</option>');
                    }
                });
            });

            $('#jobs_id').on('change', function () {
                var contactForm = $('#contactform');

                if (fades[1]) {
                    contactForm.fadeToggle(1000);
                    fades[1] = false;
                }

                $("#contacts_id").empty();
                selectedJobId = $(this).children(":selected").attr("value");

                var contacts = $('#contacts_id');
                var data = @json($contacts);
                contacts.append('<option value="" selected disabled hidden>Choose here</option>');
                $.each(data, function (index, contact) {
                    if (contact.companies_id == $selectedCompanyId) {
                        contacts.append('<option value="' + contact.id + '">' + contact.firstname + '</option>');
                    }
                });
            });

            $('#contacts_id').on('change', function () {
                var timePickerForm = $('#timePickerForm');
                var submitButtonPrax = $('#submitButtonPrax');

                if (fades[2]) {
                    timePickerForm.fadeToggle(1000);
                    submitButtonPrax.fadeToggle(2500);
                    fades[2] = false;
                }
            });
        }
    </script>

    @else

        @include('nopermission')

    @endif

@else

    <h1 style="text-align: center;">You are not logged in!</h1>

@endif

@endsection

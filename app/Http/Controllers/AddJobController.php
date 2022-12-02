<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Study_program;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContractRequest;
use App\Models\Company;
use App\Models\Contact;

class AddJobController extends Controller
{
    public function index(){
        $study_programs = Study_program::all();
        $year_id = Year::find(auth()->user()->years_id);
        $SP_id = Study_program::find($year_id);

        return view('job.jobAdd', compact('study_programs','SP_id'));
    }

    public function saveData(StoreContractRequest $request){
        $company_name = $request->company_name;
        $comapny_address = $request->company_address;

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $phone = $request->phone;
        $emial = $request->email;

        $job_type = $request->job_type;
        $study_programs_id = $request->study_programs_id;

        $company = new Company();
        $company->name = $company_name;
        $company->address = $comapny_address;
        $company->save();

        $contact = new Contact();
        $contact->firstname = $firstname;
        $contact->lastname = $lastname;
        $contact->email = $emial;
        $contact->tel = $phone;
        $contact->companies_id = $company->id;
        $contact->save();

        $job = new Job();
        $job->job_type = $job_type;
        $job->companies_id = $company->id;
        $job->study_programs_id = $study_programs_id;
        $job->save();

        $popupMessage = "successJobAdd";

        //return redirect()->route('dashboard.index');
        return view('dashboard.index', compact('popupMessage'));
    }
}

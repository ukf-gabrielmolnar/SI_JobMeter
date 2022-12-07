<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contract;
use App\Models\FeedbackReport;
use App\Models\Job;
use App\Models\Record;
use App\Models\Study_program;
use App\Models\User;
use App\Models\Company;
use App\Models\Year;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $popupMessage = '';

        $jobs = Job::all();
        $companies = Company::all();
        $contracts = Contract::all();
        $feedbackReports = FeedbackReport::all();
        $records = Record::all();
        $users = User::all();

        return view('dashboard.index', compact('popupMessage', 'jobs', 'companies',
            'contracts','feedbackReports','records','users'));
    }

    public function praxRegistration(){
        $companyArray = [];
        $jobArray = [];
        $contactArray = [];

        foreach (Year::all() as $year){
            if(auth()->user()->years_id == $year->id){

                foreach (Study_program::all() as $sp){
                    if($year->study_programs_id == $sp->id){

                        foreach (Job::all() as $job){
                            if($job->study_programs_id == $sp->id && $job->approved == 1){
                                array_push($jobArray, $job);

                                foreach (Company::all() as $company){
                                    if($job->companies_id == $company->id && $company->approved == 1){
                                        array_push($companyArray,$company);

                                        foreach (Contact::all() as $contact){
                                            if($contact->companies_id == $company->id){
                                                array_push($contactArray, $contact);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $companies = array_unique($companyArray);
        $jobs = array_unique($jobArray);
        $contacts = array_unique($contactArray);

        return view('prax.praxRegistration', compact('companies','jobs','contacts'));
    }

    public function tableview(){
        return view('admin.adminView');
    }

    public function saveRecord(Request $request){

        Record::create($request->all());

        $popupMessage = 'successAddRecord';

        $jobs = Job::all();
        $companies = Company::all();
        $contracts = Contract::all();
        $feedbackReports = FeedbackReport::all();
        $records = Record::all();

        return view('dashboard.index', compact('popupMessage', 'jobs', 'companies', 'contracts','feedbackReports','records'));


    }

}

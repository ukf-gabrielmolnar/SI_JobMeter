<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contract;
use App\Models\FeedbackReport;
use App\Models\Job;
use App\Models\Record;
use App\Models\User;
use App\Models\Company;
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
        $companies = Company::all();
        $jobs = Job::all();
        $contacts = Contact::all();

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

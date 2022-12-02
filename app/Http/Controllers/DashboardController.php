<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index(){
        $popupMessage = '';
        return view('dashboard.index', compact('popupMessage'));
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
}

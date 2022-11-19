<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Contract;
use App\Models\Job;
use App\Models\Study_program;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.index');
    }

    public function showusers(){
        $users = User::all();
        $study_programs = Study_program::all();
        $contracts = Contract::all();
        $jobs = Job::all();
        $companies = Company::all();
        return view('manager.show_users', compact('users','study_programs','jobs','contracts','companies'));
    }

    public function showcompanies(){
        $companies = Company::all();
        return view('manager.show_companies', compact('companies'));
    }

    public function showcontracts(){
        $jobs = Job::all();
        $users = User::all();
        $contracts = Contract::all();
        $companies = Company::all();
        $contacts = Contact::all();
        return view('manager.show_contracts', compact('jobs','users','contracts','contacts','companies'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Contract;
use App\Models\Job;
use App\Models\Study_program;
use App\Models\User;
use App\Models\User_role;
use App\Models\Year;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        $popupMessage = '';
        return view('dashboard.index', compact('popupMessage'));
    }

    public function showusers(){
        $users = User::all();
        $study_programs = Study_program::all();
        $contracts = Contract::all();
        $jobs = Job::all();
        $companies = Company::all();
        $years = Year::all();
        return view('manager.show_users', compact('users','study_programs','jobs','contracts','companies','years'));
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
        $roles = User_role::all();
        return view('manager.show_contracts', compact('jobs','users','contracts','companies','roles'));
    }

    public function showcertificates(){
        $users = User::all();
        $jobs = Job::all();
        $contracts = Contract::all();
        $contacts = Contact::all();
        $companies = Company::all();
        $roles = User_role::all();
        return view('manager.show_certificates', compact('users', 'jobs', 'contracts', 'contacts', 'companies','roles'));
    }

    public function addsupervisor(){
        $jobs = Job::all();
        $users = User::all();
        $contracts = Contract::all();
        $companies = Company::all();
        $roles = User_role::all();
        return view('manager.add_supervisor', compact('jobs','users','contracts','companies','roles'));
    }


}

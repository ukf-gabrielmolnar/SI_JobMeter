<?php

namespace App\Http\Controllers;

use App\Models\Company;
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

        return view('manager.show_users', compact('users','study_programs'));
    }

    public function showcompanies(){
        $companies = Company::all();
        return view('manager.show_companies', compact('companies'));
    }
}

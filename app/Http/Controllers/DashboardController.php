<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function praxRegistration(){
        return view('dashboard.praxRegistration');
    }

    public function tableview(){
        return view('admin.adminView');
    }


    public function companies(): JsonResponse{
        $companies = Company::all();

        return response()->json($companies);
    }

    public function jobs(): JsonResponse{
        $jobs = Job::all();

        return response()->json($jobs);
    }

    public function contacts(): JsonResponse{
        $contacts = Contact::all();

        return response()->json($contacts);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContractRequest;
use App\Models\Company;
use App\Models\Contact;

class AddJobController extends Controller
{
    public function index(){

        return view('job.jobAdd');
    }

    public function saveData(StoreContractRequest $request){
        //dd($request);
        $company_name = $request->comapny_name;
        $comapny_address = $request->comapny_address;

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $phone = $request->phone;
        $emial = $request->email;

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
        dd($contact);

        //return redirect()->route('home');
    }
}

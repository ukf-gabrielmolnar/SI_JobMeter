<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Job;
use App\Models\Study_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $jobs = Job::all();
        $sps = Study_program::all();
        return view('admin.adminViewCompanies',compact('companies','jobs','sps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $company = Company::find($request->company_id);
        if($request->action == 1){

            $company->approved = $request->approved;
        }else{
            $company->name = $request->name;
            $company->address = $request->address;



        }
        $company->save();
        $companies = Company::all();
        $jobs = Job::all();
        $sps = Study_program::all();
        return view('admin.adminViewCompanies',compact('companies','jobs','sps'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('jobs')->where('companies_id', $request->id)->delete();
        DB::table('contacts')->where('companies_id', $request->id)->delete();
        $company = Company::find($request->id);
        $company->delete();

        return redirect()->route('adminViewCompanies');
    }
}

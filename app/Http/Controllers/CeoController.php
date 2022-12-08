<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCeoRequest;
use App\Http\Requests\UpdateCeoRequest;
use App\Models\Ceo;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Job;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class CeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $companies = Company::all();
        $contracts = Contract::all();
        $records = Record::all();
        $jobs = Job::all();
        return view('ceo.ceoView', compact('users','companies', 'contracts', 'records', 'jobs'));
    }

    public function hoursindex(Request $request){
        $users = User::all();
        $companies = Company::all();
        $contracts = Contract::all();

        $jobs = Job::all();
        return view('ceo.ceoViewHours',compact('users','companies', 'contracts', 'jobs'));
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
     * @param  \App\Http\Requests\StoreCeoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCeoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ceo  $ceo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $contracts = Contract::find($request->contract_id);
        $records = Record::all();
        return view('ceo.ceoViewHours', compact('contracts','records'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ceo  $ceo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $record = Record::find($request->record_id);

        $record->approved = $request->approved;
        $record->save();

        return redirect()->route('ceo.show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCeoRequest  $request
     * @param  \App\Models\Ceo  $ceo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCeoRequest $request, Ceo $ceo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ceo  $ceo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ceo $ceo)
    {
        //
    }
}

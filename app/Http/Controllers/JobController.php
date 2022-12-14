<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Study_program;
use Illuminate\Http\Request;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        $companies = Company::all();
        $study_programs = Study_program::all();

        return view('job.jobList', compact('jobs','companies','study_programs'));
    }

    public function adminView(){
        $companies = Company::all();
        $jobs = Job::all();
        $sps = Study_program::all();
        return view('admin.adminViewJobs',compact('companies','jobs','sps'));
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
     * @param  \App\Http\Requests\StoreJobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $job = Job::find($request->job_id);
        if($request->action == 1){

            $job->approved = $request->approved;
        }else{
            $job->job_type = $request->job_type;
            $job->companies_id = $request->companies_id;
            $job->study_programs_id = $request->study_programs_id;



        }
        $job->save();
        $companies = Company::all();
        $jobs = Job::all();
        $sps = Study_program::all();
        return view('admin.adminViewJobs',compact('companies','jobs','sps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobRequest  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $job = Job::find($request->id);
        $job->delete();
        return redirect()->route('adminViewJobs');
    }
}

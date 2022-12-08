<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\FeedbackReport;
use App\Http\Requests\StoreFeedbackReportRequest;
use App\Http\Requests\UpdateFeedbackReportRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class FeedbackReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::all();
        $jobs = Job::all();
        $users = User::all();

        $popupMessage = "";

        return view('ppp.feedbackContracts', compact('contracts', 'jobs','users','popupMessage'));
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedbackReport = new FeedbackReport();

        $feedbackReport->subject = $request->subject;
        $feedbackReport->text = $request->text;
        $feedbackReport->contracts_id = $request->contracts_id;
        $feedbackReport->users_id = $request->users_id;

        $feedbackReport->save();

        $contracts = Contract::all();
        $jobs = Job::all();
        $users = User::all();

        $popupMessage = "successPPPFeedback";

        return view('ppp.feedbackContracts', compact('contracts', 'jobs','users','popupMessage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeedbackReport  $feedbackReport
     * @return \Illuminate\Http\Response
     */
    public function show(FeedbackReport $feedbackReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeedbackReport  $feedbackReport
     * @return \Illuminate\Http\Response
     */
    public function edit(FeedbackReport $feedbackReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedbackReportRequest  $request
     * @param  \App\Models\FeedbackReport  $feedbackReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedbackReportRequest $request, FeedbackReport $feedbackReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeedbackReport  $feedbackReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeedbackReport $feedbackReport)
    {
        //
    }

    public function showfeedbacks(){
        $feedbacks = FeedbackReport::all();
        $contracts = Contract::all();
        $users = User::all();
        $jobs = Job::all();
        return view('manager.show_feedback', compact('feedbacks','contracts','users','jobs'));
    }
}

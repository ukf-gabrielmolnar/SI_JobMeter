<?php

namespace App\Http\Controllers;

use App\Models\Feedback_Report;
use App\Http\Requests\StoreFeedback_ReportRequest;
use App\Http\Requests\UpdateFeedback_ReportRequest;

class FeedbackReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreFeedback_ReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedback_ReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback_Report  $feedback_Report
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback_Report $feedback_Report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback_Report  $feedback_Report
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback_Report $feedback_Report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedback_ReportRequest  $request
     * @param  \App\Models\Feedback_Report  $feedback_Report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedback_ReportRequest $request, Feedback_Report $feedback_Report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback_Report  $feedback_Report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback_Report $feedback_Report)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Job;
use App\Models\Student_feedback;
use App\Http\Requests\StoreStudent_feedbackRequest;
use App\Http\Requests\UpdateStudent_feedbackRequest;

class StudentFeedbackController extends Controller
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

        return view('feedback.feedback', compact('contracts', 'jobs'));
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
     * @param  \App\Http\Requests\StoreStudent_feedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent_feedbackRequest $request)
    {
        Student_feedback::create($request->all());

        $popupMessage = "successStudentFeedback";

        //return redirect()->route('dashboard.index');
        return view('dashboard.index', compact('popupMessage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student_feedback  $student_feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Student_feedback $student_feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student_feedback  $student_feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Student_feedback $student_feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudent_feedbackRequest  $request
     * @param  \App\Models\Student_feedback  $student_feedback
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudent_feedbackRequest $request, Student_feedback $student_feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student_feedback  $student_feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student_feedback $student_feedback)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\FeedbackReport;
use App\Models\Job;
use App\Models\Record;
use App\Models\Study_program;
use App\Models\User;
use App\Models\Year;
use http\Env\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\RequestContext;
use PDF;

class ContractController extends Controller
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
        $filter1 = 1;
        $filter2 = 1;

        return view('ppp.unapprovedContracts', compact('contracts', 'jobs','users','filter1', 'filter2'));
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
     * @param  \App\Http\Requests\StoreContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractRequest $request)
    {
        $contract = new Contract();

        $contract->users_id = $request->users_id;
        $contract->jobs_id = $request->jobs_id;
        $contract->contacts_id = $request->contacts_id;

        $contract->od = $request->od;
        $contract->do = $request->do;

        $contract->save();

        $popupMessage = "successPraxReg";

        $jobs = Job::all();
        $companies = Company::all();
        $contracts = Contract::all();
        $feedbackReports = FeedbackReport::all();
        $records = Record::all();

        return view('dashboard.index', compact('popupMessage', 'jobs', 'companies', 'contracts','feedbackReports','records'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, Contract $contract)
    {
        $contract = Contract::find($request->id);
        $contract->update($request->all());
        $contract->save();

        return $this->applyFilters($request);
    }

    public function saveSupervisor(Request $request){

        $contract = Contract::find($request->id);
        $contract->ppp_id = $request->ppp_id;
        $contract->save();


        $jobs = Job::all();
        $users = User::all();
        $contracts = Contract::all();
        $companies = Company::all();
        return view('manager.add_supervisor', compact('jobs','users','contracts','companies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }

    public function showArchive(\Illuminate\Http\Request $request){
        $contracts = Contract::all();
        $jobs = Job::all();
        $users = User::all();

        return view('ppp.archiveContracts', compact('contracts', 'jobs','users'));
    }

    public function savePDF(\Illuminate\Http\Request $request){

        $contract = Contract::find($request->contract_id);
        $user = User::find($request->user_id);
        $ppp = User::find($request->ppp_id);
        $year = Year::find($user->years_id);
        $sp = Study_program::find($year->study_programs_id);
        $job = Job::find($contract->jobs_id);
        $company = Company::find($job->companies_id);
        $contact = Contact::find($contract->contacts_id);
        $feedbackR = FeedbackReport::all();
        $records = Record::all();

        if($request->show_form == "pdf"){
            $pdf = PDF::loadView('ppp.archivePDFView', compact('contract',
                'user','ppp','year','sp','job','company','contact','feedbackR','records'));

            return $pdf->download($user->firstname."_". $user->lastname."_archive.pdf");
        }else{
            return view('ppp.archivePDFView', compact('contract',
                'user','ppp','year','sp','job','company','contact','feedbackR','records'));
        }
    }

    public function applyFilters(\Illuminate\Http\Request $request){
        $contracts = Contract::all();

        switch ($request->filter1){
            case 1:
                break;
            case 2:
                $help = [];

                foreach ($contracts as $contract){
                    if ($contract->approved == 1){
                        array_push($help, $contract);
                    }
                }

                $contracts = $help;
                break;
            case 3:
                $help = [];

                foreach ($contracts as $contract){
                    if ($contract->approved == 0){
                        array_push($help, $contract);
                    }
                }

                $contracts = $help;

                break;
        }

        switch ($request->filter2){
            case 1:
                break;
            case 2:
                $help = [];

                foreach ($contracts as $contract){
                    if ($contract->closed == 1){
                        array_push($help, $contract);
                    }
                }

                $contracts = $help;
                break;
            case 3:
                $help = [];

                foreach ($contracts as $contract){
                    if ($contract->closed == 0){
                        array_push($help, $contract);
                    }
                }

                $contracts = $help;

                break;
        }

        $jobs = Job::all();
        $users = User::all();

        $filter1 = $request->filter1;
        $filter2 = $request->filter2;

        return view('ppp.unapprovedContracts', compact('contracts', 'jobs','users','filter1', 'filter2'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Job;
use App\Models\User;
use http\Env\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\RequestContext;

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

        $contract->od = $request->od;
        $contract->do = $request->do;

        $contract->save();

        return redirect()->route('home');
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
     * @param  \App\Http\Requests\UpdateContractRequest  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract = Contract::find($request->id);
        $contract->update($request->all());
        $contract->save();

        return $this->applyFilters($request);
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


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

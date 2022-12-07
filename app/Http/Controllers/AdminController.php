<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Contract;
use App\Models\Job;
use App\Models\Study_program;
use App\Models\User_role;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Models\User;
use function PHPUnit\Framework\at;

class AdminController extends Controller
{
    public function index(){


        $users = User::paginate(15);
        $companies = Company::all();
        $years = Year::all();
        $study_programs = Study_program::all();

        return view('admin.adminView', compact('users', 'companies','years','study_programs'));
    }

    public function contractsindex(){
        $contracts = Contract::all();
        $users = User::all();
        $jobs = Job::all();
        $contacts = Contact::all();
        $filter = 1;
        return view('admin.adminViewContracts', compact('contracts','users','jobs','contacts','filter'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('adminView');
    }


    public function edit(Request $request) {
        $requestArray =$request->except('user_id','firstname','lastname','email','tel','companies_id','years_id');
        $requestArray = array_values($requestArray);

        $user = User::find($request->user_id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->companies_id = $requestArray[0];
        $user->years_id = $requestArray[1];

        $user->save();

        $users = User::paginate(15);
        $companies = Company::all();
        $years = Year::all();
        $study_programs = Study_program::all();
        return redirect()->route('adminView');

    }

    public function filter(Request $request)
    {
        $companies = Company::all();
        $years = Year::all();
        $study_programs = Study_program::all();
        $users = User::All();

        $user_roles = User_role::all();
        $filter = $request->filter;
        $help = [];

        if ($filter != 1){
            foreach ($user_roles as $role){
                if ($role->role_id == $filter-1){
                    foreach ($users as $user){
                        if($role->user_id == $user->id){
                            array_push($help, $user);
                        }
                    }
                }
            }
            $users = $help;
        }

        return view('admin.adminView', compact('users', 'companies','years','study_programs','filter'));
    }

    public function yearFilter(Request $request){

        if($request->filter != 1){

            $help = [];
            $date = new \DateTime();
            switch ($request->filter){
                case 2:
                    $date = new \DateTime('2022-09-01');
                    break;
                case 3:
                    $date = new \DateTime('2023-09-01');
                    break;
            }

            foreach (Contract::all() as $contract){
                $contractStart = new \DateTime($contract->od);
                if ($date < $contractStart){
                    $diff = $date->diff($contractStart);
                    if($diff->days < 365){
                        array_push($help, $contract);
                    }
                }
            }

            $contracts = $help;
            $users = User::all();
            $jobs = Job::all();
            $contacts = Contact::all();
            $filter = $request->filter;
            return view('admin.adminViewContracts', compact('contracts','users','jobs','contacts','filter'));

        }else{
            $contracts = Contract::all();
            $users = User::all();
            $jobs = Job::all();
            $contacts = Contact::all();
            $filter = $request->filter;
            return view('admin.adminViewContracts', compact('contracts','users','jobs','contacts','filter'));
        }
    }

    public function delete(Request $request){
        $contract = Contract::find($request->id);
        $contract->delete();
        return redirect()->route('admin.contractsindex');
    }
}

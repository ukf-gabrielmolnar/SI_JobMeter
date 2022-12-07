<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        $filter = 1;

        return view('admin.adminView', compact('users', 'companies','years','study_programs','filter'));
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
}

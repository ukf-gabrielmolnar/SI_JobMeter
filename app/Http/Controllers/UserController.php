<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Company;
use App\Models\Info;
use App\Models\Study_program;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect()->route('dashboard.index');
    }

    public function login(){

        return view('login.login');
    }

    public function auth(LoginRequest $request){
        $data = $request->validated();

        if (auth()->attempt($data)) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login.login');

    }

    public function profileInfo(){
        $study_programs = Study_program::all();
        $year = Year::all();
        $company = Company::all();
        return view('user.userInfo', compact('study_programs','year', 'company'));
    }

    public function profileSettings(){
        $study_programs = Study_program::all();
        $year = Year::all();
        $company = Company::all();
        return view('user.userSettings', compact('study_programs','year', 'company'));
    }

    public function update(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $user->update($request->all());
        $study_programs = Study_program::all();

        return redirect()->route('user.userInfo', compact('study_programs'));
    }
}

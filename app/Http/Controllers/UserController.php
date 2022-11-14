<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Study_program;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect()->route('home');
    }

    public function login(){

        return view('login.login');
    }

    public function auth(LoginRequest $request){
        $data = $request->validated();

        if (auth()->attempt($data)) {
            return redirect()->route('home');
        }

        return redirect()->route('login.login');

    }

    public function profileInfo(){
        $study_programs = Study_program::all();
        return view('user.userInfo', compact('study_programs'));
    }

    public function profileSettings(){
        $study_programs = Study_program::all();
        return view('user.userSettings', compact('study_programs'));
    }
}

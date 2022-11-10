<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginStaff(){

        return view('login.login');
    }

    public function authStaff(LoginRequest $request){
        $data = $request->validated();

        if (auth()->attempt($data)) {
            return redirect()->route('home');
        }

        return redirect()->route('login.login');

    }
}

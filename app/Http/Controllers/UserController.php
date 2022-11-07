<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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

        return redirect()->route('user.login');

    }
}

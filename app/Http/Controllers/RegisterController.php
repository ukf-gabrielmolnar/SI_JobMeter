<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStaffRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerUser(){
        return view('register.registerUser');
    }

    public function storeUser(RegisterStaffRequest $request){

        $data = $request->validated();

        $user = new \App\Models\User();
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()->route('login.login');
    }

}

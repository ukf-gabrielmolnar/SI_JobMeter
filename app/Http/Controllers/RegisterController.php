<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStaffRequest;
use App\Models\RoleRequest;
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

        $request_role = new RoleRequest();
        $request_role->users_id = $user->id;
        $request_role->current_role = 4;
        $request_role->requested_role = $request->role_id;
        $request_role->approved = 0;
        $request_role->save();

        return redirect()->route('login.login');
    }

}

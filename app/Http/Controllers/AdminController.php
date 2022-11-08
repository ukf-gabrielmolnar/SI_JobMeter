<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){

        $users = User::paginate(15);

        return view('admin.adminView', compact('users'));
    }

    public function asd(){
        dd();
    }

    public function destroy(User $user)
    {
        dd($user);
        $user->delete();
        return redirect()->route('admin.adminView');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleRequest;
use App\Http\Requests\StoreRoleRequestRequest;
use App\Http\Requests\UpdateRoleRequestRequest;
use App\Models\User;
use App\Models\User_role;

class RoleRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_requests = RoleRequest::all();
        $users = User::all();
        $roles = Role::all();

        return view('roleRequest.index', compact('role_requests','roles','users'));
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
     * @param  \App\Http\Requests\StoreRoleRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleRequest  $roleRequest
     * @return \Illuminate\Http\Response
     */
    public function show(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleRequest  $roleRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequestRequest  $request
     * @param  \App\Models\RoleRequest  $roleRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequestRequest $request, RoleRequest $roleRequest)
    {

        if ($request->action == 'approve'){
            $user_roles = new User_role();

            $user_roles->user_id = $request->userID;
            $user_roles->role_id = $request->roleID;
            $user_roles->save();
        }

        $roleRequest::find($request->ID)->delete();

        $role_requests = RoleRequest::all();
        $users = User::all();
        $roles = Role::all();

        return view('roleRequest.index', compact('role_requests','roles','users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleRequest  $roleRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleRequest $roleRequest)
    {
        //
    }
}

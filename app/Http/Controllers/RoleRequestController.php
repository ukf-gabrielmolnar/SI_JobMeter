<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;
use App\Http\Requests\StoreRoleRequestRequest;
use App\Http\Requests\UpdateRoleRequestRequest;

class RoleRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roleRequest.index');
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
        //
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

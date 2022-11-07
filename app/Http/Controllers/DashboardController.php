<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function praxRegistration(){
        return view('dashboard.praxRegistration');
    }

    public function companies(): JsonResponse{
        $companies = Company::all();

        return response()->json($companies);
    }

    public function jobs(): JsonResponse{
        $jobs = [
          [
              'id'
          ]
        ];

        return response()->json($jobs);
    }

    public function members(): JsonResponse{
        $members = [
            [
                'id'=> 1,
                'name' => 'Laci'
            ],
            [
                'id'=> 2,
                'name' => 'Gabi',
            ]
        ];
        return response()->json($members);
    }
}

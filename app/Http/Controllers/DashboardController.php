<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function praxRegistration(){
        return view('dashboard.praxRegistration');
    }

    public function companies(): JsonResponse{
        $companies = [
            [
                'id'=>1,
                'name'=>'fasz',
                'address'=>'fasztudja'
            ],
            [
                'id'=>2,
                'name'=>'fasz2',
                'address'=>'fasztudja'
            ],
        ];

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

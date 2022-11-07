<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
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

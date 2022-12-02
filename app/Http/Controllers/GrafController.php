<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use DataTables;
use Validator;
use Session;
use Khill\Lavacharts\Lavacharts;

class GrafController extends Controller
{
    public function years_graph()
    {
        $result = DB::select(DB::raw("SELECT year as ev, COUNT(*) as result FROM years
                                    INNER JOIN users ON (users.years_id = years.id) GROUP BY ev;
                                    "));
        $chartData = "";
        foreach($result as $list) {
            $chartData.="['".$list->ev."', ".$list->result."],";
        }
        $arr['chartData']=rtrim($chartData, ",");

        return view('graf.graf_1', $arr);
    }

    public function companies_graph()
    {
        $result = DB::select(DB::raw("SELECT name as ceg, COUNT(*) as result FROM users
                                    INNER JOIN companies ON (users.companies_id = companies.id) GROUP BY ceg;"));
        $chartData = "";
        foreach($result as $list) {
            $chartData.="['".$list->ceg."', ".$list->result."],";
        }
        $arr['chartData']=rtrim($chartData, ",");

        return view('graf.graf_2', $arr);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    //

    public function index()
    {

        // $diseases=Report::latest()->pluck('diseaseName')->unique()->toArray();
        $diseases=DB::table('reports')
             ->select(DB::raw('count(*) as diseaseCount, diseaseName'))
             ->groupBy('diseaseName')
             ->orderBy('diseaseCount','DESC')
             ->get();
        // dd($diseases);
        return view('disease.lists',compact('diseases'));
    }

    public function place(Request $request)
    {
        $reportCount=Report::where('diseaseName','LIKE','%'.$request->diseaseName.'%')->count();
         $diseaseName=$request->diseaseName;
        $districts=DB::table('reports')
             ->select(DB::raw('count(*) as diseaseCount, location'))
             ->where('diseaseName','like','%'.$diseaseName.'%')
             ->groupBy('location')
             ->get()->sortByDesc('diseaseCount');
            
        return view('disease.place',compact('districts','reportCount','diseaseName'));
    }
}

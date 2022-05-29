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

        $diseases=DB::table('reports')
             ->select(DB::raw('count(*) as diseaseCount, diseaseName'))->latest();
             if(request('search'))
        {
            $diseases->where('diseaseName','LIKE','%'.request('search').'%');
        }
            $diseases->groupBy('diseaseName')->orderBy('diseaseCount','DESC');

        return view('disease.lists',['diseases'=>$diseases->paginate(5)]);
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

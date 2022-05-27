<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Districts;
use Illuminate\Http\Request;
use Auth;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reports.index',[
            'reports' => $this->getReports()
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $locations= Districts::all();
        return view('reports.create')->with('locations',$locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->reportImage);
        $request->validate([
            'reportName' => 'required',
            'diseaseName' => 'required',  
            'location' => 'required',
            'reportDescription'=>'required',
            'reportImage' => 'required|image|mimetypes:image/jpeg,image/png',
            ]);
            
            $input = $request->all();
            $input['user_id']=Auth::user()->id;
            if ($request->hasFile('reportImage')) {
                $file = $request->file('reportImage');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/images/';
                $filename = $file_extension;
                $request->file('reportImage')->move($destination_path, $filename);
                $input['reportImage'] = $filename;
            }
        Report::create($input);
        return redirect('reports')->with('success','Report added successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //  
        if($report->user_id==Auth::user()->id)
        {
             return view('reports.show', compact('report'));
        }
       else
       {
           $user=User::find($report->user_id);
           $friendship=$user->getFriendShip(Auth::user());
           if($friendship)
         {
             if($friendship->status=="confirmed")
             {
                return view('reports.show',compact('report'));
             }
             else
             {
                  abort(403, 'Unauthorized action.');
             }
             
         }
         else
         {
              abort(403, 'Unauthorized action.');
         }

       }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
         $locations= Districts::all();
        return view('reports.edit',compact('report','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
        // if($request->reportImage!=null)
        // {
            $request->validate([
            'reportName' => 'required',
            'diseaseName' => 'required',  
            'location' => 'required',
            'reportDescription'=>'required',
            'reportImage' => 'image|mimetypes:image/jpeg,image/png',
            ]);

            $input = $request->all();
            $input['user_id']=Auth::user()->id;
            if ($request->hasFile('reportImage')) {
                $file = $request->file('reportImage');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/images/';
                $filename = $file_extension;
                $request->file('reportImage')->move($destination_path, $filename);
                $input['reportImage'] = $filename;
            }
        // }
        // else
        // {
        //      $request->validate([
        //     'reportName' => 'required',
        //     'diseaseName' => 'required',  
        //     'location' => 'required',
        //     'reportDescription'=>'required',
        //     ]);
        //      $input = $request->all();
        // }
       
            
           
        $report->update($input);
        return redirect('reports')->with('success','Report updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
        $report->delete();
        return redirect()->route('reports.index')->with('success','Report deleted successfully');
    }

    protected function getReports()
    {
        $reports = Auth::user()->reports()->latest();
        if(request('search'))
        {
            $reports
                ->whereRaw('CONCAT(`reportName`,`diseaseName`) LIKE "%'.request('search').'%"');
        }
        if(request('startDate'))
        {
            $reports->where('created_at','>=',request('startDate'));
        }
        if(request('endDate'))
        {
            $reports->where('created_at','<=',request('endDate'));
        }

        
        return $reports->paginate(8);

    }
}

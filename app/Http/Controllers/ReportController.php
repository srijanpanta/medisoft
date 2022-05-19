<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Districts;
use Illuminate\Http\Request;

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
        $reports = Report::latest()->Paginate(8);
        return view('reports.index',compact('reports'));
        
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
        return view('reports.show', compact('report'));
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
    }
}

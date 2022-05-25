<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Models\Reports;
use Illuminate\Http\Request;
use Exception;
use Auth;

class FriendshipController extends Controller
{
     public function __construct()
    {
        $this->middleware('can:isDoctor', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view('doctors.friends',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=new User;
        return view ('doctors.friendRequest',compact('user'));
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
        // $user=dd(Friendship::where('second_user',$request->id)->where('first_user',Auth::user()->id));
        $input = $request->all();
        $input['first_user']=Auth::user()->id;
        $input['acted_user']=Auth::user()->id;
        $input['status']='pending';

        Friendship::create($input);
        return redirect('doctors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
         $user = User::find($id);
         $friendship=$user->getFriendShip(Auth::user());
         if($friendship)
         {
             if($friendship->status=="confirmed")
             {
                 $reports = $this->getReports($user);
                return view('doctors.reports',compact('reports'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function edit(Friendship $friendship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $friendship=Friendship::find($id);
        $friendship->status='confirmed';
        $friendship->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friendship $friendship)
    {
        //
    }

    protected function getReports($user)
    {
        $reports = $user->reports()->latest();
        if(request('search'))
        {
            $reports
                ->whereRaw('CONCAT(`reportName`,`diseaseName`) LIKE "%'.request('search').'%"');
        }
        
        return $reports->paginate(8);

    }
}

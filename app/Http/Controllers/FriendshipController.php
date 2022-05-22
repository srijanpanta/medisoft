<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class FriendshipController extends Controller
{
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
    public function show(Friendship $friendship)
    {
        //
        $user=User::find(Auth::user()->id);
        $friendship=$user->friend_requests();
        dd($friendship);
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
}

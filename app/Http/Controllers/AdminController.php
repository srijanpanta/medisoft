<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }

    public function newDoctor()
    {
        $doctors=User::where('role','doctor')->where('status','<>','verified')->get();
        return view('admin.newdoctors',compact('doctors'));
    }

    public function showDoctor(User $doctor)
    {
        return view ('admin.showDoctor',compact('doctor'));
    }

    public function acceptDoctor(User $doctor)
    {
        $doctor->update(array('status'=>'verified'));
        return redirect()->route('sendAcceptedNotification',['user_id'=>$doctor->id]);
    }
}

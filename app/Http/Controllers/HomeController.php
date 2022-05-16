<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($request->email!=Auth::user()->email)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
            ]);
        }
        else
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
        ]);
       
        $user->update($request->all());
        return redirect()->route('home')->with('success','Profile updated successfully!'); 
    }
}

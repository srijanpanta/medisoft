<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Hash;
use App\Providers\RouteServiceProvider;


use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create','store']]);
    }
    public function index()
    {
        //
        return view('doctors.index',[
            'doctors' => $this->getDoctors()
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
        return view('auth.registerDoctor');
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
            'nmc'=>'required',
            'document'=> 'required|image|mimetypes:image/jpeg,image/png',
            'doctor_degree'=>'required',
            'doctor_type'=>'required',
            ]);
            $input = $request->all();
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/images/';
                $filename = $file_extension;
                $request->file('document')->move($destination_path, $filename);
                $input['document'] = $filename;
            }
            // dd($input);
            User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phoneNumber' => $input['phoneNumber'],
            'password' => Hash::make($input['password']),
            'nmc'=>$input['nmc'],
            'document'=>$input['document'],
            'role'=>'doctor',
            'doctor_degree'=>$input['doctor_degree'],
            'doctor_type'=>$input['doctor_type'],
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        //
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success','Doctor deleted successfully');
    }

    protected function getDoctors()
    {
        $doctors = User::where('role','doctor')->where('id','<>',Auth::user()->id);
        if(request('search'))
        {
            $doctors
                ->whereRaw('CONCAT(`name`,`doctor_type`) LIKE "%'.request('search').'%"');
        }
        
        return $doctors->paginate(6);

    }
}

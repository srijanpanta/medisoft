<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Input;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['role']!="doctor")
        {
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
            'location' => 'required',
        ]);
        }
        else
        {
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
            'nmc_no'=>'required',
            'document'=> 'required|image|mimetypes:image/jpeg,image/png',
            'doctor_degree'=>'required',
            'doctor_type'=>'required',
            'location'=>'required',
             ]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $data['password']=Hash::make($data['password']);
        if(request()->hasFile('document'))
        {
            $file = request()->file('document');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/images/';
                $filename = $file_extension;
                request()->file('document')->move($destination_path, $filename);
                $data['document'] = $filename;
        }
        if($data['role']=='patient')
        {
            $data['status']='verified';
        }
        else
        {
            $data['status']='notVerified';
        }
        return User::create($data);
    }
}

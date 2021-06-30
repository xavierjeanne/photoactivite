<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'address' => ['required_if:type,pro', 'string', 'max:255'],
                'postal-code' => ['required_if:type,pro', 'string'],
                'city' => ['required_if:type,pro', 'string'],
                'country' => ['required_if:type,pro', 'string'],
                'dateofbirth' => ['required', 'date'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'company' => 'required_if:type,pro',
                'phone' => 'required_if:type,pro',
                'siret' => 'required_if:type,pro',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type']=='perso'){
            return User::create([
                'name' => $data['name'],
                'lastname' => $data['name'],
                'email' => $data['email'],
                'dateofbirth' => $data['dateofbirth'],
                'password' => Hash::make($data['password']),
                'parent_id' => 0,
                'licence_active_id' => 0,
                'avatar_id' => 1,
                'role_id' => 2,
            ]);
        }
        else{
            return User::create([
                'name' => $data['name'],
                'lastname' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'address-bis' => $data['address-bis'],
                'postal-code' => $data['postal-code'],
                'country' => $data['country'],
                'city' => $data['city'],
                'siret' => $data['siret'],
                'company' => $data['company'],
                'phone' => $data['phone'],
                'dateofbirth' => $data['dateofbirth'],
                'password' => Hash::make($data['password']),
                'parent_id' => 0,
                'licence_active_id' => 0,
                'avatar_id' => 1,
                'role_id' => 2,
            ]);
        }
    }

    public function showRegistrationFormStep2($type)
    {
        return view('auth.register-step2',compact('type'));
    }

    public function register(Request $request)
    {
        
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);


    return redirect(route('home'));
    }
}

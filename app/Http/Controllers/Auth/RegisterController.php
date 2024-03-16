<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\City;
use App\Models\Subdistrict;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->fname = $data['fname'];
        $user->lname = $data['lname'];
        $user->birthdate = $data['birthdate'];
        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $image = $data['picture']; 
        $imageName = $data['fname'].$data['lname'].'.'.$image->getClientOriginalExtension();
        // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
        $image->move($folderPath, $imageName); // Store the image in the public path

        // Store the folder path in the database
        // Add any other necessary logic here
        $user->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/'.$imageName;
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $subRaw = $data['input-subdistrict'];
        $subData = str_replace("Kec. ", "", $subRaw);
        $cityRaw = $data['input-city'];
        $cityData = str_replace("Kota ", "", $cityRaw);
        $cityData = str_replace("Kabupaten ", "", $cityData);
        $city =  City::where("name",$cityData)->first();
        $subdistrict = Subdistrict::where("name",$subData)->first();
        // dd($city,$subdistrict);
        if($city == null){
            $city2 = new City();
            $city2->name = $cityData;
            $city2->save();
            $subdistrict2 = new Subdistrict();
            $subdistrict2->name = $subData;
            $subdistrict2->city_id = $city2->id;
            $subdistrict2->save();
            $user->city_id = $city2->id;
            $user->subdistrict_id = $subdistrict2->id;
        }
        elseif($city != null && $subdistrict == null){
            $subdistrict2 = new Subdistrict();
            $subdistrict2->name = $subData;
            $subdistrict2->city_id = $city->id;
            $subdistrict2->save();
            $user->city_id = $city->id;
            $user->subdistrict_id = $subdistrict2->id;
        }else{
            $user->city_id = $city->id;
            $user->subdistrict_id = $subdistrict->id;
        }
        if($data['registration-option'] == 'child'){
            $user->grade = $data['child-grade'];
            $user->save();
        }elseif($data['registration-option'] == 'parent'){
            $user->save();
            $user2 = new User();
            $user2->fname = $data['child-fname'];
            $user2->lname = $data['child-lname'];
            $user2->grade = $data['child-grade'];
            $user2->birthdate = $data['child-birthdate'];
            $user2->parent_id = $user->id;
            $user2->save();
        }elseif($data['registration-option'] == 'general'){
            $user->save();
        }
        return $user;

    }
}

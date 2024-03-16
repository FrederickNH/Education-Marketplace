<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Tutoring;
use App\Models\SubjectTeaches;
use App\Models\Subject;
use App\Models\SeekingTutors;
use App\Models\SchoolShuttle;
use App\Models\AcademicHistories;
use App\Models\TutoringRequest;
use App\Models\User;
use App\Models\School;
use App\Models\Experience;
use App\Models\Booking;
use App\Models\Certificate;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\Offers;
use App\Models\TutorHoliday;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class SchoolShuttleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = Auth::user();
        $shuttle = new SchoolShuttle();
        $shuttle->user_id = $user->id;
        $shuttle->shuttle_name = $request->input("input-shuttle-name");
        $shuttle->description = $request->input("input-shuttle-description");
        $shuttle->price = $request->input("input-shuttle-price");
        $shuttle->city_id = $request->input("input-shuttle-city");
        $shuttle->subdistrict_id = $request->input("input-shuttle-subDistrict");
        $shuttle->form = $request->input("input-shuttle-form");
        $picture = "input-picture";

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/shuttle');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

        $request->validate([
            $picture => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile($picture)) {
            $image = $request->file($picture);
            $imageName = 'Picture_'.$shuttle->shuttle_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $shuttle->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/shuttle/'.$imageName;
        }else{
            $shuttle->picture ="certificate-dummy.png";
        }



        $identity_file = "input-shuttle-identity-file";
        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/shuttle/identity');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
        $request->validate([
            $identity_file => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        if ($request->hasFile($identity_file)) {
            $image = $request->file($identity_file);
            $imageName = 'Identity_'.$shuttle->shuttle_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $shuttle->identity_card ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/shuttle/identity/'.$imageName;
        }else{
            $shuttle->identity_card ="certificate-dummy.png";
        }
        $shuttle->save();
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolShuttle  $schoolShuttle
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolShuttle $schoolShuttle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolShuttle  $schoolShuttle
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolShuttle $schoolShuttle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolShuttle  $schoolShuttle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $shuttle = SchoolShuttle::where("user_id",$user->id)->first();
        if($request->input('input-description') != $shuttle->description){
            $shuttle->description = $request->input('input-description');
        }
        if($request->input('input-price') != $shuttle->price){
            $shuttle->price = $request->input('input-price');
        }
        if($request->input('input-city') != $shuttle->city_id){
            $city = City::where("name", $request->input("input-city"))->first();
            $shuttle->city_id = $city->id;
        }
        if($request->input('input-subDistrict') != $shuttle->subdistrict_id){
            $shuttle->subdistrict_id = $request->input("input-subDistrict");
        }
        if($request->input('input-form') != $shuttle->form){
            $shuttle->form = $request->input("input-form");
        }
        if($request->hasFile('input-picture')){
            $picture = "input-picture";

            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }

            $request->validate([
                $picture => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile($picture)) {
                $image = $request->file($picture);
                $imageName = 'Picture_'.$shuttle->shuttlle_name.'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path

                // Store the folder path in the database
                // Add any other necessary logic here
                $shuttle->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/'.$imageName;
            }else{
                $shuttle->picture ="certificate-dummy.png";
            }
        }
        $shuttle->save();
        return redirect()->route('shuttleGet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolShuttle  $schoolShuttle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolShuttle $schoolShuttle)
    {
        //
    }
    public function getShuttle(){
        $user = Auth::user();
        $shuttle = SchoolShuttle::where("user_id",$user->id)
                    ->join("cities", "cities.id", "=", "school_shuttles.city_id")
                    ->join("subdistricts", "subdistricts.id", "=", "school_shuttles.subdistrict_id") 
                    ->select("school_shuttles.*", "subdistricts.name as SubdistrictName","cities.name as CityName")
                    ->get();
        $cityList = City::all();
        return view('shuttle.shuttleManage', compact('shuttle','cityList'));
    }
    public function getDestination(){
        $user = Auth::user();
        $shuttle = SchoolShuttle::where("user_id",$user->id)->first();
        $destinationList = $shuttle->shuttleDestination;
        $schoolList = School::where("city_id", $shuttle->city_id)->get();
        // dd($destinationList);
        $subdistrictList = Subdistrict::all();
        return view('shuttle.shuttleDestination', compact('destinationList','schoolList','subdistrictList'));
    }
    public function addDestination(Request $request){
        $user = Auth::user();
        $shuttle = SchoolShuttle::where("user_id",$user->id)->first();
        $destination = School::where("school_name", $request->input("input-school-select"))->first();
        // dd($destination);
        // dd($shuttle->shuttleDestination);
        $shuttle->shuttleDestination()->attach(['school_id' => $destination->id]);
        $price = $request->input("input-price");
        $subdistrict = Subdistrict::where("name","=",$request->input("input-subdistrict-select"))->first();
        $updateData = [
            'price' => $price,
            'subdistrict_id' => $subdistrict->id
            // Add more columns as needed
        ];
        DB::table("school_school_shuttle")
            ->where("school_id",$destination->id)
            ->where("shuttle_id",$shuttle->id)
            ->update($updateData);
        return redirect()->route('destinationGet');
    }
    public function deleteDestination($id){
        $user = Auth::user();
        $shuttle = SchoolShuttle::where("user_id",$user->id)->first();
        $shuttle->shuttleDestination()->detach($id);
        return redirect()->route('destinationGet');
    }
}

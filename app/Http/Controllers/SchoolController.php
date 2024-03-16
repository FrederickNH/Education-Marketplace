<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Tutoring;
use App\Models\SubjectTeaches;
use App\Models\Subject;
use App\Models\SeekingTutors;
use App\Models\AcademicHistories;
use App\Models\TutoringRequest;
use App\Models\User;
use App\Models\Experience;
use App\Models\Booking;
use App\Models\Certificate;
use App\Models\Offers;
use App\Models\TutorHoliday;
use App\Models\Facility;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class SchoolController extends Controller
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
        $school = new School();
        $school->user_id = $user->id;
        $school->school_name = $request->input("input-school-name");
        $school->address = $request->input("input-address");
        $school->vision = $request->input("input-vision");
        $school->mission = $request->input("input-mission");
        $school->level = $request->input("input-level");
        $school->phone = $request->input("input-phone");
        $school->website = $request->input("input-website");
        $school->accreditation = $request->input("input-accreditation");
        $school->enrollment_start = $request->input("input-enrollment-start");
        $school->enrollment_end = $request->input("input-enrollment-end");
        $school->subdistrict_id = $request->input("input-school-subDistrict");
        $school->city_id = $request->input("input-school-city");

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
            $imageName = 'Picture_'.$school->school_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $school->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/'.$imageName;
        }else{
            $school->picture ="certificate-dummy.png";
        }
        
        $accreditationFile = "input-accreditation-certificate";

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/accreditation');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

        $request->validate([
            $accreditationFile => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        if ($request->hasFile($accreditationFile)) {
            $image = $request->file($accreditationFile);
            $imageName = 'Accreditation_'.$school->school_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $school->accreditation_proof ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/accreditation/'.$imageName;
        }else{
            $school->accreditation_proof ="noimage.png";
        }
        $school->status = "Waiting";
        $school->save();

        
        $facilityCounter = $request->input('dropdownCount');
        
        if($facilityCounter > 0){
            for ($i=0; $i < $facilityCounter; $i++) { 
                $facility_name = 'input-facility-select-'.$i;
                $facility_detail = 'input-facility-detail-'.$i;
                $facility_picture = 'input-facility-picture-'.$i;
                $picture="";
                $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                        
                $request->validate([
                    $facility_picture => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
                ]);
                
                $facility = Facility::where("name", $request->input($facility_name))->first();
                if ($request->hasFile($facility_picture)) {
                    $image = $request->file($facility_picture);
                    $imageName = 'Facility_'.$facility->name.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path
        
                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities/'.$imageName;
                }else{
                    $picture ="noimage.png";
                }
                $school->facility()->attach($facility->id,['facility_detail' => $request->input($facility_detail),'picture' => $picture]);
            }
        }
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        if($request->input('input-vision') != $school->vision){
            $school->vision = $request->input('input-vision');
        }
        if($request->input('input-mission') != $school->mission){
            $school->mission = $request->input('input-mission');
        }
        if($request->input('input-level') != $school->level){
            $school->level = $request->input('input-level');
        }
        if($request->input('input-phone') != $school->phone){
            $school->phone = $request->input('input-phone');
        }
        if($request->input('input-website') != $school->website){
            $school->website = $request->input('input-website');
        }
        if($request->input('input-accreditation') != $school->accreditation){
            $school->accreditation = $request->input('input-accreditation');

            $accreditationFile = "input-accreditation-certificate";

            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/accreditation');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }

            $request->validate([
                $accreditationFile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile($accreditationFile)) {
                $image = $request->file($accreditationFile);
                $imageName = 'Accreditation_'.$school->school_name.'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path

                // Store the folder path in the database
                // Add any other necessary logic here
                $school->accreditation_proof ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/accreditation/'.$imageName;
            }else{
                $school->accreditation_proof ="certificate-dummy.png";
            }
        }
        if($request->input('input-enrollment-start') != $school->enrollment_start){
            $school->enrollment_start = $request->input('input-enrollment-start');
        }
        if($request->input('input-enrollment-end') != $school->enrollment_end){
            $school->enrollment_end = $request->input('input-enrollment-end');
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
                $imageName = 'Picture_'.$school->school_name.'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path

                // Store the folder path in the database
                // Add any other necessary logic here
                $school->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/'.$imageName;
            }else{
                $school->picture ="certificate-dummy.png";
            }
        }
        $school->save();
        return redirect()->route('schoolGet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }

    public function getSchool(){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)
                    ->join("cities", "cities.id", "=", "schools.city_id")
                    ->join("subdistricts", "subdistricts.id", "=", "schools.subdistrict_id") 
                    ->select("schools.*", "subdistricts.name as SubdistrictName","cities.name as CityName")
                    ->get();
        return view('school.schoolManage', compact('school'));
    }
    public function getEnrollmentPrice(){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $variantList = DB::table('enrollment_price')->where("school_id","=",$school->id)->get();
        return view("school.enrollmentPrice",compact("variantList"));
    }
    public function addEnrollmentPrice(Request $request){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        DB::table('enrollment_price')->insert([
            'school_id' => $school->id,
            'title' => $request->input("input-price-title"),
            'price' => $request->input("input-price"),
        ]);
        return redirect()->route("enrollmentPrice");
    }
    public function getFacility(){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $facilityList = $school->facility;
        $rawFacilityList = Facility::all();
        // dd($facilityList);
        return view('school.schoolFacility', compact('facilityList','rawFacilityList'));
    }
    public function editFacility($id){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $facility = $school->facility()->wherePivot('facility_id', $id)->first();
        return response()->json($facility);
    }
    public function addFacility(Request $request){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $facility = Facility::where("name", $request->input("input-facility-select"))->first();


        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                        
                $request->validate([
                    'input-facility-picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
                ]);
                if ($request->hasFile('input-facility-picture')) {
                    $image = $request->file('input-facility-picture');
                    $imageName = 'Facility_'.$facility->name.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path
        
                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities/'.$imageName;
                }else{
                    $picture ="noimage.png";
                }
        $school->facility()->attach($facility->id,['facility_detail' => $request->input("input-facility-detail"),'picture' => $picture]);
        return redirect()->route('facilityGet');
    }
    public function updateFacility(Request $request){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $facility = $school->facility()->wherePivot('facility_id', $request->input("editItemId"))->first();

        if($request->input("edit-facility-detail") != $facility->pivot->facility_detail){
            $facility->pivot->facility_detail = $request->input("edit-facility-detail");
        }
        if($request->hasFile("edit-facility-picture")){
            $picture = "";
            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities');
            $request->validate([
                'edit-facility-picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
            
            if ($request->hasFile('edit-facility-picture')) {
                $image = $request->file('edit-facility-picture');
                $imageName = 'Facility_'.$facility->name.'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path
    
                // Store the folder path in the database
                // Add any other necessary logic here
                $picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/school/facilities/'.$imageName;
            }else{
                $picture ="noimage.png";
            }
            $facility->pivot->picture = $picture;
        }

        $facility->pivot->save();
        return redirect()->route('facilityGet');
    }
    public function deleteFacility($id){
        $user = Auth::user();
        $school = School::where("user_id",$user->id)->first();
        $school->facility()->detach($id);
        return redirect()->route('facilityGet');
    }
}

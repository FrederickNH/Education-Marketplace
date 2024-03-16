<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Subject;
use App\Models\Booking;
use App\Models\Promo;
use App\Models\Tutoring;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use midtrans;
use App\Models\Tutor;
use App\Models\TutorHoliday;
use App\Models\SubjectTeaches;
use App\Models\SeekingTutors;
use App\Models\AcademicHistories;
use App\Models\SchoolShuttle;
use App\Models\Experience;
use App\Models\Rating;
use App\Models\Certificate;
use App\Models\Offers;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\Competition;
use App\Models\CompetitionVarian;
use App\Models\CompetitionPrize;
use App\Models\CompetitionOrganiser;
use Carbon\Carbon;
use App\Models\TutoringRequest;
use App\Models\Schedule;
use App\Models\Facility;
use Tigo\Recommendation\Recommend;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // $client = new Recommend();
        $status = 'general';
        $topTutorList = DB::select('CALL spGetTopTutor()');
        $hotSubjectList = DB::select('CALL spGetHotSubject()');
        $topRatedTutorList = DB::select('CALL spTopRatedTutor()');
        $topRatedTutoringList = DB::select('CALL spTopRatedTutoring()');
        $tutorList = [];
        if($user != null){
            $status = 'student';
            if($user->age == 0){
                $child = User::where("parent_id",$user->id)->first();
                if($child != null){
                    $user->age = $child->age;
                    $status = 'parent';
                }else{
                    $status = 'general';
                }
                // dd($child);
            }
            $recCompe = DB::select('CALL spGetRecomCompetition(?,?)', array($user->id,$user->age));
            $ratings = Rating::all();
            $client = new Recommend();
            // dd($client->ranking($ratings,$user->id),$client->slopeOne($ratings,$user->id),$client->euclidean($ratings,$user->id), $ratings);
            $recom = $client->ranking($ratings,$user->id);
            // dd($recCompe,$topTutorList,$hotSubjectList,$topRatedTutorList,$topRatedTutoringList);

            foreach ($recom as $r => $value) {
                $tutor = User::where("users.id",$r)
                            ->join('tutors','tutors.user_id',"=","users.id")->first();
                $tutor->subject = SubjectTeaches::where('tutor_id',$tutor->id)
                                    ->get();            
                $subjectHistory = DB::select('CALL spGetSubjectHistory(?)', array($user->id));
                // dd($tutor->subject,$subjectHistory);
                $tutoring = [];
                foreach($tutor->subject as $subject){
                    foreach($subjectHistory as $history){
                        if($subject->subject_id == $history->id){
                            $tutoring[] = Tutoring::where("tutorings.tutor_id",$tutor->id)
                            ->where("tutorings.date",">",Carbon::now())
                            ->where("tutorings.subject_id",'=',$subject->id)
                            ->where("tutorings.main_tutoring_id","=",null)->get();
                            
                        }
                    }
                }
                $tutor->tutoring = $tutoring;
                $tutorList[] = $tutor;
            }
            // dd($tutorList);  
            // array_pop($tutorList);
        }else{
            $recCompe = DB::select('CALL spGetRecomComp');
        }
        
        // dd($tutorList);

        return view('index',compact('recCompe','topTutorList','hotSubjectList','topRatedTutorList','topRatedTutoringList','tutorList','status'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $user->city = City::find($user->city_id);
        $user->subdistrict = Subdistrict::find($user->subdistrict_id);
        $child = User::where('parent_id',$user->id)->get();
        // dd($user,$child);
        return view('users.manageProfile',compact('user','child'));
    }
    public function manageChild(){
        $user = Auth::user();
        $childList = User::where('parent_id',$user->id)->get();
        return view('users.manageChild',compact('childList'));
    }
    public function addChild(Request $request){
        // dd($request);
        $parent = Auth::user();
        $user = new User();
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->birthdate = $request->input('birthdate');
        $user->parent_id = $parent->id;
        $user->save();
        return redirect()->route('manageChild');
    }
    public function editChild($id,Request $request){
        $user = User::find($id);
        if($request->input('fname') != $user->fname){
            $user->fname = $request->input('fname');
        }
        if($request->input('lname') != $user->lname){
            $user->lname = $request->input('lname');
        }
        if($request->input('grade') != $user->grade){
            $user->grade = $request->input('grade');
        }
        $user->save();
        return redirect()->route('manageChild');
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
    public function update(Request $request)
    {
        $user = Auth::user();
        if($request->input('fname') != $user->fname){
            $user->fname = $request->input('fname');
        }
        if($request->input('lname') != $user->lname){
            $user->lname = $request->input('lname');
        }
        if($request->input('address') != $user->address){
            $user->address = $request->input('address');
        }
        if($request->input('phone') != $user->phone){
            $user->phone = $request->input('phone');
        }
        if($request->hasFile('picture')){
            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }   
            $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile('picture')) {
                $image = $request->file('picture');
                $imageName = $request->input($name).'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path

                // Store the folder path in the database
                // Add any other necessary logic here
                $user->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/'.$imageName;
            }else{
                $user->picture ="noimage.png";
            }
        }
        $user->save();
        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function tutorRegistration(){
        $schoolList = School::all();
        $subjectList = Subject::all();
        return view('users.tutorRegistration', compact('schoolList','subjectList'));
    }
    public function schoolRegistration(){
        $facilityList = Facility::all();
        $cityList = City::all();
        return view("users.schoolRegistration",compact("facilityList",'cityList'));
    }
    public function shuttleRegistration(){
        $cityList = City::all();
        return view('users.shuttleRegistration', compact('cityList'));
    }
    public function organiserRegistration(){
        return view("users.organiserRegistration");
    }
    public function institutionRegistration(){
        $cityList = City::all();
        $subdistrictList = Subdistrict::all();
        $subjectList = Subject::all();
        return view('users.institutionRegistration',compact('cityList','subdistrictList','subjectList'));
    }

    public function bookTutoring($id,$promo,$child){
        // dd($promo);
        $user = Auth::user();
                /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php
                                    
        Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        the file manually.   

        require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-2XXjKMwLSF3aaIwy_i49LW14';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $tutoring = Tutoring::find($id);
        $booking = new Booking();
        $booking->tutoring_id = $id;
        $booking->user_id = $user->id;
        if($child != 0){
            $booking->for = $child;
        }else{
            $booking->for = null;
        }

        if($promo != 'null'){
            $p = Promo::find($promo);
            // dd($promo);
            $booking->promo_id = $p->id;
            
            if($p->in_form == 'percentage'){
                $booking->final_price = $tutoring->price - ($tutoring->price * ($p->discount/100));    
            }elseif ($p->in_form == 'nominal') {
                $booking->final_price = $tutoring->price - ($p->nominal);
            }
        }else{
            $booking->promo_id = null;
            $booking->final_price = $tutoring->price;
        }
        $booking->status = "waiting";
        
        $booking->save();


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $booking->final_price,
            ),
            'customer_details' => array(
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data[0] = $snapToken;
        $data[1] = $booking->id;
        return response()->json($data);
    }

    public function saveBooking($id){
        $user = Auth::user();
        $booking = Booking::find($id);
        $booking->update([
            'status' => 'paid'
        ]);
        $request = TutoringRequest::where("tutorings.id",$booking->tutoring_id)
                        ->join("tutorings","tutorings.request_id","=","tutoring_requests.id")
                        ->join("bookings","bookings.tutoring_id","=","tutorings.id")
                        ->select("tutoring_requests.*")
                        ->get();
        $request->status = "Accepted";
        return response()->json("success");
    }
    public function cancelBooking($id){
        $user = Auth::user();
        $booking = Booking::find($id);
        $booking->update([
            'status' => 'canceled'
        ]);
        return response()->json("failed");
    }
    public function cancelTutoringBooking($id){
        $user = Auth::user();
        $booking = Booking::where("user_id", $user->id)
                    ->where("tutoring_id","=",$id);
        $booking->update([
            'status' => 'canceled'
        ]);
        return redirect()->route('tutoringListU');
    }
    public function checkRequest($tutorId,$date,$day,$startTime,$endTime){
        $tutoringList = Tutoring::where("tutor_id",$tutorId)->get();
        // dd($tutoringList);
        $timeBlocked = false;
        $schedule = Schedule::where("tutor_id",$tutorId)
                        ->where("day_of_the_week","=",$day)->first();
        $holidayBlock = TutorHoliday::where("tutor_id",$tutorId)
                            ->where("date","=",$date)->first();
        if($holidayBlock == null){
            if($schedule->start_time == null || $schedule->end_time == null){
                $timeBlocked = true;
            }
            else{
                if(($startTime >= $schedule->start_time && $startTime <= $schedule->end_time)
                    &&
                ($endTime >= $schedule->start_time && $endTime <= $schedule->end_time)
                    &&
                ($startTime < $schedule->start_break_time || $startTime >= $schedule->end_break_time)
                    &&
                ($endTime <= $schedule->start_break_time || $endTime > $schedule->end_break_time)
                ){
                    foreach ($tutoringList as $tutoring) {
                        if($tutoring->date == $date){
                            if(($startTime >= $tutoring->start_time && $startTime <= $tutoring->end_time)
                                ||
                            ($endTime >= $tutoring->start_time && $endTime <= $tutoring->end_time)){
                                $timeBlocked = true;
                            }
                        }
                    }
                }else{
                    $timeBlocked = true;
                }
            }
        }
        return response()->json($timeBlocked);
    }
    public function requestTutoring($id){
        $subjectTeach = Subject::where("subject_teaches.tutor_id",$id)
                            ->where("subject_teaches.status","approved")
                            ->join("subject_teaches", "subject_teaches.subject_id","=","subjects.id")
                            ->select("subject_teaches.*","subjects.name as subjectName")
                            ->get();
        $tutorId = $id;
        return view('tutoring.tutoringRequest',compact('subjectTeach','tutorId'));
              
    }
    public function inputRequest(Request $request){
        $user = Auth::user();
        $req = new TutoringRequest();
        $req->user_id = $user->id;
        $req->tutor_id = $request->input('input-tutor-id');
        $req->subject_id = $request->input('input-subject');
        $req->description = $request->input('input-description');
        $req->grade = $request->input('input-grade');
        $req->day = $request->input('input-day');
        $req->date = $request->input('input-date');
        $req->start_time = $request->input('input-start-time');
        $req->end_time = $request->input('input-end-time');
        $repetitive = $request->input('input-repetitive');
        if($repetitive != null){
            $req->repetitive = 1;
        }else{
            $req->repetitive = 0;
        }
        $req->repetitive_duration = $request->input("input-repetitive-duration") != null ? $request->input("input-repetitive-duration") : 1;
        $req->mode = $request->input("input-mode");
        $req->group_size = $request->input("input-group-size") != null ? $request->input("input-group-size") : 1;
        $req->method = $request->input('input-method');
        $req->location = $request->input('input-location');
        $req->status = "Waiting";
        $req->save();
        return redirect()->route('tutoringListU');
    }
    
    public function seekTutoring(){
        $subject = Subject::all();
        return view('tutoring.tutoringSeek',compact('subject'));
        
    }
    public function inputSeeking(Request $request){
        $user = Auth::user();
        $seek = new SeekingTutors();
        $seek->user_id = $user->id;
        $seek->subject_id = $request->input('input-subject');
        $repetitive = $request->input('input-repetitive');
        if($repetitive != null){
            $seek->repetitive = 1;
        }else{
            $seek->repetitive = 0;
        }
        $seek->repetitive_duration = $request->input("input-repetitive-duration") != null ? $request->input("input-repetitive-duration") : 1;
        $seek->mode = $request->input("input-mode");
        $seek->group_size = $request->input("input-group-size") != null ? $request->input("input-group-size") : 1;
        $seek->day = $request->input('input-day');
        $seek->date = $request->input('input-date');
        $seek->start_time = $request->input('input-start-time');
        $seek->end_time = $request->input('input-end-time');
        $seek->description = $request->input('input-description');
        $seek->grade = $request->input('input-grade');
        $seek->method = $request->input('input-method');
        $seek->location = $request->input('input-location');
        $seek->min_price = $request->input('input-min-price');
        $seek->max_price = $request->input("input-max-price");
        $seek->campaign_start = $request->input('input-campaign-start');
        $seek->campaign_end = $request->input("input-campaign-end");
        $seek->status = "available";
        // dd($seek);
        $seek->save();
        return redirect()->route('seekingList');
    }
    public function tutoringList(){
        $user = Auth::user();
        $tutoringList = Tutoring::where("bookings.user_id",$user->id)
                            ->where("bookings.status","=","paid")
                            ->join("bookings","bookings.tutoring_id",'=','tutorings.id')
                            ->join("users","users.id","=","bookings.user_id")
                            ->join("subject_teaches","subject_teaches.id", "=","tutorings.subject_id")
                            ->join("subjects","subjects.id","=","subject_teaches.subject_id")    
                            ->leftJoin("ratings","ratings.tutoring_id","=","tutorings.id")                        
                            ->select("tutorings.*","subjects.name as SubjectName","ratings.rate as rate")
                            ->orderBy("tutorings.date","desc")
                            ->get();
                            // dd($tutoringList);
        $tutoringPureList = Tutoring::where("bookings.user_id",$user->id)
                                ->where("tutorings.seeking_tutor_id", "=", null)
                                ->where("tutorings.request_id", "=", null)
                                ->where("bookings.status","=","paid")
                                ->join("bookings","bookings.tutoring_id",'=','tutorings.id')
                                ->join("users","users.id","=","bookings.user_id")
                                ->join("subject_teaches","subject_teaches.id", "=","tutorings.subject_id")
                                ->join("subjects","subjects.id","=","subject_teaches.subject_id")
                                ->select("tutorings.*","subjects.name as SubjectName")
                                ->orderBy("tutorings.date","desc")
                                ->get();
                                // dd($tutoringPureList);
        $seekList = SeekingTutors::where('seeking_tutors.user_id',$user->id)
                        ->join("users",'users.id','=','seeking_tutors.user_id')
                        ->join("subjects","subjects.id","=","seeking_tutors.subject_id")
                        ->select("subjects.name as SubjectName","seeking_tutors.*")
                        ->get();
                        // dd($seekList);
        foreach($seekList as $s){
            $offer = Offers::where("offers.seeking_tutor_id",$s->id)->get();
            $latestOffer = 0;
            foreach($offer as $o){
                if($o->status == "Accepted"){
                    $t = Tutoring::where("seeking_tutor_id",$s->id)->get();
                    foreach($t as $tut){
                        $s->tutoring_id = $tut->id;
                    }
                    $s->status = "Done";
                }
                $latestOffer = $o->price;
            }
            $s->latestOffer = $latestOffer;
            $t = Tutoring::where("seeking_tutor_id","=","$s->id")->first();
            // dd($t);
            if($t != null){
                $s->status = 'made';
                // dd($t);
                $s->tutoring_id = $t->id;
            }
        }

        // $requestList = TutoringRequest::where("tutoring_requests.user_id",$user->id)
        //                 ->join("tutors","tutors.id","=","tutoring_requests.tutor_id")
        //                 ->join("users", "users.id", "=","tutors.user_id")
        //                 ->join("subject_teaches","subject_teaches.id","=", "tutoring_requests.subject_id")
        //                 ->join("subjects","subjects.id","=","subject_teaches.subject_id")
        //                 ->select("subjects.name as SubjectName","tutoring_requests.*","users.fname as TutorFName","users.Lname as TutorLName")   
        //                 ->get();
        // foreach($requestList as $r){
        //     if($r->status == "WaitingPayment"){
        //         $tut = Tutoring::where("tutorings.request_id",$r->id)->first();
                
        //         $r->tutoring_id = $tut->id;
        //     }
        // }
        // dd($seekList);
        return view('tutoring.tutoringList',compact('tutoringList','tutoringPureList','seekList'));
    }
    public function classDetail($id){
        $tutoring = Tutoring::find($id);
        $tutor  = Tutor::where('id',$tutoring->tutor_id)->first();
        $booking = Booking::where("tutoring_id",$tutoring->id)->first();
        $tutoring->final_price = $booking->final_price;
        $user = User::find($tutor->user_id);
        $tutor->name = $user->fname.' '.$user->lname;
        $tutor->picture = $user->picture;
        $childTutoring = Tutoring::where('main_tutoring_id','=',$id)->get();
        $date[] = $tutoring->date;
        $day[] = $tutoring->day; 
        $method[] = $tutoring->method;
        $location[] = $tutoring->location;
        $startTime[] = $tutoring->start_time;
        $endTime[] = $tutoring->end_time;
        if(count($childTutoring) > 0){
            foreach ($childTutoring as $c) {
                $date[] = $c->date;
                $day[] = $c->day; 
                $method[] = $c->method;
                $location[] = $c->location;
                $startTime[] = $c->start_time;
                $endTime[] = $c->end_time;
            }
        }
        $tutoring->date = $date;
        $tutoring->day = $day; 
        $tutoring->method  = $method;
        $tutoring->location = $location;
        $tutoring->start_time = $startTime;
        $tutoring->end_time = $endTime;
        // dd($tutoring,$childTutoring,$date,$tutor,$booking);
        return view('users.tutoringDetail',compact('tutoring','tutor'));
    }

    public function seekingList(){
        $user = Auth::user();
        $seekList = SeekingTutors::where('seeking_tutors.user_id',$user->id)
                        ->join("users",'users.id','=','seeking_tutors.user_id')
                        ->join("subjects","subjects.id","=","seeking_tutors.subject_id")
                        ->select("subjects.name as SubjectName","seeking_tutors.*")
                        ->get();
        foreach($seekList as $s){
            $offer = Offers::where("offers.seeking_tutor_id",$s->id)->get();
            $latestOffer = 0;
            foreach($offer as $o){
                if($o->status == "Accepted"){
                    $t = Tutoring::where("seeking_tutor_id",$s->id)->get();
                    foreach($t as $tut){
                        $s->tutoring_id = $tut->id;
                    }
                    $s->status = "Done";
                }
                $latestOffer = $o->price;
            }
            $s->latestOffer = $latestOffer;
        }             
        return view('tutoring.seekingList',compact('seekList'));
    }
    public function offerList($id){
        $offers = Offers::where('offers.seeking_tutor_id', $id)
                            ->join('tutors','tutors.id','=','offers.tutor_id')
                            ->join('users','users.id',"=",'tutors.user_id')
                            ->select('offers.*','users.fname as tutorFName', 'users.lname as tutorLName')
                            ->get();
        return view('tutoring.offerList',compact('offers'));    
    }
    public function offerAccepted($id){
        $user = Auth::user();
        $offers = Offers::find($id);
        $offers->status = 'Accepted';
        $offers->deal_date = now();
        $offers->save();
        $offer = Offers::where('offers.id',"!=",$offers->id)
                    ->where('offers.seeking_tutor_id',"=",$offers->seeking_tutor_id)
                    ->get();
        foreach ($offer as $o) {
            $o->status = 'Rejected';
            $o->save();
        }
        $seek = SeekingTutors::find($offers->seeking_tutor_id);
        $seek->status = "done";
        $seek->save();
        $subject = SubjectTeaches::where('subject_teaches.subject_id',$seek->subject_id)
                                    ->where("subject_teaches.tutor_id", "=",$offers->tutor_id)
                                    ->first();
        $tutoring = new Tutoring();
        $tutoring->tutor_id = $offers->tutor_id;
        $tutoring->subject_id = $subject->id;
        $tutoring->title = "Tutoring for $user->fname $user->lname";
        $tutoring->date = $seek->date;
        $tutoring->day = $seek->day;
        $tutoring->start_time = $seek->start_time;
        $tutoring->end_time = $seek->end_time;
        $tutoring->price = $offers->price;
        $tutoring->method = $seek->method;
        $tutoring->location = $seek->location;
        $tutoring->repetitive = $seek->repetitive;
        $tutoring->repetitive_duration = $seek->repetitive_duration;
        $tutoring->mode = $seek->mode;
        $tutoring->group_size = $seek->group_size;
        $tutoring->seeking_tutor_id = $seek->id;
        $tutoring->save();
        if($tutoring->repetitive == 1){
            DB::statement('CALL spAddChildTutoring(?)', array($tutoring->id));
        }
        
        return redirect()->route('tutoringListU');
    }
    public function offerRejected($id){
        $offer = Offers::find($id);
        $offer->status = 'Rejected';
        $offer->save();
        return redirect()->route('offerList',['id' => $offer->seeking_tutor_id]);
    }

    public function competitionListAll(){
        // $competitionList = Competition::all();
        // $result = Competition::join('competition_varians',"competition_varians.competition_id", "=", "competitions.id")
        // ->selectRaw('MAX(competition_varians.max_age) as max_age, MIN(competition_varians.min_age) as min_age, competitions.*')
        // ->get();
        $competitionList = DB::select("select * from vCompetitionList");
        // dd($competitionList);
        return view('competition.competitionAllList', compact('competitionList'));
    }
    public function competitionList(){
        $userId = Auth::User()->id;
        $competitionList = Competition::where("competition_varian_user.user_id",$userId)
                            ->join("competition_varians","competition_varians.competition_id","=","competitions.id")
                            ->join("competition_varian_user","competition_varian_user.competition_varian_id","=","competition_varians.id")
                            ->leftJoin("ratings","ratings.competition_id","=","competitions.id")
                            ->select("competitions.*","ratings.rate as rate")
                            ->orderBy("competitions.competition_start","desc")
                            ->get();
        // dd($competitionList);
        return view("competition.competitionList",compact('competitionList'));
    }
    public function competitionDetail($id){
        $competition = Competition::find($id);
        $org = CompetitionOrganiser::where("id",$competition->organiser_id)->first();
        $variantList = CompetitionVarian::where("competition_varians.competition_id",$competition->id)->get();
        foreach ($variantList as $variant) {
            $prize = CompetitionPrize::where("varian_id",$variant->id)->get();
            $variant->prize = $prize;
        }
        return view("competition.competitionDetail",compact("competition","variantList","org"));
    }
    public function competitionRegisterDetail($id){
        $variant = CompetitionVarian::find($id);
        return view("competition.competitionRegister",compact("variant"));
    }
    public function competitionRegister(Request $request){
        // dd('competitionRegister',$request);
        $user = Auth::user();
        $nameList = "";
        $phoneList="";
        $schoolList="";
        $studentIdList="";
        $folderPath = public_path('assets/img/userfile/'.$request->input('competitionUser').'/organiser/competition/'.$request->input("competitionId"));
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        for ($i=0; $i < $request->input('dropdownCount'); $i++) { 
            $name = 'input-name-'.$i;
            $phone = 'input-phone-number-'.$i;
            $school = 'input-school-name-'.$i;
            $studentId = 'input-student-id-'.$i;
            if($i == 0){
                $nameList = $request->input($name);
                $phoneList = $request->input($phone);
                $schoolList = $request->input($school);
                $request->validate([
                    $studentId => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($studentId)) {
                    $image = $request->file($studentId);
                    $imageName = $request->input($name).'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $studentIdList ='userfile/'.$request->input('competitionUser').'/organiser/competition/'.$request->input("competitionId").'/'.$imageName;
                }else{
                    $studentIdList ="noimage.png";
                }
            }else{
                $nameList = $nameList."|".$request->input($name);
                $phoneList = $phoneList."|".$request->input($phone);
                $schoolList = $schoolList."|".$request->input($school);
                $request->validate([
                    $studentId => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($studentId)) {
                    $image = $request->file($studentId);
                    $imageName = $request->input($name).'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $studentIdList = $studentIdList."|".'userfile/'.$request->input('competitionUser').'/organiser/competition/'.$request->input("competitionId").'/'.$imageName;
                }else{
                    $studentIdList = $studentIdList."|"."noimage.png";
                }
            }
        }

        $variant = CompetitionVarian::find($request->input('variantId'));
        $variant->user()->attach($user->id,['team_name' =>$request->input('input-team-name'),'participant_name' => $nameList,'participant_phone' =>$phoneList,"school_origin"=>$schoolList,"student_card"=>$studentIdList,"registration_date"=>Carbon::now(),"payment_date"=>Carbon::now(),"status"=>"paid"]);
        return redirect()->route('competition');
    }
    public function competitionRegisterDetailU(Request $request){
        $data = $request;
        // dd("U",$request);
        $variant = CompetitionVarian::find($data->input('variantId'));
        return view('competition.competitionRegistrationDetail',compact('data','variant'));
    }
    public function payRegistration($id){
        $user = Auth::user();
        $variant = CompetitionVarian::find($id);
                /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php
                                    
        Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        the file manually.   

        require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-2XXjKMwLSF3aaIwy_i49LW14';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $variant->price,
            ),
            'customer_details' => array(
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = $snapToken;
        return response()->json($data);
    }

    public function competitionCatalog(Request $request){
        $subjectList = Subject::all();
        $competitionList = DB::table("vCompetitionList");
        $competitionList->where('campaign_end', '>=',Carbon::now());
        if($request->has('filter-age') && (($request->input('filter-age')*1) > 0)){
            $competitionList->where('min_age', '<=',($request->input('filter-age')*1));
            $competitionList->where('max_age', '>=',($request->input('filter-age')*1));
        }
        if($request->has('filter-subject')){
            $competitionList->where('subject_id','=',$request->input('filter-subject'));
        }
        $filteredCompetition = $competitionList->get();
        // dd($filteredCompetition);
        return view('users.catalog.competitionList', compact('filteredCompetition','subjectList'));
    }
    public function schoolCatalog(Request $request){
        $cityList = City::all();
        $schoolList = School::join("cities","cities.id","=","schools.city_id")
                        ->select("schools.*","cities.name as cityName");
        if($request->has('filter-accreditation')){
            $schoolList->where('accreditation', '=',$request->input('filter-accreditation'));
        }     
        if($request->has('filter-level')){
            $schoolList->where('level', '=',$request->input('filter-level'));
        }
        if($request->has('filter-city')){
            $schoolList->where('city_id','<=',$request->input('filter-city'));
        }
        $schoolList = $schoolList->get();
        return view("users.catalog.schoolList",compact('schoolList','cityList'));
    }
    public function shuttleCatalog(Request $request){
        $cityList = City::all();
        $schoolList = School::all();
        $shuttleList = SchoolShuttle::join("cities","cities.id","=","school_shuttles.city_id")
        ->join("subdistricts","subdistricts.id","=","school_shuttles.subdistrict_id")
        ->leftJoin("school_school_shuttle","school_school_shuttle.shuttle_id","=","school_shuttles.id")
        ->select("school_shuttles.*","cities.name as cityName","subdistricts.name as subdistrictName")
        ->distinct();
        if($request->has('filter-school')){
            $shuttleList->where('school_school_shuttle.school_id', '=',$request->input('filter-school'));
        }else{
            if($request->has('filter-city')){
                $shuttleList->where('school_shuttles.city_id', '=',$request->input('filter-city'));
            }     
            if($request->has('filter-subdistrict')){
                $shuttleList->where('school_shuttles.subdistrict_id', '=',$request->input('filter-subdistrict'));
            }
        }
        $shuttleList = $shuttleList->get();
        return view("users.catalog.shuttleList",compact('shuttleList','cityList','schoolList'));  
    }
    public function tutorCatalog(){
        $tutorList = Tutor::select("tutors.*","tutors.id as tutor_id","users.*")
                        ->join("users","users.id","=","tutors.user_id")
                        ->get();
        $tutorList = DB::select('CALL spGetTutoringList()');                    
        return view('users.catalog.tutorList',compact('tutorList'));
    }
    public function tutoringCatalog(Request $request){
        $tutoringList = Tutoring::query();
        $tutoringList->where("main_tutoring_id","=", null);
        $tutoringList->where("request_id" , "=", null);
        $tutoringList->where("seeking_tutor_id","=",null);
        $tutoringList->where("date",">=",Carbon::now());
        if($request->has('filter-mode')){
            $tutoringList->where('mode', '=',$request->input('filter-mode'));
        }     
        if($request->has('filter-method')){
            $tutoringList->where('method', '=',$request->input('filter-method'));
        }
        if($request->has('filter-rep')){
            if($request->input('filter-rep') == 'non'){
                $tutoringList->where("repetitive", '=',null);
            }else if($request->input('filter-rep') == 'rep'){
                $tutoringList->where("repetitive", '=',1);
            }
        }
        if($request->has('filter-price') && (($request->input('filter-price')*1) > 0)){
            $tutoringList->where('price','<=',($request->input('filter-price')*1));
        }            
        $filteredTutoring = $tutoringList->get();
        // dd($filteredTutoring);
        return view("users.catalog.tutoringList",compact('filteredTutoring'));
    }

    public function schoolList(){
        $schoolList = School::join("cities","cities.id","=","schools.city_id")
                        ->select("schools.*","cities.name as cityName")
                        ->get();
        return view("school.user.schoolList",compact('schoolList'));
    }
    public function schoolDetail($id){
        $school = School::where("schools.id",$id)
                    ->join("cities","cities.id","=","schools.city_id")
                    ->join("subdistricts","subdistricts.id","=","schools.subdistrict_id")
                    ->select("schools.*","cities.name as cityName","subdistricts.name as subdistrictName")
                    ->first();
        $facilityList = $school->facility;
        $enrollmentTypeList = DB::table('enrollment_price')->where("school_id","=",$school->id)->get();
        // dd($enrollmentTypeList);
        return view("school.user.schoolDetail",compact("school","facilityList","enrollmentTypeList"));
    }   

    public function shuttleList(){
        $shuttleList = SchoolShuttle::join("cities","cities.id","=","school_shuttles.city_id")
                    ->join("subdistricts","subdistricts.id","=","school_shuttles.subdistrict_id")
                    ->select("school_shuttles.*","cities.name as cityName","subdistricts.name as subdistrictName")
                    ->get();
        return view("shuttle.user.shuttleList",compact('shuttleList'));         
    }
    public function shuttleDetail($id){
        $shuttle = SchoolShuttle::where("school_shuttles.id",$id)
                    ->join("cities","cities.id","=","school_shuttles.city_id")
                    ->join("subdistricts","subdistricts.id","=","school_shuttles.subdistrict_id")
                    ->select("school_shuttles.*","cities.name as cityName","subdistricts.name as subdistrictName")
                    ->first();

        $destinationList = $shuttle->shuttleDestination;
        foreach($destinationList as $destination){
            $price = DB::table("school_school_shuttle")->where("shuttle_id","=",$id)->where("school_id","=",$destination->id)
                        ->join("subdistricts","subdistricts.id","=","school_school_shuttle.subdistrict_id")
                        ->select("school_school_shuttle.price","subdistricts.name as subdistrict_name")->first();
            $destination->price = $price->price;
            $destination->subdistrict_name = $price->subdistrict_name;
        }
        // dd($destinationList);
        return view("shuttle.user.shuttleDetail",compact("shuttle","destinationList"));
    }   

    public function inputRateTutoring(Request $request){
        $user = Auth::user();
        $tutoring = Tutoring::find($request->input('input-id'));
        $rating = new Rating();
        $rating->user_id = $user->id;
        $rating->rate = $request->input("input-rate");
        if($rating->rate <= 3){
            $rating->liked = 0;
        }else if($rating->rate > 3){
            $rating->liked = 1;
        }
        $rating->comments = $request->input('input-comments');
        $rating->date_rated = now();
        $rating->for = 'tutoring';
        $rating->given_to = $tutoring->tutor_id;
        $rating->tutoring_id = $tutoring->id;
        $rating->save();
        return redirect()->route('tutoringListU');
    }
    public function inputRateCompetition(Request $request){
        $user = Auth::user();
        $competition = Competition::find($request->input('input-id'));
        $rating = new Rating();
        $rating->user_id = $user->id;
        $rating->rate = $request->input("input-rate");
        if($rating->rate < 3){
            $rating->liked = 0;
        }else if($rating->rate > 3){
            $rating->liked = 1;
        }
        $rating->comments = $request->input('input-comments');
        $rating->date_rated = now();
        $rating->for = 'competition';
        $rating->given_to = $competition->tutor_id;
        $rating->competition_id = $competition->id;
        $rating->save();
        return redirect()->route('competition');
    }
}

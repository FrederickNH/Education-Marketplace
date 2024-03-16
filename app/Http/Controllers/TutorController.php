<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Tutoring;
use App\Models\SubjectTeaches;
use App\Models\Subject;
use App\Models\SeekingTutors;
use App\Models\AcademicHistories;
use App\Models\TutoringRequest;
use App\Models\User;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\School;
use App\Models\Experience;
use App\Models\Booking;
use App\Models\Certificate;
use App\Models\Offers;
use App\Models\Rating;
use App\Models\Award;
use App\Models\Promo;
use App\Models\TutorHoliday;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;


class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();
        $activeClass = Tutoring::where("date",">=", Carbon::now())
                        ->where("tutor_id","=",$tutor->id)
                        ->get()->count();
        $allClass = Tutoring::where("tutor_id","=",$tutor->id)
                        ->get()->count();
        $todayData = Tutoring::where('tutorings.main_tutoring_id',null)
                        ->where('tutor_id',"=",$tutor->id)
                        ->whereMonth('tutorings.created_at','=',Carbon::now())
                        ->count();
        $lastMonth = Tutoring::where('tutorings.main_tutoring_id',null)
                        ->where('tutor_id',"=",$tutor->id)
                        ->whereMonth('tutorings.created_at','=',Carbon::now()->subMonth())
                        ->count();
        $diff = 0;
        if($lastMonth != 0){
            $diff = (($todayData - $lastMonth)/$lastMonth)*100;
        }else{
            $diff = "-100";
        }
        $data = [0,0,0,0,0,0,0,0,0,0,0,0];
        $bookingData = Booking::select(DB::raw('MONTH(bookings.created_at) as month'),DB::raw('COUNT(*) as value'))
                        ->join("tutorings","tutorings.id","=","bookings.tutoring_id")
                        ->where("tutorings.tutor_id", "=", $tutor->id)
                        ->where('bookings.status', '=','paid')
                        ->whereYear('bookings.created_at', Carbon::now()->year)
                        ->groupBy(DB::raw('MONTH(bookings.created_at)'))->get();
        foreach($bookingData as $b){
            if($b->month != null){
                $data[($b->month*1)-1] = $b->value;
            }
        }
        $todayBooking = Booking::where("tutorings.tutor_id","=",$tutor->id)
                            ->join("tutorings","tutorings.id","=","bookings.tutoring_id")
                            ->where("bookings.created_at",">=",Carbon::now()->format('Y-m-d'))
                            ->get()->count();
        // $todayBooking = Tutoring::where("tutorings.tutor_id","=",$tutor->id)
        //                     ->join("bookings","bookings.tutoring_id","=","tutorings.id")
        //                     ->where("bookings.created_at","=",Carbon::now()->format('Y-m-d'))
        //                     ->get();
        //                     dd($todayBooking,$tutor->id);                          
        $nearbyClass = Tutoring::where("date",">=", Carbon::now())
                        ->where("tutor_id","=",$tutor->id)
                        ->orderBy("start_time")
                        ->get();
        // dd($activeClass, $allClass,$nearbyClass,$data);
        // dd($nearbyClass);
        return view("tutor.dashboard",compact("activeClass","allClass","nearbyClass","data",'diff','todayData',"todayBooking"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request);
        $user = Auth::user();
        $tutor = new Tutor();
        $tutor->user_id = $user->id;
        $tutor->description =  $request->input('description');
        $tutor->save();
        $tutorId = $tutor->id;
        for ($i=0; $i <= 6; $i++) { 
            $startTime = 'schedule-start-time-'.$i;
            $endTime = 'schedule-end-time-'.$i;
            $startBreakTime = 'schedule-start-break-time-'.$i;
            $endBreakTime = 'schedule-end-break-time-'.$i;

            $currentYear = date('Y'); 
            $currentWeek = date('W'); 
            $date = Carbon::now()->setISODate($currentYear, $currentWeek, ($i+1));
            $dayName = $date->format('l');
            
            $schedule = new Schedule();
            $schedule->tutor_id = $tutor->id;
            $schedule->day_of_the_week = $dayName;
            $schedule->start_time = $request->input($startTime);
            $schedule->end_time = $request->input($endTime);
            $schedule->start_break_time = $request->input($startBreakTime);
            $schedule->end_break_time = $request->input($endBreakTime);
            $schedule->save(); 
        }

        $experienceCounter = $request->input('dropdownCount');

        if($experienceCounter > 0){
            for ($i=0; $i < $experienceCounter; $i++) { 
                $workPlace = 'company-'.$i;
                $position = 'position-'.$i;
                $jobDesc = 'description-'.$i;
                $startMonth = 'start-month-'.$i;
                $endMonth = 'end-month-'.$i;
    
                $experience = new Experience();
                $experience->tutor_id = $tutorId;
                $experience->workplace = $request->input($workPlace);
                $experience->position = $request->input($position);
                $experience->job_description = $request->input($jobDesc);
                $formattedStartMonth = date('Y-m-d', strtotime($request->input($startMonth).'-01'));
                $experience->start_month = $request->input($formattedStartMonth);
                $formattedEndMonth = date('Y-m-d', strtotime($request->input($endMonth).'-01'));
                $experience->end_month = $request->input($formattedEndMonth);
                
                $experience->save();
            }
        }

        $certificateCounter = $request->input('dropdownCountCertificate');

        if($certificateCounter > 0){
            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
            for ($i=0; $i < $certificateCounter; $i++) { 
                $title = 'certificate-title-'.$i;
                $issued = 'certificate-issued-'.$i;
                $certificatefile = 'certificate-file-'.$i;

                $certificate = new Certificate();
                $certificate->tutor_id = $tutorId;
                $certificate->title = $request->input($title);
                $formattedIssued = date('Y-m-d', strtotime($request->input($issued).'-01'));
                $certificate->date_issued = $formattedIssued;
                $request->validate([
                    $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($certificatefile)) {
                    $image = $request->file($certificatefile);
                    $imageName = $title.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/'.$imageName;
                }else{
                    $certificate->file_path ="certificate-dummy.png";
                }
                $certificate->save();
            }
        }

        $academicCounter = $request->input('dropdownCountHistory');

        if($academicCounter > 0){
            for ($i=0; $i < $academicCounter; $i++) { 
                $schoolName = 'input-academic-school-select-'.$i;
                $graduated = 'academic-graduated-'.$i;
                $academic = new AcademicHistories();

                $academic->tutor_id = $tutorId;
                $academic->school_name = $request->input($schoolName);
                $formattedGraduated = date('Y-m-d', strtotime($request->input($graduated).'-01'));
                $academic->year_graduated = $formattedGraduated;
                $checker = School::where('school_name', $request->input($schoolName))->first();
                if($checker){
                    $academic->school_id = $checker->id;
                }else{
                    $academic->school_id = null;
                }
                
                $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate');
                
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $title = $request->input('academic-certificate-title-'.$i);
                $issued = 'academic-certificate-issued-'.$i;
                $certificatefile = 'academic-certificate-'.$i;

                $certificate = new Certificate();
                $certificate->tutor_id = $tutorId;
                $certificate->title = $title;
                $formattedIssued = date('Y-m-d', strtotime($request->input($issued).'-01'));
                $certificate->date_issued = $formattedIssued;
                $request->validate([
                    $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($certificatefile)) {
                    $image = $request->file($certificatefile);
                    $imageName = $title.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/'.$imageName;
                }else{
                    $certificate->file_path ="certificate-dummy.png";
                }
                $certificate->save();

                $academic->certificate_id = $certificate->id;
                $academic->save();
            }
        }

        $subjectCounter = $request->input('dropdownCountSubject');

        if($subjectCounter > 0){
            for ($i=0; $i < $subjectCounter; $i++) { 
                $subjectName = 'input-subject-select-'.$i;
                $subjectGrade = 'subject-grade-'.$i;

                $subject = new SubjectTeaches();
                $subject->tutor_id = $tutorId;
                $subject->grade = $request->input($subjectGrade);
                
                $checker = Subject::where('name', $request->input($subjectName))->first();
                if($checker){
                    $subject->subject_id = $checker->id;
                }else{
                    $subject->subject_id = null;
                }

                $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $title = $request->input('subject-certificate-title-'.$i);
                $issued = 'subject-certificate-issued-'.$i;
                $certificatefile = 'subject-certificate-'.$i;

                $certificate = new Certificate();
                $certificate->tutor_id = $tutorId;
                $certificate->title = $title;
                $formattedIssued = date('Y-m-d', strtotime($request->input($issued).'-01'));
                $certificate->date_issued = $formattedIssued;

                $request->validate([
                    $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($certificatefile)) {
                    $image = $request->file($certificatefile);
                    $imageName = $title.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/'.$imageName;
                }else{
                    $certificate->file_path ="certificate-dummy.png";
                }
                $certificate->save();
                $subject->status = 'waitingApproval';
                $subject->certificate_id = $certificate->id;
                $subject->save();
            }
        }
        return redirect()->route('welcome');
    }
    public function institutionStore(Request $request){
        $user = Auth::user();
        $tutor = new Tutor();
        $tutor->user_id = $user->id;
        $tutor->institution = 1;
        $tutor->institution_name = $request->input("input-name");
        $tutor->institution_address = $request->input("input-address");
        $tutor->city_id = $request->input("input-city");
        $tutor->subdistrict_id = $request->input("input-subDistrict");
        $tutor->description = $request->input("input-description");

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/institution');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
        $request->validate([
            'input-picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile('input-picture')) {
            $image = $request->file('input-picture');
            $imageName = $user->fname.'_'.$user->lname.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $tutor->institution_picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname."/institution/picture/".$imageName;
        }else{
            $tutor->institution_picture ="defaultUser.jpeg";
        }
        $tutor->save();

        for ($i=0; $i <= 6; $i++) { 
            $startTime = 'schedule-start-time-'.$i;
            $endTime = 'schedule-end-time-'.$i;
            $startBreakTime = 'schedule-start-break-time-'.$i;
            $endBreakTime = 'schedule-end-break-time-'.$i;

            $currentYear = date('Y'); 
            $currentWeek = date('W'); 
            $date = Carbon::now()->setISODate($currentYear, $currentWeek, ($i+1));
            $dayName = $date->format('l');
            
            $schedule = new Schedule();
            $schedule->tutor_id = $tutor->id;
            $schedule->day_of_the_week = $dayName;
            $schedule->start_time = $request->input($startTime);
            $schedule->end_time = $request->input($endTime);
            $schedule->start_break_time = $request->input($startBreakTime);
            $schedule->end_break_time = $request->input($endBreakTime);
            $schedule->save(); 
        }
        $awardCounter = $request->input("dropdownCount");
        if($awardCounter > 0){
            for ($i=0; $i < $awardCounter; $i++) { 
                $awardTitle = 'input-award-title-'.$i;
                $award = new Award();

                $award->tutor_id = $tutor->id;
                $award->title = $request->input($awardTitle);
                
                $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/institution');
                
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $title = $request->input($awardTitle);
                $issued = 'input-award-certificate-issued-'.$i;
                $certificatefile = 'input-award-certificate-'.$i;

                $certificate = new Certificate();
                $certificate->tutor_id = $tutor->id;
                $certificate->title = $title;
                $formattedIssued = date('Y-m-d', strtotime($request->input($issued).'-01'));
                $certificate->date_issued = $formattedIssued;
                $request->validate([
                    $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($certificatefile)) {
                    $image = $request->file($certificatefile);
                    $imageName = $title.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/institution/award/'.$imageName;
                }else{
                    $certificate->file_path ="certificate-dummy.png";
                }
                $certificate->save();

                $award->certificate_id = $certificate->id;
                $award->save();
            }
        }
        $subjectCounter = $request->input('dropdownCountSubject');

        if($subjectCounter > 0){
            for ($i=0; $i < $subjectCounter; $i++) { 
                $subjectName = 'input-subject-select-'.$i;
                $subjectGrade = 'subject-grade-'.$i;

                $subject = new SubjectTeaches();
                $subject->tutor_id = $tutor->id;
                $subject->grade = $request->input($subjectGrade);
                
                $checker = Subject::where('name', $request->input($subjectName))->first();
                if($checker){
                    $subject->subject_id = $checker->id;
                }else{
                    $subject->subject_id = null;
                }

                $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $title = $request->input('subject-certificate-title-'.$i);
                $issued = 'subject-certificate-issued-'.$i;
                $certificatefile = 'subject-certificate-'.$i;

                $certificate = new Certificate();
                $certificate->tutor_id = $tutor->id;
                $certificate->title = $title;
                $formattedIssued = date('Y-m-d', strtotime($request->input($issued).'-01'));
                $certificate->date_issued = $formattedIssued;

                $request->validate([
                    $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                if ($request->hasFile($certificatefile)) {
                    $image = $request->file($certificatefile);
                    $imageName = $title.'.'.$image->getClientOriginalExtension();
                    // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                    $image->move($folderPath, $imageName); // Store the image in the public path

                    // Store the folder path in the database
                    // Add any other necessary logic here
                    $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/'.$imageName;
                }else{
                    $certificate->file_path ="certificate-dummy.png";
                }
                $certificate->save();
                $subject->status = 'waitingApproval';
                $subject->certificate_id = $certificate->id;
                $subject->save();
            }
        }
        return redirect()->route('welcome');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Tutor $tutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutor $tutor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();
        if($request->input('input-description') != $tutor->description){
            $tutor->description = $request->input('input-description');
        }
        $tutor->save();
        return redirect()->route('tutorGet')->with('status', 'Data change successful!');;
    }
    public function institutionUpdate(Request $request)
    {
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)
                    ->where('institution',"=",1)    
                    ->first();
        if($request->input('input-name') != $tutor->institution_name){
            $tutor->institution_name = $request->input('input-name');
        }
        if($request->input('input-address') != $tutor->institution_address){
            $tutor->institution_address = $request->input('input-address');
        }
        if($request->input('input-city') != $tutor->city_id){
            $tutor->city_id = $request->input('input-city');
        }
        if($request->input('input-subDistrict') != $tutor->subdistrict_id){
            $tutor->subdistrict_id = $request->input('input-subDistrict');
        }
        if($request->input('input-description') != $tutor->description){
            $tutor->description = $request->input('input-description');
        }
        $tutor->save();
        return redirect()->route('institutionGet');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
        //
    }

    public function tutorGet(){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();
        return view('tutor.tutorManage',compact('tutor','user'));
    }
    public function institutionGet(){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)
                    ->where('institution',"=",1)    
                    ->first();
        $cityList = City::all();
        $subdistrict = Subdistrict::find($tutor->subdistrict_id);
        $subdis;
        if($subdistrict == null){
            $subdis[0] = 'none';
            $subdis[1] = 0;
            $subdis[2] = "";
        }else{
            $subdis[0] = 'ava';
            $subdis[1] = $subdistrict->id;
            $subdis[2] = $subdistrict->name;
        }
        return view('tutor.institutionManage',compact('tutor','cityList','subdis'));
    }

    public function addHoliday(Request $request){
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('tutors.user_id',$userid)->first();
        $holiday = new TutorHoliday();
        $holiday->tutor_id = $tutor->id;
        $holiday->date = $request->input('holiday');
        $holiday->save();
        return redirect()->route('scheduleList')->with('status','Day off date has been successfuly added!');
    }
    public function scheduleList(Schedule $schedule){
        $user = Auth::user();
        $schedule = Schedule::all();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;
        $scheduleList = $schedule->where("tutor_id",'=',$tutorId); 
        $holidayList = TutorHoliday::where("tutor_id", $tutorId)->get();
        return view('tutor.schedule.scheduleList', compact('scheduleList','holidayList'));
    }

    public function scheduleEdit($id){
        $schedule = Schedule::find($id);
        return response()->json($schedule);
    }

    public function scheduleUpdate(Request $request){
        $itemId = $request->input('editItemId');
        // dd($request->input('editEndBreakTime'));
        $schedule = Schedule::find($itemId);
        $schedule->update([
            'start_time' => $request->input('editStartTime'), // Replace with your form field names
            'end_time' => $request->input('editEndTime'),
            'start_break_time' => $request->input('editStartBreakTime'),
            
        ]);
        $sql = "UPDATE schedules SET end_break_time = ? WHERE id = ?";
        $values = [$request->input('editEndBreakTime'), $itemId];

        DB::update($sql, $values);
        return redirect()->route('scheduleList')->with('status','Schedules has been changed successfuly');
    }

    public function scheduleClear($id){
        $schedule = Schedule::find($id);
        $schedule->update([
            'start_time' => null, // Replace with your form field names
            'end_time' => null,
            'start_break_time' => null,
            'end_break_time' => null,
            // Other fields to update
        ]);
        return redirect()->route('scheduleList');
    }

    public function tutoringList(Tutoring $tutoring){
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;
        $tutoring = Tutoring::where("tutorings.tutor_id", $tutorId)
                        ->join('subject_teaches', 'tutorings.subject_id', '=', 'subject_teaches.id')
                        ->join('subjects','subject_teaches.subject_id','=','subjects.id')
                        ->select('tutorings.*', 'subjects.name as subject_name')
                        ->where("tutorings.main_tutoring_id",'=', null)
                        ->get();
        
        return view('tutor.tutoring.tutoringList', compact('tutoring'));
    }

    public function tutoringCreate(Tutoring $tutoring){
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;
        $subjectList = Subject::where("tutor_id",$tutorId)
                            ->where("status","=","approved")
                            ->join('subject_teaches', 'subjects.id','=','subject_teaches.subject_id')
                            ->select('subject_teaches.*','subjects.name as subject_name')
                            ->get();
        return view('tutor.tutoring.tutoringCreate', compact('subjectList'));
    }
    public function tutoringAdd(Request $request){
        // dd($request);
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;
        $timeBlocked = false;
        $lastID = 0;
        $repCounter = 0;
        $lastDate;
        $tutoring = new Tutoring();
        $tutoring->tutor_id = $tutorId;
        $tutoring->subject_id = $request->get('subject');
        $tutoring->title = $request->get('title');
        $tutoring->banner = $request->get('banner');
        $tutoring->description = $request->get('description');
        $tutoring->date = $request->get('date');
        $tutoring->day = $request->get('day');
        $tutoring->start_time = $request->get('start_time');
        $tutoring->end_time = $request->get('end_time');
        $tutoring->price = $request->input('price');
        $tutoring->method = $request->get('method');
        $tutoring->location = $request->get('location');
        $repetitiveStatus = false;
        if($request->get('repetitive') == 'on'){
            $tutoring->repetitive = true;
        }
        $tutoring->repetitive_duration = $request->get('repetitive_duration');
        $tutoring->mode = $request->get('mode');
        $tutoring->group_size = $request->get('group_size');
        $tutoring->campaign_start = $request->get('campaign_start_time');
        $tutoring->campaign_end = $request->get('campaign_end_time');
        $holidayBlock = false;
        $holiday = TutorHoliday::where('tutor_id',$tutorId)->get();
        foreach($holiday as $h){
            if($h->date == $tutoring->date){
                $holidayBlock = true;
            }
        }
        if($holidayBlock == false){
            $tutoringList = Tutoring::where("tutorings.tutor_id", $tutorId)
                            ->where("tutorings.day",'=',$tutoring->day)
                            ->where("tutorings.date",'=',$tutoring->date)
                            ->join('tutors', 'tutorings.tutor_id', '=', 'tutors.id')
                            ->select('tutorings.*',)
                            ->get();
            $schedule = Schedule::where("schedules.day_of_the_week",$tutoring->day)
                            ->where("schedules.tutor_id",$tutorId)
                            ->get();
            $scheduleStart;
            $scheduleEnd;
            $scheduleBreakStart;
            $scheduleBreakEnd;
            foreach ($schedule as $s) {
                $scheduleStart = $s->start_time;
                $scheduleEnd = $s->end_time;
                $scheduleStartBreak = $s->start_break_time;
                $scheduleEndBreak = $s->end_break_time;
            }
            if(($tutoring->start_time >= $scheduleStart && $tutoring->start_time <= $scheduleEnd)
                &&
            ($tutoring->end_time >= $scheduleStart && $tutoring->end_time <= $scheduleEnd)
                &&
            ($tutoring->start_time < $scheduleStartBreak || $tutoring->start_time >= $scheduleEndBreak)
                &&
            ($tutoring->end_time <= $scheduleStartBreak || $tutoring->end_time > $scheduleEndBreak)
            ){
                foreach($tutoringList as $tut){
                    if(($tutoring->start_time >= $tut->start_time && $tutoring->start_time <= $tut->end_time)
                        ||
                        ($tutoring->end_time >= $tut->start_time && $tutoring->start_time <= $tut->end_time)
                    ){
                        $timeBlocked = true;
                    }
                }
                if($timeBlocked != true){
                    $banner = 'banner';
                    $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutoring/banner');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }
                    $request->validate([
                        $banner => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    ]);
                    if ($request->hasFile($banner)) {
                        $image = $request->file($banner);
                        $imageName = $tutoring->title.$tutoring->id.'.'.$image->getClientOriginalExtension();
                        // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                        $image->move($folderPath, $imageName); // Store the image in the public path

                        // Store the folder path in the database
                        // Add any other necessary logic here
                        $tutoring->banner ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutoring/banner/'.$imageName;
                    }
                    if($tutoring->repetitive == true){
                        $tutoring->save();
                        // $tutoring->main_tutoring_id = $tutoring->id;
                        DB::statement('CALL spAddChildTutoring(?)', array($tutoring->id));
                    }else{
                        $tutoring->save();
                    }

                    return redirect()->route('tutoringList')->with('status', 'Berhasil membuat jadwal tutoring baru!');
                }else{
                    // dd("time is blocked");
                    return redirect()
                            ->route('tutoringCreate')
                            ->with('data', $tutoring)
                            ->with('status', 'Waktu terpakai dengan jadwal lain!');
                }
                
            }else{
                return redirect()->route('tutoringCreate')
                            ->with('data', $tutoring)
                            ->with('status', 'Pilihan Waktu anda berada diluar jadwal yang anda miliki!');
            }       
        }else{
            return redirect()->route('tutoringCreate')
                            ->with('data', $tutoring)
                            ->with('status', 'Pilihan tanggal anda berada pada waktu libur anda!');
        }              
    }
    public function tutoringDetail($id){
        $tutoring = Tutoring::where("tutorings.id",$id)
                        ->join('subject_teaches', 'tutorings.subject_id', '=', 'subject_teaches.id')
                        ->join('subjects','subject_teaches.subject_id','=','subjects.id')
                        ->select('tutorings.*', 'subjects.*', 'subjects.id as subject_id')
                        ->get();
        $listMember = Booking::where('bookings.tutoring_id',$id)
                        ->join("users", "users.id", "=","bookings.user_id")
                        ->select('bookings.*', 'users.*')
                        ->get();
        $listRepetitive = Tutoring::where("main_tutoring_id", $id)
                        ->get();
        return view('tutor.tutoring.tutoringDetail', compact('tutoring','listMember','listRepetitive'));
    }
    public function tutoringClassDetail($id){
        $tutoring = Tutoring::where("tutorings.id",$id)->first();
        $tutoringNext = Tutoring::where("main_tutoring_id",$tutoring->main_tutoring_id)
                            ->where('date','>',$tutoring->date)
                            ->first();
        $tutoringPrev = Tutoring::where("main_tutoring_id",$tutoring->main_tutoring_id)
                            ->where('date','<',$tutoring->date)
                            ->first();
        if($tutoringNext != null){
            $tutoring->next_date = $tutoringNext->date;
        }else{
            $tutoring->next_date = null;
        }
        if($tutoringPrev != null){
            if($tutoringPrev->date > Carbon::now()->format('Y-m-d')){       
                $tutoring->prev_date = $tutoringPrev->date;
            }else{
                $tutoring->prev_date = Carbon::now()->format('Y-m-d');
            }
        }else{
            $tutoring->prev_date = Carbon::now()->format('Y-m-d');
        }
        
        // dd($tutoringNext);
        return response()->json($tutoring);
    }
    public function saveDetailChange(Request $request){
        // dd($request);
        $tutoring = Tutoring::find($request->input('id'));
        $tutoring->date = $request->input('date');
        $tutoring->start_time = $request->input('start_time');
        $tutoring->end_time = $request->input('end_time');
        $tutoring->method = $request->input('method');
        $tutoring->location = $request->input('location');

        $checkDate = Tutoring::where('id', '!=', $tutoring->id)
                    ->where('date', '=', $tutoring->date)
                    ->where(function ($query) use ($tutoring) {
                        $query->whereBetween('start_time', [$tutoring->start_time, $tutoring->end_time])
                            ->orWhereBetween('end_time', [$tutoring->start_time, $tutoring->end_time]);})
                    ->get();
        // dd($checkDate);
        if(count($checkDate) > 0){
            return back()->with('warning','There is other classes for the picked date or time');
        }else{
            $tutoring->update();
            return back()->with('status','Data has been saved');
        }
    }
    public function tutoringGetDetail($id){
        $user = Auth::user();
        $childList = User::where('parent_id',$user->id)->get();
        $tutoring = Tutoring::where("tutorings.id", $id)
                        ->join('subject_teaches', 'tutorings.subject_id', '=', 'subject_teaches.id')
                        ->join('subjects','subject_teaches.subject_id','=','subjects.id')
                        ->join('tutors','tutors.id',"=",'tutorings.tutor_id')
                        ->join('users','users.id','=','tutors.user_id')
                        ->select('users.picture as picture','users.fname as fname','users.lname as lname','tutors.id as tutor_id','tutorings.*', 'subjects.name as subject_name', 'subjects.id as subject_id')
                        ->get();
        $promoList = Promo::where('expire_date','>',Carbon::now())->get();
        $slotCounter = DB::select('select count(id) as count from bookings where tutoring_id = ?', [$id]);
        return view('tutoring.tutoringUserDetail', compact('tutoring','slotCounter','childList','promoList'));
    }
    public function tutorList(){
        $tutorList = Tutor::select("tutors.*","tutors.id as tutor_id","users.*")
                        ->join("users","users.id","=","tutors.user_id")
                        ->get();
        $tList = DB::select('CALL spGetTutoringList()');   
        return view('tutor.user.tutorList',compact('tList'));
    }
    public function tutorDetail($id){
        $tutor = Tutor::find($id);
        $users = User::find($tutor->user_id);
        $currentDateTime = Carbon::now();
        $acdHistory = AcademicHistories::where("academic_histories.tutor_id",$id)->get();
        $holidayList = TutorHoliday::where("tutor_id",$tutor->id)->get();
        $exp = Experience::where("experiences.tutor_id",$id)->get();
        $pastTutoring = Tutoring::where("tutorings.tutor_id",$id);
        $tutoringPastList = Tutoring::where("tutor_id", $tutor->id)
                                    ->where("request_id","=", null)
                                    ->where("main_tutoring_id","=",null)
                                    ->where("seeking_tutor_id","=",null)
                                    ->where("date","<", $currentDateTime->format('Y-m-d'))
                                    ->get();   
        $subjectTeach = Subject::where("subject_teaches.tutor_id",$id)
                            ->join("subject_teaches", "subject_teaches.subject_id","=","subjects.id")
                            ->select("subject_teaches.*","subjects.name as subjectName")
                            ->where("subject_teaches.status","=","approved")
                            ->get();
        $schedule = Schedule::where("schedules.tutor_id",$id)->get();
        $ratingList = Rating::where("given_to",$tutor->id)
                            ->get();       
        $rate = 0;
        $rateCounter = 0;
        foreach ($ratingList as $rating) {
            $rate = $rate + $rating->rate;
        }
        if(count($ratingList) > 0){
            $rate = $rate / count($ratingList);
            $rateCounter = count($ratingList);
        }
        $tutoringList = Tutoring::where("tutor_id", $tutor->id)
                                    ->where("request_id","=", null)
                                    ->where("main_tutoring_id","=",null)
                                    ->where("seeking_tutor_id","=",null)
                                    ->get();          
        return view('tutor.user.tutorDetail',compact('tutor','users','acdHistory','exp','subjectTeach','rate','rateCounter','schedule','tutoringList',"tutoringPastList","pastTutoring","holidayList"));
    }

    public function requestList(){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $requestList = TutoringRequest::where("tutoring_requests.tutor_id",$tutor->id)
                        ->where("tutoring_requests.status","!=","Waiting")
                        ->join("subject_teaches","subject_teaches.id","=","tutoring_requests.subject_id")
                        ->join("subjects","subjects.id","=","subject_teaches.subject_id")
                        ->join("users",'users.id',"=","tutoring_requests.user_id")
                        ->select("tutoring_requests.*","users.fname as UserFName",'users.lname as UserLName','users.picture as UserPicture',"subjects.name as SubjectName")
                        ->get();
        foreach ($requestList as $request) {
            $startHour = Carbon::parse($request->start_time);
            $endHour = Carbon::parse($request->end_time);
            $finalFee = $startHour->diffInHours($endHour);
            $request->fee = $finalFee * $tutor->price;
        }
        return view('tutor.tutoringRequest.requestList',compact('requestList'));                
    }
    public function requestNeedActionList(){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $requestList = TutoringRequest::where("tutoring_requests.tutor_id",$tutor->id)
                        ->where('tutoring_requests.status',"=","Waiting")
                        ->join("subject_teaches","subject_teaches.id","=","tutoring_requests.subject_id")
                        ->join("subjects","subjects.id","=","subject_teaches.subject_id")
                        ->join("users",'users.id',"=","tutoring_requests.user_id")
                        ->select("tutoring_requests.*","users.fname as UserFName",'users.picture as UserPicture','users.lname as UserLName',"subjects.name as SubjectName")
                        ->get();                       
        return view('tutor.tutoringRequest.requestNeedActionList',compact('requestList')); 
    }
    public function requestDetail($id){
        $request = TutoringRequest::where("tutoring_requests.id",$id)
                        ->join("subject_teaches","subject_teaches.id","=","tutoring_requests.id")
                        ->join("subjects","subjects.id","=","subject_teaches.subject_id")
                        ->join("users","users.id","=","tutoring_requests.user_id")
                        ->select("tutoring_requests.*","users.fname as UserFName",'users.lname as UserLName',"users.picture as picture","subjects.name as SubjectName")
                        ->get();
        $tutoringId = Tutoring::where("tutorings.request_id",$id)->first();
        return view('tutor.tutoringRequest.requestDetail',compact('request','tutoringId'));    
    }
    public function requestAccepted($id){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $request = TutoringRequest::find($id);
        $request->status = 'waitingPayment';
        $request->save();
        $user = User::find($request->user_id);
        $subject = SubjectTeaches::where('subject_teaches.id',$request->subject_id)
                                    ->where("subject_teaches.tutor_id", "=",$request->tutor_id)
                                    ->first();
        $tutoring = new Tutoring();
        $tutoring->tutor_id = $tutor->id;
        $tutoring->subject_id = $subject->id;
        $tutoring->title = "Tutoring for $user->fname $user->lname";
        $tutoring->date = $request->date;
        $tutoring->day = $request->day;
        $tutoring->start_time = $request->start_time;
        $tutoring->end_time = $request->end_time;
        $tutoring->price = $tutor->price;
        $tutoring->method = $request->method;
        $tutoring->location = $request->location;
        $tutoring->repetitive = $request->repetitive;
        $tutoring->repetitive_duration = $request->repetitive_duration;
        $tutoring->mode = $request->mode;
        $tutoring->group_size = $request->group_size;
        $tutoring->request_id = $request->id;
        $tutoring->save();
        if($tutoring->repetitive == 1){
            DB::statement('CALL spAddChildTutoring(?)', array($tutoring->id));
        }
        
        return redirect()->route('requestList');
    }
    public function requestRejected($id){
        $request = TutoringRequest::find($id);
        $request->status = 'Rejected';
    }

    public function seekingMarket(){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();
        $seekList = DB::select('call spGetSeekingList(?)', [$tutor->id]);       
        // dd($seekList);             
        return view('tutor.seeking.seekingMarket',compact('seekList'));
    }
    public function seekingList(){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $seeking = SeekingTutors::select("users.fname as UserFName","users.lname as UserLName","users.picture as UserPicture","subjects.name as SubjectName","seeking_tutors.*")
                    ->join("users",'users.id','=','seeking_tutors.user_id')
                    ->join("subjects","subjects.id","=","seeking_tutors.subject_id")
                    ->join("offers",'offers.seeking_tutor_id','=',"seeking_tutors.id")
                    ->where("offers.tutor_id","=",$tutor->id)
                    ->distinct()->get();
        foreach($seeking as $s){
            $offer = Offers::where("offers.seeking_tutor_id",$s->id)->get();
            $status = "no";
            $tutorId = 0;
            foreach($offer as $o){
                if($o->status == "Accepted"){
                    $status = "done";
                    $tutorId = $o->tutor_id;
                }
            }
            if($status == 'done'){
                $s->status = 'done';
                if($tutorId == $tutor->id){
                    $s->winner = true;
                }else{
                    $s->winner = false;
                }
            }
        }
        return view('tutor.seeking.seekingList',compact('seeking'));
    }
    public function offerList($id){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $offer = Offers::where("offers.seeking_tutor_id",$id)
                        ->where("offers.tutor_id","=",$tutor->id)
                        ->get();
        $seek = SeekingTutors::find($id);
        return view('tutor.seeking.offerList',compact('offer','seek'));
    }
    public function offerAdd(Request $request){
        // dd($request);
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $offers = new Offers();
        $offers->tutor_id = $tutor->id;
        $offers->seeking_tutor_id = $request->input('input-id');
        $offers->price = $request->input("input-offer");
        $offers->status = 'Waiting';
        $offers->save();
        $id = $request->input("input-offer") + 0;

        return redirect()->route('offerListTutor',['id' => $offers->seeking_tutor_id]);
    }
    public function seekingDetail($id){
        $seeking = SeekingTutors::select("users.fname as UserFName","users.lname as UserLName","users.picture as UserPicture","subjects.name as SubjectName","seeking_tutors.*")
                        ->join("users",'users.id','=','seeking_tutors.user_id')
                        ->join("subjects","subjects.id","=","seeking_tutors.subject_id")
                        ->where("seeking_tutors.id","=",$id)
                        ->get();
        return view('tutor.seeking.seekingDetail',compact('seeking'));
    }

    public function experienceList(){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $experienceList = Experience::where("tutor_id",$tutor->id)->get();
        return view("tutor.tutorExperience",compact("experienceList"));
    }
    public function experienceAdd(Request $request){
        $user = Auth::user();
        $tutor = Tutor::where("tutors.user_id",$user->id)->first();
        $experience = new Experience();
        $experience->tutor_id = $tutor->id;
        $experience->workplace = $request->input("input-workplace");
        $experience->position = $request->input("input-position");
        $experience->job_description = $request->input("input-job-description");
        $formattedStartMonth = date('Y-m-d', strtotime($request->input("input-start-month").'-01'));
        $experience->start_month =$formattedStartMonth;
        $formattedEndMonth = date('Y-m-d', strtotime($request->input("input-start-month").'-01'));
        $experience->end_month = $formattedEndMonth;
        $experience->save();
    }
    public function academicList(){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();
        $schoolList = School::all();
        $academicList = AcademicHistories::where("tutor_id",$tutor->id)->get();
        return view("tutor.tutorAcademicHistories",compact("schoolList","academicList"));
    }
    public function academicAdd(Request $request){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->first();

        $academic = new AcademicHistories();
        $academic->tutor_id = $tutor->id;
        $academic->school_name = $request->input("input-school");
        $formattedGraduated = date('Y-m-d', strtotime($request->input("input-year-graduated").'-01'));
        $academic->year_graduated = $formattedGraduated;
        $checker = School::where('school_name', $request->input("input-school"))->first();
        if($checker){
            $academic->school_id = $checker->id;
        }else{
            $academic->school_id = null;
        }
        
        $folderPath = public_path('assets/img/userfile/'.$user->id."_".$user->fname."_".$user->lname.'/tutor/academic/certificate');
        
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $certificate = new Certificate();
        $certificate->tutor_id = $tutor->id;
        $certificate->title = $request->input("input-certificate-title");
        $formattedIssued = date('Y-m-d', strtotime($request->input("input-certificate-issued").'-01'));
        $certificate->date_issued = $formattedIssued;
        $request->validate([
            "input-certificate-file" => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile("input-certificate-file")) {
            $image = $request->file("input-certificate-file");
            $imageName = $certificate->title.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $certificate->file_path ='userfile/'.$user->id."_".$user->fname."_".$user->lname.'/tutor/academic/certificate'.$imageName;
        }else{
            $certificate->file_path ="noimage.png";
        }
        $certificate->save();

        $academic->certificate_id = $certificate->id;
        $academic->save();
    }
    public function awardlist(){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->where("institution","=",1)->first();
        $awardList = Award::where("tutor_id",$tutor->id)->get();
        return view("tutor.award.awardList",compact("awardList",));
    }
    public function awardAdd(Request $request){
        $user = Auth::user();
        $tutor = Tutor::where("user_id",$user->id)->where("institution","=",1)->first();

        $award = new Award();
        $award->tutor_id = $tutor->id;
        $award->title = $request->input("input-title");
        
        $folderPath = public_path('assets/img/userfile/'.$user->id."_".$user->fname."_".$user->lname.'/institution/award');
        
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $certificate = new Certificate();
        $certificate->tutor_id = $tutor->id;
        $certificate->title = $request->input("input-title");
        $formattedIssued = date('Y-m-d', strtotime($request->input("input-certificate-issued").'-01'));
        $certificate->date_issued = $formattedIssued;
        $request->validate([
            "input-certificate-file" => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile("input-certificate-file")) {
            $image = $request->file("input-certificate-file");
            $imageName = $certificate->title.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $certificate->file_path ='userfile/'.$user->id."_".$user->fname."_".$user->lname.'/institution/aaward/'.$imageName;
        }else{
            $certificate->file_path ="noimage.png";
        }
        $certificate->save();

        $award->certificate_id = $certificate->id;
        $award->save();
        return redirect()->route('institutionAward');
    }
    public function awardDelete($id){
        $user = Auth::user();
        $award = Award::where('id',$id)->first();
        $award->delete();
    }
}

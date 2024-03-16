<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
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
use App\Models\Competition;
use App\Models\SchoolShuttle;
use App\Models\CompetitionOrganiser;
use App\Models\CompetitionVarian;
use App\Models\Offers;
use App\Models\Rating;
use App\Models\Award;
use App\Models\TutorHoliday;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [0,0,0,0,0,0,0,0,0,0,0,0];
        $bookingData = Booking::select(DB::raw('MONTH(created_at) as month'),DB::raw('COUNT(*) as value'))
                    ->where('status', '=','paid')
                    ->whereYear('created_at',">=", Carbon::now()->year)
                    ->groupBy(DB::raw('MONTH(created_at)'))->get();

        // $dataCompetition =[0,0,0,0,0,0,0,0,0,0,0,0];
        $registerData = CompetitionVarian::select(DB::raw('MONTH(competition_varian_user.registration_date) as month'),DB::raw('COUNT(competition_varian_user.id) as value'))
                    ->rightJoin("competition_varian_user",'competition_varian_user.competition_varian_id','=','competition_varians.id')
                    ->where('competition_varian_user.status', '=','paid')
                    ->whereYear('competition_varian_user.registration_date',">=", Carbon::now()->year)
                    ->groupBy(DB::raw('MONTH(competition_varian_user.registration_date)'))->get();

        
        $bookingData2 = Booking::where('status', '=','paid')
                    ->whereYear('created_at',">=", Carbon::now()->year)
                    ->whereMonth('created_at','>=', Carbon::now()->month)
                    ->get()->count();
        $registerData2 = CompetitionVarian::rightJoin("competition_varian_user",'competition_varian_user.competition_varian_id','=','competition_varians.id')
                    ->where('competition_varian_user.status', '=','paid')
                    ->whereYear('competition_varian_user.registration_date',">=", Carbon::now()->year)
                    ->whereMonth('competition_varian_user.registration_date',">=", Carbon::now()->month)
                    ->get()->count();
        $tutoring = [];
        $tutoring['data'] = Tutoring::whereMonth('tutorings.date','>=',Carbon::now()->month)
                    ->where('tutorings.date','>=',Carbon::now())
                    ->count();
        $tutoring['todayData'] = Tutoring::where('tutorings.main_tutoring_id',null)
                    ->whereMonth('tutorings.date','=',Carbon::now()->month)
                    ->count();
        $tutoring['lastMonth'] = Tutoring::where('tutorings.main_tutoring_id',null)
                    ->whereMonth('tutorings.created_at','=',Carbon::now()->subMonth())
                    ->count();
        
        if($tutoring['lastMonth'] != 0){  
            $tutoring['diff'] = (($tutoring['todayData'] - $tutoring['lastMonth'])/$tutoring['lastMonth'])*100;
        }else{
            $tutoring['diff'] = "-100";
        }
        // dd($tutoring);
        $school = [];
        $school['data'] = School::all()
                    ->count();
        $school['todayData'] = School::whereMonth('schools.created_at','=',Carbon::now()->month)
                    ->count();
        $school['lastMonth'] = School::whereMonth('schools.created_at','=',Carbon::now()->subMonth())
                    ->count();
        if($school['lastMonth'] != 0){  
            $school['diff'] = (($school['todayData'] - $school['lastMonth'])/$school['lastMonth'])*100;
        }else{
            $school['diff'] = "-100";
        }
        $competition = [];
        $competition['data'] = Competition::whereMonth('competitions.competition_start','>=',Carbon::now()->month)
                    ->where('competitions.competition_start','>=',Carbon::now())
                    ->count();
        $competition['todayData'] = Competition::whereMonth('competitions.created_at','=',Carbon::now()->month)
                    ->count();
        $competition['lastMonth'] = Competition::whereMonth('competitions.created_at','=',Carbon::now()->subMonth())
                    ->count();
        // dd($competition);
        if($competition['lastMonth'] != 0){    
            $competition['diff'] = (($competition['todayData'] - $competition['lastMonth'])/$competition['lastMonth'])*100;
        }else{
            $competition['diff'] = "-100";
        }
        $shuttle = [];
        $shuttle['data'] = SchoolShuttle::all()
                    ->count();
        $shuttle['todayData'] = SchoolShuttle::whereMonth('school_shuttles.created_at','=',Carbon::now()->month)
                    ->count();
        $shuttle['lastMonth'] = SchoolShuttle::whereMonth('school_shuttles.created_at','=',Carbon::now()->subMonth())
                    ->count();
        if($shuttle['lastMonth'] != 0){
            $shuttle['diff'] = (($shuttle['todayData'] - $shuttle['lastMonth'])/$shuttle['lastMonth'])*100;
        }else{
            $shuttle['diff'] = "-100";
        }

        foreach($bookingData as $b){
            if($b->month != null){
                $data[($b->month*1)-1] = $b->value;
            }
        }
        foreach($registerData as $b){
            if($b->month != null){
                $data[($b->month*1)-1] = $data[($b->month*1)-1] + $b->value;
            }
        }
        $dataTransaction = [$bookingData2,$registerData2];
        // dd($tutoring,$school,$competition,$shuttle,$data,$dataTransaction);
        return view('dashboard', compact('data','tutoring','school','competition','shuttle','dataTransaction'));
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    public function validatedSubject(){
        $subjectList = SubjectTeaches::where('status','!=','waitingApproval')
                        ->join('subjects','subjects.id','=','subject_teaches.subject_id')
                        ->join('tutors','tutors.id','=','subject_teaches.tutor_id')
                        ->join('users','users.id','=','tutors.user_id')
                        ->join('certificates','certificates.id','=','subject_teaches.certificate_id')
                        ->select('subject_teaches.*','subjects.name as SubjectName', 'users.fname as FName','users.lname as LName','users.picture','certificates.checked_by_admin')
                        ->get();
        return view('admin.validatedSubject',compact('subjectList'));
    }
    public function validateSubject(){
        $subjectList = SubjectTeaches::where('status','=','waitingApproval')
            ->join('subjects','subjects.id','=','subject_teaches.subject_id')
            ->join('tutors','tutors.id','=','subject_teaches.tutor_id')
            ->join('users','users.id','=','tutors.user_id')
            ->join('certificates','certificates.id','=','subject_teaches.certificate_id')
            ->select('subject_teaches.*','subjects.name as SubjectName', 'users.fname as FName','users.lname as LName','users.picture','certificates.checked_by_admin')
            ->get();
        return view('admin.validateSubject',compact('subjectList'));
    }
    public function getCertificate($id){
        $certificate = Certificate::find($id);
        // dd($certificate);
        return response()->json(['data' => $certificate]);
    }
    public function giveSubjectValidation($id,$status){
        $user = Auth::user();
        $admin = Admin::where('user_id',$user->id)->first();
        $subject = SubjectTeaches::find($id);
        $subject->status = $status;
        $certificate = Certificate::find($subject->certificate_id);
        $certificate->admin_id = $admin->id;
        $certificate->checked_by_admin = Carbon::now();
        $subject->save();
        $certificate->save();
        if($status == 'approved'){
            return redirect()->route('validatedSubject')->with('status', 'Tutor teaching subject approved!');
        }else{
            return redirect()->route('validatedSubject')->with('failed', 'Tutor teaching subject declined!');
        }
    }

    public function validatedSchool(){
        $schoolList = School::where("status",'!=','Waiting')->get();
        return view('admin.validatedSchool',compact('schoolList'));
    }
    public function validateSchool(){
        $schoolList = School::where("status",'=','Waiting')->get();
        return view('admin.validateSchool',compact('schoolList'));
    }
    public function giveSchoolValidation($id,$status){
        $user = Auth::user();
        $admin = Admin::where('user_id',$user->id)->first();
        $school = School::find($id);
        $school->status = $status;
        $school->admin_id = $admin->id;
        $school->save();
        if($status == 'Accepted'){
            return redirect()->route('validateSchool')->with('status', 'School application Accepted!');
        }else{
            return redirect()->route('validateSchool')->with('failed', 'School application Rejected!');

        }
    }

    public function validatedOrganisation(){
        $organiserList = CompetitionOrganiser::where("status",'!=','Waiting')->get();
        return view('admin.validatedOrganisation',compact('organiserList'));
    }
    public function validateOrganisation(){
        $organiserList = CompetitionOrganiser::where("status",'=','Waiting')->get();
        return view('admin.validateOrganisation',compact('organiserList'));
    }
    public function giveOrganisationValidation($id,$status){
        $user = Auth::user();
        $admin = Admin::where('user_id',$user->id)->first();
        $organiser = CompetitionOrganiser::find($id);
        $organiser->status = $status;
        $organiser->admin_id = $admin->id;
        $organiser->save();
        if($status == 'Accepted'){
            return redirect()->route('validateOrganisation')->with('status', 'Organisation application Accepted!');
        }else{
            return redirect()->route('validateOrganisation')->with('failed', 'Organisation application Rejected!');
        }
    }
}

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
use App\Models\TutorHoliday;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tigo\Recommendation\Recommend;
use DateTime;
use DateInterval;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        // $recCompe = DB::select('CALL spGetRecomCompetition(?,?)', array($user->id,$user->age));
        // dd($recCompe);  
        $status = 'general';
        $topTutorList = DB::select('CALL spGetTopTutor()');
        $hotSubjectList = DB::select('CALL spGetHotSubject()');
        $topRatedTutorList = DB::select('CALL spTopRatedTutor()');
        $topRatedTutoringList = DB::select('CALL spTopRatedTutoring()');
        $tutorList = [];
        if($user != null){
            $status = 'student';
            $user->age = Carbon::parse($user->birthdate)->age;
            // dd($user);
            if($user->grade == 0){
                $child = User::where("parent_id",$user->id)->first();
                if($child != null){
                    $user->age = Carbon::parse($child->birthdate)->age;
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
        
        return view('index',compact('recCompe','topTutorList','hotSubjectList','topRatedTutorList','topRatedTutoringList','tutorList','status'));
    }
}

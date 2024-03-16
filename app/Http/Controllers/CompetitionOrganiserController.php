<?php

namespace App\Http\Controllers;

use App\Models\CompetitionOrganiser;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Tutor;
use App\Models\Tutoring;
use App\Models\SubjectTeaches;
use App\Models\Subject;
use App\Models\SeekingTutors;
use App\Models\AcademicHistories;
use App\Models\TutoringRequest;
use App\Models\User;
use App\Models\School;
use App\Models\Experience;
use App\Models\Booking;
use App\Models\Certificate;
use App\Models\Offers;
use App\Models\TutorHoliday;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class CompetitionOrganiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $org = CompetitionOrganiser::where("user_id",$user->id)->first();
        $date = Carbon::now();
        $activeComp = Competition::where(function ($query) use ($date) {
                            $query->where('competition_start', '<=', $date)
                                ->where('competition_end', '>=', $date);
                        })
                        ->orWhere('competition_start', '>=', $date)
                        ->where("organiser_id", "=",$org->id)
                        ->get()->count();
                // dd($org,$activeComp);
        $allComp = Competition::where("organiser_id","=",$org->id)
                        ->get()->count();
    
        $todayData = Competition::where('competitions.organiser_id',$org->id)
                        ->whereMonth('competitions.created_at','=',Carbon::now())
                        ->count();
        $lastMonth = Competition::where('competitions.organiser_id',$org->id)
                        ->whereMonth('competitions.created_at','=',Carbon::now()->subMonth())
                        ->count();
        $diff = 0;
        if($lastMonth != 0){
            $diff = (($todayData - $lastMonth)/$lastMonth)*100;
        }else{
            $diff = "-100";
        }
        $data = [0,0,0,0,0,0,0,0,0,0,0,0];
        $regisData = Competition::select(DB::raw('MONTH(competition_varian_user.created_at) as month'),DB::raw('COUNT(*) as value'))
                        ->join("competition_varians","competition_varians.competition_id","=","competitions.id")
                        ->join("competition_varian_user","competition_varian_user.competition_varian_id","=","competition_varians.id")
                        ->where("competitions.organiser_id", "=", $org->id)
                        ->where('competition_varian_user.status', '=','paid')
                        ->whereYear('competition_varian_user.created_at', Carbon::now()->year)
                        ->groupBy(DB::raw('MONTH(competition_varian_user.created_at)'))->get();
        foreach($regisData as $b){
            if($b->month != null){
                $data[($b->month*1)-1] = $b->value;
            }
        }
        $todayRegistration = Competition::where("competitions.organiser_id","=",$org->id)
                            ->join("competition_varians","competitions.id","=","competition_varians.competition_id")
                            ->join('competition_varian_user','competition_varians.id','=',"competition_varian_user.competition_varian_id")
                            ->where("competition_varian_user.created_at",">=",Carbon::now()->format('Y-m-d'))
                            ->get()->count();
        $nearbyComp = Competition::where(function ($query) use ($date) {
                            $query->where('competition_start', '<=', $date)
                                ->where('competition_end', '>=', $date);
                        })
                        // ->orWhere('competition_start', '>=', $date)
                        ->where("organiser_id", "=",$org->id)
                        ->get();
        // dd($activeComp, $allComp,$nearbyComp,$data,$todayData,$lastMonth,$todayRegistration);
        // dd($nearbyClass);
        return view("organiser.dashboard",compact("activeComp","allComp","nearbyComp","data",'diff','todayData',"todayRegistration"));
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
        $organiser = new CompetitionOrganiser();
        $organiser->user_id = $user->id;
        $organiser->org_name = $request->input("input-org-name");
        $organiser->org_email = $request->input("input-org-email");
        $organiser->org_phone = $request->input("input-org-phone");

        $picture = "input-picture";

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser    ');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

        $request->validate([
            $picture => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile($picture)) {
            $image = $request->file($picture);
            $imageName = 'Picture_'.$organiser->org_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $organiser->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser/'.$imageName;
        }else{
            $organiser->picture ="certificate-dummy.png";
        }


        $organiser->pic_name = $request->input("input-org-inCharge-name");
        $inChareFile = "input-org-inCharge-file";

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser/pic/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

        $request->validate([
            $inChareFile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile($inChareFile)) {
            $image = $request->file($inChareFile);
            $imageName = 'PIC_KTP_'.$organiser->pic_name.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $organiser->identity_card ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser/pic/'.$imageName;
        }else{
            $organiser->identity_card ="certificate-dummy.png";
        }
        $organiser->status = "Waiting";
        $organiser->save();
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetitionOrganiser  $competitionOrganiser
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionOrganiser $competitionOrganiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompetitionOrganiser  $competitionOrganiser
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetitionOrganiser $competitionOrganiser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompetitionOrganiser  $competitionOrganiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $organiser = CompetitionOrganiser::where("user_id",$user->id)->first();
        if($request->input('input-org-name') != $organiser->vision){
            $organiser->org_name = $request->input('input-org-name');
        }
        if($request->input('input-org-email') != $organiser->mission){
            $organiser->org_email = $request->input('input-org-email');
        }
        if($request->input('input-org-phone') != $organiser->level){
            $organiser->org_phone = $request->input('input-org-phone');
        }
        if($request->hasFile('input-picture')){
            $picture = "input-picture";

            $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organisation');
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }

            $request->validate([
                $picture => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($request->hasFile($picture)) {
                $image = $request->file($picture);
                $imageName = 'Picture_'.$organiser->org_name.'.'.$image->getClientOriginalExtension();
                // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
                $image->move($folderPath, $imageName); // Store the image in the public path

                // Store the folder path in the database
                // Add any other necessary logic here
                $organiser->picture ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organisation/'.$imageName;
            }else{
                $organiser->picture ="certificate-dummy.png";
            }
        }
        $organiser->save();
        return redirect()->route('organiserGet')->with("status","Data change successful!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetitionOrganiser  $competitionOrganiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionOrganiser $competitionOrganiser)
    {
        //
    }
    public function getOrganiser(){
        $user = Auth::user();
        $organiser = CompetitionOrganiser::where("user_id",$user->id)->first();
        return view("organiser.organiserManage",compact('organiser'));
    }
}

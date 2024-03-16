<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\School;
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
use App\Models\CompetitionOrganiser;
use App\Models\CompetitionVarian;
use App\Models\CompetitionPrize;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $organiser = CompetitionOrganiser::where("user_id",$user->id)->first();
        $competitionList = Competition::where("organiser_id",$organiser->id)->get();
        return view('organiser.competitionList', compact('competitionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectList = Subject::all();
        return view('organiser.competitionAdd',compact('subjectList'));
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
        $organiser = CompetitionOrganiser::where("user_id",$user->id)->first();
        $competition = new Competition();
        $competition->organiser_id = $organiser->id;
        $competition->title = $request->input("input-title");
        $competition->description = $request->input("input-description");
        $competition->subject_id = $request->input("input-subject");
        $competition->allowed_team_member = $request->input("input-allowed-member");
        $competition->campaign_start = $request->input("input-campaign-start");
        $competition->campaign_end = $request->input("input-campaign-end");
        $competition->competition_start = $request->input("input-competition-start");
        $competition->competition_end = $request->input("input-competition-end");
        $brochureFile = "input-brochure";
        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser/competition/brochure');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

        $request->validate([
            $brochureFile => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        if ($request->hasFile($brochureFile)) {
            $image = $request->file($brochureFile);
            $imageName = 'Brochure_'.$competition->title.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->id.$user->fname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $competition->brochure ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/organiser/competition/brochure/'.$imageName;
        }else{
            $competition->brochure ="noimage.png";
        }
        $competition->save();

        $helperVariant = $request->input("dropdownCountVariant");
        if($helperVariant > 0){    
            for($i=0;$i<$helperVariant;$i++){
                $variant = new CompetitionVarian();
                $variant->competition_id = $competition->id;
                $variant->name = $request->input('input-variant-name-'.$i);
                $variant->price = $request->input('input-variant-price-'.$i);
                $variant->min_age = $request->input('input-variant-min-age-'.$i);
                $variant->max_age = $request->input('input-variant-max-age-'.$i);
                $variant->slot = $request->input('input-variant-slot-'.$i);
                $variant->save();
                $helperPrize = $request->input('dropdownCountPrize-'.$i);
                if($helperPrize > 0){
                    for($j=0;$j<$helperPrize;$j++){
                        $prize = new CompetitionPrize();
                        $prize->varian_id = $variant->id;
                        $prize->rank_no = $request->input('input-variant-'.$i.'-prize-'.$j.'-rank');
                        $prize->money_prize = $request->input('input-variant-'.$i.'-prize-'.$j.'-money');
                        $prize->other_prize = $request->input('input-variant-'.$i.'-prize-'.$j.'-other');
                        $prize->save();
                    }
                }
            }
        }
        return redirect()->route('competitionGet')->with("status","Competition has successfuly been made!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        //
    }
    public function detail($id){
        $competition = Competition::where("competitions.id",$id)
                        ->join('subjects','subjects.id','=','competitions.subject_id')
                        ->select("competitions.*","subjects.name as subjectName")
                        ->first();
        $variantList = CompetitionVarian::where("competition_id",$competition->id)->get();
        foreach ($variantList as $variant) {
            $prizeList = CompetitionPrize::where("varian_id",$variant->id)->get();
            $variant->prize = $prizeList;
            $variant->member = $variant->user;
        }   
        return view('organiser.competitionDetail', compact("competition","variantList"));
        // foreach varian list get variant
        // foreach variant->prize get prize list :)

    }
    public function getMemberDetail($vId,$mId){
        $member = CompetitionVarian::find($vId)
                    ->user()
                    ->wherePivot("user_id",$mId)
                    ->first();
        $memberList = [];
        array_push($memberList,$member->pivot->school_origin);
        array_push($memberList,$member->pivot->registration_date);
        $rawNameData = $member->pivot->participant_name;
        $nameArray = explode("|",$rawNameData);
        $rawPhoneData = $member->pivot->participant_phone;
        $phoneArray = explode("|",$rawPhoneData);
        for ($i=0; $i < count($nameArray); $i++) { 
            $m = new User();
            $m->name = $nameArray[$i];
            $m->phone = $phoneArray[$i];
            array_push($memberList,$m);

        }
        return response()->json($memberList);
    }
}

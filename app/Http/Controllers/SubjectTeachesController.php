<?php

namespace App\Http\Controllers;

use App\Models\SubjectTeaches;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
class SubjectTeachesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;

        $subjectTeachesList = Subject::where("subject_teaches.tutor_id",$tutorId)
                            ->join('subject_teaches', 'subjects.id','=','subject_teaches.subject_id')
                            ->join('certificates', 'certificates.id','=','subject_teaches.certificate_id')
                            ->select('subject_teaches.*','subjects.name as subject_name','certificates.file_path as file_path')
                            ->get();
        $subjectList = Subject::all();
        return view('tutor.subjectTeaches.subjectTeachList', compact('subjectList','subjectTeachesList'));
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
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;
        dd($request);
        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/');
                
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $certificate = new Certificate();
        $certificate->tutor_id = $tutorId;
        $certificate->title = $request->get('certificate_title');
        $formattedIssued = date('Y-m-d', strtotime($request->get('date_issued').'-01'));
        $certificate->date_issued = $request->get($formattedIssued);
        $certificatefile = $request->get('certificate');

        $request->validate([
            $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile($certificatefile)) {
            $image = $request->file($certificatefile);
            $imageName = $title.'.'.$image->getClientOriginalExtension();
            // $folderPath = 'assets/img/userfile/'.$user->fname.$user->lname.'/'; // Set the desired folder path relative to the public directory
            $image->move($folderPath, $imageName); // Store the image in the public path

            // Store the folder path in the database
            // Add any other necessary logic here
            $certificate->file_path ='userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/'.$imageName;
        }else{
            $certificate->file_path ="certificate-dummy.png";
        }
        $certificate->save();


        // $certificate = new Certificate();
        // $certificate->tutor_id = $tutorId;
        // $certificate->title = $request->get('certificate_title');
        // $certificate->date_issued = $request->get('date_issued');
        // $certificate->file_path = $request->get('certificate');
        // $certificate->save();

        $subjectTeaches = new SubjectTeaches();
        $subjectTeaches->tutor_id = $tutorId;
        $subjectTeaches->subject_id = $request->get('subject');
        $subjectTeaches->grade = $request->get('grade');
        $subjectTeaches->certificate_id = $certificate->id;
        $subjectTeaches->status = 'waitingApproval';
        $subjectTeaches->save();

        // return redirect()->route('subjectList')->with('status', 'Berhasil menambah subject baru!');
    }

    public function subjectAdd(Request $request){
        $user = Auth::user();
        $userid = $user->id;
        $tutor = Tutor::where('user_id',$userid)->first();
        $tutorId = $tutor->id;

        $subjectName = 'subject';
        $subjectGrade = 'grade';

        $subject = new SubjectTeaches();
        $subject->tutor_id = $tutorId;
        $subject->grade = $request->input($subjectGrade);
        $subject->subject_id = $request->input($subjectName);

        $folderPath = public_path('assets/img/userfile/'.$user->id.'_'.$user->fname.'_'.$user->lname.'/tutor/certificate/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $title = $request->input('certificate_title');
        $issued = $request->input('date_issued');
        $certificatefile = 'certificatefile';

        $certificate = new Certificate();
        $certificate->tutor_id = $tutorId;
        $certificate->title = $request->input($title);
        $formattedIssued = date('Y-m-d', strtotime($issued.'-01'));
        $certificate->date_issued = $formattedIssued;
        
        $request->validate([
            $certificatefile => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile($certificatefile)) {
            $image = $request->file($certificatefile);
            $imageName = $title.$issued.'.'.$image->getClientOriginalExtension();
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
        return redirect()->route('subjectList')->with('status', 'Berhasil menambah subject baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectTeaches  $subjectTeaches
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectTeaches $subjectTeaches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectTeaches  $subjectTeaches
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectTeaches $subjectTeaches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectTeaches  $subjectTeaches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectTeaches $subjectTeaches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectTeaches  $subjectTeaches
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectTeaches $subjectTeaches)
    {
        //
    }

    public function subjectRemove($id){
        SubjectTeaches::where('id', $id)->delete();
        return redirect()->route('subjectList')->with('status', 'Berhasil menghapus subject!');
    }
}

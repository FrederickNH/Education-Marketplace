<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectList = Subject::all();
        return view('subject.subjectList', compact('subjectList'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }

    public function subjectTutoringList(Request $request,$id){

        $tutoringList = Tutoring::select("tutorings.*")
                            ->join("subject_teaches","subject_teaches.id","=","tutorings.subject_id")
                            ->join("subjects",'subjects.id','=','subject_teaches.subject_id')
                            ->where("subjects.id",'=',$id)
                            ->where("tutorings.main_tutoring_id",'=', null)
                            ->where("tutorings.request_id", "=", null)
                            ->where("tutorings.seeking_tutor_id","=",null);
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
        $listTutoring = $tutoringList->get();
        return view('subject.subjecttutoringlist', compact('listTutoring','id'));
    }
}

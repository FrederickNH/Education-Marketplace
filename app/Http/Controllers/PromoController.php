<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
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
        $promo = new Promo();
        $promo->name  = $request->input('input-name');
        $promo->description  = $request->input('input-desc');
        $promo->in_form  = $request->input('input-in-form');
        $promo->discount  = $request->input('input-discount');
        $promo->expire_date  = $request->input('input-expire');
        $promo->save();
        return redirect()->route('promoList')->with('status','Promo has successfuly been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promo = Promo::find($id);

        return response()->json($promo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $promo = Promo::find($request->input('edit-id'));
        if($promo->name != $request->input('edit-name')){
            $promo->name = $request->input('edit-name');
        }
        if($promo->description != $request->input('edit-desc')){
            $promo->description = $request->input('edit-desc');
        }
        if($promo->in_form != $request->input('edit-in-form')){
            $promo->in_form = $request->input('edit-in-form');
        }
        if($promo->discount != $request->input('edit-discount')){
            $promo->discount = $request->input('edit-discount');
        }
        if($promo->expire_date != $request->input('edit-expire')){
            $promo->expire_date = $request->input('edit-expire');
        }
        $promo->update();
        return redirect()->route('promoList')->with('status','Updating promo succesful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        //
    }

    public function promoList(){
        $promoList = Promo::where('expire_date','>', Carbon::now())
                        ->select('promos.*',DB::raw("'available' as status"))
                        ->get();
        $expiredPromo = Promo::where('expire_date','<=', Carbon::now())
                        ->select('promos.*',DB::raw("'expired' as status"))
                        ->get();
        $promoList = $promoList->merge($expiredPromo);
        return view('admin.promo.promoList',compact('promoList'));
    }
}

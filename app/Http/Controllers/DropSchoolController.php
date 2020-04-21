<?php

namespace App\Http\Controllers;

use App\Drop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DropSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Auth::user()->data;
        }catch (\Exception $e){
            Log::error('DropSchool.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.drop_school',compact('data'));
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
        $validatedData = $request->validate([
            'reason' => 'required'
        ]);
        try{
            DB::transaction(function ()use($request){
                Drop::create([
                    'student'=>Auth::user()->id,
                    'item'=>$request->item,
                    'term'=>'0',
                    'drop_year'=>$request->drop_year,
                    'reason'=>$request->reason
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('DropSchool.store '.$e->getMessage());
            return back()->withErrors('申請錯誤');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}

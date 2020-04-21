<?php

namespace App\Http\Controllers;

use App\Drop;
use App\Events\DropEvent;
use App\Events\DropInEvent;
use App\Listeners\DropInListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DropMGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('drop.view');
        $this->authorize('drop_in.view');
        try{
            $type = $request->query('type',1);
            $data = Drop::where('item',$type)->get();
        }catch (\Exception $e){
            Log::error('dropMG.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.Drop.index',compact('type','data'));
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
    public function edit(Drop $drop,Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drop $drop)
    {
        try{
            DB::transaction(function ()use($drop,$request){
                $drop->update(['term'=>$request->term]);
                if($request->term == 1){
                    $student_id = $drop->student_data->account;
                    if($drop->item == 1){
                        $this->authorize('drop.update');
                        $drop->student_data->update(['account'=>str_replace("e",'n',$student_id)]);
                        $drop->student_data->data->update(['stay_in_school'=>0]);
                        //寄信
                        event(new DropEvent($drop->student));
                    }else{
                        $this->authorize('drop_in.update');
                        $drop->student_data->update(['account'=>str_replace("n",'e',$student_id)]);
                        $drop->student_data->data->update(['stay_in_school'=>1]);
                        //寄信
                        event(new DropInEvent($drop->student));
                    }
                }
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('dropMG.edit'.$e->getMessage());
            return back();
        }

        return back();
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

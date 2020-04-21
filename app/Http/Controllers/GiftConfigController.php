<?php

namespace App\Http\Controllers;

use App\Exports\GiftExport;
use App\Gift;
use App\GiftItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class GiftConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $item = GiftItem::all();
            $data = Gift::paginate(30);
        }catch (\Exception $e){
            Log::error('GiftConfig.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.Gift.List.index',compact('item','data'));
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

    public function update_status(Request $request){

        try{
            DB::transaction(function ()use($request){
                if(count($request->list) != 0){
                    foreach ($request->list as $l){
                        Gift::find($l)->update(['send_status'=>1]);
                    }
                }
            });
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            Log::info('GiftConfig.update_status '.$e->getMessage());
        }

        return back();
    }

    public function export(Request $request){
        //todo:要建立自動欄位
        return Excel::download(new GiftExport($request->list),'gift.xlsx');
    }
}

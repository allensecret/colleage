<?php

namespace App\Http\Controllers;

use App\GiftItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GiftItemConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('gift_item.view');
        try{
            $data = GiftItem::all();
        }catch (\Exception $e){
            Log::error('giftItem.index '.$e->getMessage());
        }
        return view('MGplatform.Gift.Item.index',compact('data'));
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
        $this->authorize('gift_item.create');
        $request->validate([
            'name' => 'required'
        ]);
        try{
            DB::transaction(function ()use($request){
                GiftItem::create([
                    'name'=>$request->name
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('gitItem.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增失敗');
        }

        return back()->with('新增成功');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiftItem $gift_item)
    {
        $this->authorize('gift_item.update');
        $request->validate([
            'name' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$gift_item){
                $gift_item->update(['name'=>$request->name]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('giftItem.update '.$e->getMessage());
            return back()->withErrors('修改失敗');
        }

        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiftItem $gift_item)
    {
        $this->authorize('gift_item.delete');
        try{
            DB::transaction(function ()use($gift_item){
                $gift_item->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('giftItem.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }

        return back()->with('success','刪除成功');
    }
}

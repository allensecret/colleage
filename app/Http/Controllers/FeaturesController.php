<?php

namespace App\Http\Controllers;

use App\Features;
use App\FeaturesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Features::all();
        }catch (\Exception $e){
            Log::error('features.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('MGplatform.Function.index',compact('data'));
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
        $request->validate([
           'name' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request){
                Features::create(['name'=> $request->name]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.store '.$e->getMessage());
            return back()->withErrors('新增錯誤');
        }

        return back()->with('新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Features $feature)
    {
        return view('MGplatform.Function.detail',compact('feature'));
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
    public function update(Request $request, Features $feature)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$feature){
                $feature->update(['name'=> $request->name]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.update '.$e->getMessage());
            return back()->withErrors('修改錯誤');
        }

        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Features $feature)
    {
        try{
            DB::transaction(function ()use($feature){
                $feature->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }

        return back()->with('success','刪除成功');
    }

    public function item_create(Request $request,Features $feature){
        $request->validate([
           'item' => 'required',
           'name' => 'required',
           'option' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$feature){
                $option = "";
                foreach ($request->option as $o){
                    $option .= $o.';';
                }

                FeaturesItem::create([
                    'feature' => $feature->id,
                    'item' => $request->item,
                    'name' => $request->name,
                    'option' => $option
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.item_create '.$e->getMessage());
            return back()->withErrors('新增失敗');
        }
        return back()->with('success','新增成功');
    }

    public function item_update(Request $request,FeaturesItem $item){
        $request->validate([
            'item' => 'required',
            'name' => 'required',
            'option' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$item){
                $option = "";
                foreach ($request->option as $o){
                    $option .= $o.';';
                }

                $item->update([
                    'item' => $request->item,
                    'name' => $request->name,
                    'option' => $option
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.item_update '.$e->getMessage());
        }

        return back();
    }

    public function item_delete(FeaturesItem $item){
        try{
            DB::transaction(function ()use($item){
                $item->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('features.item_delete '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }

        return back()->with('刪除成功');
    }
}

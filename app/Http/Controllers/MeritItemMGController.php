<?php

namespace App\Http\Controllers;

use App\Merit;
use App\MeritItem;
use App\MeritItemGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MeritItemMGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $this->authorize('merit_item.view');
            $data = Merit::all();
        }catch (\Exception $e){
            Log::error('meritItem.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.Merit_item.index',compact('data'));
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
        $this->authorize('merit_item.create');
        $validatedData = $request->validate([
            'item' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request){
                MeritItem::create(['merit'=>$request->merit,'item'=>$request->item,'group'=>$request->group]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritItem.store '.$e->getMessage());
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
    public function show(Merit $merit_item_MG)
    {
        $this->authorize('merit_item.view');
        try{
            $data = $merit_item_MG;
            $list_group = MeritItemGroup::where('merit',$data->id)->get();
        }catch (\Exception $e){
            Log::error('meritItem.show '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }

        return view('MGplatform.Merit_item.show',compact('data','list_group'));
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
    public function update(Request $request, MeritItem $merit_item_MG)
    {
        $this->authorize('merit_item.update');
        $validatedData = $request->validate([
            'item' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$merit_item_MG){
                $merit_item_MG->update(['group'=>$request->group,'item'=>$request->item]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritItem.update '.$e->getMessage());
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
    public function destroy(MeritItem $merit_item_MG)
    {
        $this->authorize('merit_item.delete');
        try{
            DB::transaction(function ()use($merit_item_MG){
                $merit_item_MG->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritItem.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }

    public function add_group(Request $request){

        $this->authorize('merit_item.create');
        $validatedData = $request->validate([
            'group' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request){
                MeritItemGroup::create(['merit'=>$request->merit,'name'=>$request->group]);
            });
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('meritItem.add_group '.$e->getMessage());
            return back()->withErrors('新增群組失敗');
        }

        return back()->with('新群組成功');
    }
}

<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\BulletinReplie;
use App\BulletinType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('bulletin.view');
        try{
            $select = $request->query('id',1);
            $type = BulletinType::all();
            $news = Bulletin::where('type',$select)->get();
        } catch (\Exception $e) {
            Log::error('Bulletin.index '.$e->getMessage());
            abort(403, '頁面資訊錯誤');
        }
        return view('MGplatform.Bulletin.announcement' , compact('type','select','news'));
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
        $this->authorize('bulletin.create');
        $validatedData = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);
        try{
            DB::transaction(function ()use($request,$validatedData){
                Bulletin::create($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('Bulletin.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增錯誤');
        }
        return back()->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bulletin $bulletin)
    {
        $this->authorize('bulletin.view');
        try{
            $type = BulletinType::all();
        }catch (\Exception $e){
            Log::error('Bulletin.show '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('MGplatform.Bulletin.replies',compact('bulletin','type'));
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
     * @param \Illuminate\Http\Request $request
     * @param Bulletin $bulletin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bulletin $bulletin)
    {
        $this->authorize('bulletin.update');
        try{
            DB::transaction(function ()use($request,$bulletin){
                $validatedData = $request->validate([
                    'type' => 'required',
                    'title' => 'required',
                    'content' => 'required',
                ]);
                $bulletin->update($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('Bulletin.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }

        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bulletin $bulletin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bulletin $bulletin)
    {
        $this->authorize('bulletin.delete');
        try{
            DB::transaction(function ()use($bulletin){
                $bulletin->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Bulleitn.destroy '.$e->getMessage());
            return back()->withErrors('刪除錯誤');
        }
        return redirect()->route('bulletin.index',['id'=>$bulletin->type])->with('success','刪除成功');
    }

    public function create_type(Request $request)
    {
        $this->authorize('bulletin.create');
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        try{
            DB::transaction(function ()use($validatedData){
                BulletinType::create($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Bulletin.create_type '.$e->getMessage());
            return back()->withErrors('新增錯誤');
        }
        return back()->with('success','新增成功');
    }

    public function delete_relies(BulletinReplie $replies){
        $this->authorize('bulletin.delete');
        try{
            DB::transaction(function ()use($replies){
                $replies->delete();
            });
        }catch (\Exception $e){
            Log::error('Bulletin.delete_relies'.$e->getMessage());
            return back()->withErrors('刪除錯誤');
        }

        return back()->with('success','刪除成功');
    }
}

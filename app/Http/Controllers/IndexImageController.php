<?php

namespace App\Http\Controllers;

use App\Page;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IndexImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Page::where('item','index_image')->get();
        }catch (\Exception $e){
            Log::error('indexImage.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.EditPage.index_image.index',compact('data'));
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
           'image' => 'required|file|image:jpeg,png'
        ]);

        try{
            DB::transaction(function ()use($request){
                if($request->hasFile('image')){
                    $imagefilename = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('public/index_img',$imagefilename);
                    Page::create([
                        'item'=>'index_image',
                        'img'=>$imagefilename,
                        'remark' => '首頁輪播圖'
                    ]);
                }
            });
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            Log::error('indexImage.store '.$e->getMessage());
            return back()->withErrors('新增失敗');
        }

        return back()->with('success','新增成功');
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
    public function update(Request $request, Page $indexImage)
    {
        $request->validate([
            'image' => 'required|file|image:jpeg,png'
        ]);

        try{
            DB::transaction(function ()use($request,$indexImage){
                if($request->hasFile('image')){
                    //刪除舊有圖片
                    Storage::delete(['public/index_img/'.$indexImage->img]);
                    //新增圖片
                    $imagefilename = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('public/index_img',$imagefilename);
                    $indexImage->update([
                        'img'=>$imagefilename,
                    ]);
                }
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('indexImage.update '.$e->getMessage());
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
    public function destroy(Page $indexImage)
    {
        try{
            DB::transaction(function ()use($indexImage){
                Storage::delete(['public/index_img/'.$indexImage->img]);
                $indexImage->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('indexImage.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}

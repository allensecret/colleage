<?php

namespace App\Http\Controllers;

use App\Magazine;
use App\MagazineFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MagazineMgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('magazine.view');
        try{
            $year = $request->query('year','2020');
            $data = Magazine::where('year',$year)->orderBy('created_at','desc')->get();
        }catch (\Exception $e){
            Log::error('magazineMG.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.Magazine.index',compact('data','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

        }catch (\Exception $e){
            Log::error('magazineMG.create '.$e->getMessage());
        }
        return view('MGplatform.Magazine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('magazine.create');
        $request->validate([
            'id' => 'required',
            'file' => 'required|file|mimes:pdf',
            'gb_file' => 'required|file|mimes:pdf',
            'image' => 'required|file|image|mimes:png,jpeg',
            'image_b' => 'required|file|image|mimes:png,jpeg',
            'intro' => 'required',
            'year' => 'required',
        ],[
            'id.required'   => '為必填欄位',
            'file.required' => '雜誌檔案為必填欄位',
            'file'          => '必須上傳檔案',
            'gb_file.required' => '雜誌檔案為必填欄位',
            'gb_file'          => '必須上傳檔案',
            'image.required'=> '圖片為必填欄位',
            'image'         => '必須為圖片',
            'image_b.required'=> '圖片為必填欄位',
            'image_b'         => '必須為圖片',
            'intro.required'=> '簡介為必填欄位',
            'mimes'         => '檔案格式不符合',
        ]);
        try{
            DB::transaction(function ()use($request){
                if($request->hasFile('file') && $request->hasFile('gb_file') && $request->hasFile('image') && $request->hasFile('image_b')){
                    $filename = $request->file('file')->getClientOriginalName();
                    $gb_filename = $request->file('file')->getClientOriginalName();
                    $imagefilename = $request->file('image')->getClientOriginalName();
                    $image_Bfilename = $request->file('image_b')->getClientOriginalName();
                    $request->file('file')->storeAs('public/magazine_file',$filename);
                    $request->file('gb_file')->storeAs('public/magazine_file',$gb_filename);
                    $request->file('image')->storeAs('public/magazine_img',$imagefilename);
                    $request->file('image_b')->storeAs('public/magazine_img',$image_Bfilename);
                }

                Magazine::create([
                    'id' => $request->id,
                    'file' => $filename,
                    'gb_file' => $gb_filename,
                    'image' => $imagefilename,
                    'image_b'=> $image_Bfilename,
                    'year' => $request->year,
                    'intro' => $request->intro
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('magazineMg.store '.$e->getMessage());
            return back()->withErrors('新增錯誤');
        }

        return redirect()->route('magazineMG.index')->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Magazine $magazineMG)
    {
        $this->authorize('magazine.view');
        try{

        }catch (\Exception $e){
            Log::error('magazineMG.show '.$e->getMessage());
            abort('403');
        }
        return view('MGplatform.Magazine.edit',compact('magazineMG'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Magazine $magazineMG)
    {
        $this->authorize('magazine.update');
        try{

        }catch (\Exception $e){
            Log::error('magazineMG.edit ',$e->getTrace());
            abort(403,'頁面資訊錯誤');
        }
       return view('MGplatform.Magazine.update',compact('magazineMG'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazine $magazineMG)
    {
        $this->authorize('magazine.update');
        $request->validate([
            'id' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'gb_file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|file|image|mimes:png,jpeg',
            'image_b' => 'nullable|file|image|mimes:png,jpeg',
            'intro' => 'required',
            'year' => 'required',
        ],[
            'id.required'   => '為必填欄位',
            'file.required' => '雜誌檔案為必填欄位',
            'file'          => '必須上傳檔案',
            'image.required'=> '圖片為必填欄位',
            'mimes'         => '檔案格式不符合',
            'image'         => '必須為圖片',
            'image_b'         => '必須為圖片',
            'intro.required'=> '簡介為必填欄位'
        ]);

        try{
            DB::transaction(function ()use($request,$magazineMG){
                $magazineMG->id = $request->id;

                if($request->hasFile('file')){
                    Storage::delete(['public/magazine_file/'.$magazineMG->file]);
                    $filename = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('public/magazine_file',$filename);
                    $magazineMG->file = $filename;
                }

                if($request->hasFile('gb_file')){
                    Storage::delete(['public/magazine_file/'.$magazineMG->gb_file]);
                    $gb_filename = $request->file('gb_file')->getClientOriginalName();
                    $request->file('gb_file')->storeAs('public/magazine_file',$gb_filename);
                    $magazineMG->gb_file = $gb_filename;
                }

                if($request->hasFile('image')){
                    Storage::delete(['public/magazine_img/'.$magazineMG->image]);
                    $imagefilename = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('public/magazine_img',$imagefilename);
                    $magazineMG->image = $imagefilename;
                }

                if($request->hasFile('image_b')){
                    Storage::delete(['public/magazine_img/'.$magazineMG->image_b]);
                    $image_bfilename = $request->file('image_b')->getClientOriginalName();
                    $request->file('image_b')->storeAs('public/magazine_img',$image_bfilename);
                    $magazineMG->image_b = $image_bfilename;
                }

                $magazineMG->intro = $request->intro;
                $magazineMG->year = $request->year;
                $magazineMG->save();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('magazineMG.update '.$e->getMessage());
            return redirect()->route('magazineMG.show',['magazineMG'=>$magazineMG])->withErrors('修改失敗');
        }
        return redirect()->route('magazineMG.show',['magazineMG'=>$magazineMG])->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazine $magazineMG)
    {
        $this->authorize('magazine.delete');
        try{
            DB::transaction(function ()use($magazineMG){
                $year = date('Y',strtotime($magazineMG->created_at));
                Storage::delete(['public/magazine_img/'.$magazineMG->image,'public/magazine_file/'.$magazineMG->file]);
                $magazineMG->delete();
            });

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('magazineMG.destroy '.$e->getMessage());
            return back()->with('刪除失敗');
        }

        return redirect()->route('magazineMG.index',['year'=>$magazineMG->year])->with('success','刪除成功');
    }
}

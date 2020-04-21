<?php

namespace App\Http\Controllers;

use App\Classes\txtRead;
use App\CourseData;
use App\CurriculaMedia;
use App\CurriculaResource;
use App\Hosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('course_data.view');
        try{
            $data = CourseData::all();
        }catch (\Exception $e){
            Log::error('course_data.index '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.Course_data.course_data',compact('data'));
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
        $this->authorize('course_data.create');
        $validatedData = $request->validate([
            'sn' => 'required',
            'title' => 'required',
            'teacher' => 'required',
            'separation' => 'nullable',
            'start_ep' => 'required',
            'end_ep' => 'required',
            'type' => 'required',
            'introduction' => 'nullable'
        ]);

        try{
            DB::transaction(function ()use($request){
                $data = CourseData::create([
                    'sn' => $request->sn,
                    'title' => $request->title,
                    'separation' => $request->separation,
                    'ep' => ($request->end_ep - $request->start_ep)+1,
                    'start_ep' => $request->start_ep,
                    'end_ep' => $request->end_ep,
                    'type' => $request->type,
                    'teacher' => $request->teacher,
                    'introduction' => $request->introduction
                ]);

                $media_type = ['txt','pdf','doc','big5gb'];
                $sn = mb_split("-",$request->sn);
                for($i=$request->start_ep;$i<=$request->end_ep;$i++){
                    $media = new CurriculaMedia;
                    $media->course_data = $data->id;
                    $media->ep = $i;
                    $media->attr = '/media/'.$request->type.'/'.$sn[0].'/'.$request->sn.'/'.$request->sn.'-'.sprintf("%04d", $i).'.'.$request->type;
                    $media->save();

                    foreach ($media_type as $t){
                        CurriculaResource::create([
                            'course_data' => $data->id,
                            'media' => $media->id,
                            'ep' => $i,
                            'type' => $t,
                            'attr' => '/ft.php?sn='.$request->sn.'-'.sprintf("%04d", $i).'&docstype='.$t.'&lang=zh_TW',
                        ]);
                    }
                }
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('course_data.store '.$e->getMessage());
            return back()->withErrors('新增失敗');
        }
        return back()->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param CourseData $course_datum
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(CourseData $course_datum,Request $request)
    {
        $this->authorize('course_data.update');
        try{
            $data = $course_datum->get_media()->paginate(6);
            $host = Hosts::find($request->query('host',1));
            $txt = new txtRead();
        }catch (\Exception $e){
            Log::error('course_data.show '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.Course_data.course_media',compact('data','txt','host','course_datum'));
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
     * @param  \Illuminate\Http\Request $request
     * @param CourseData $course_datum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseData $course_datum)
    {
        $this->authorize('course_data.update');
        $validatedData = $request->validate([
            'sn' => 'required',
            'title' => 'required',
            'teacher' => 'required',
            'separation' => 'nullable',
            'start_ep' => 'required',
            'end_ep' => 'required',
            'type' => 'required',
            'introduction' => 'nullable'
        ]);

        try{
            DB::transaction(function ()use($request,$course_datum){
                $course_datum->update([
                    'sn' => $request->sn,
                    'title' => $request->title,
                    'separation' => $request->separation,
                    'ep' => ($request->end_ep - $request->start_ep)+1,
                    'start_ep' => $request->start_ep,
                    'end_ep' => $request->end_ep,
                    'type' => $request->type,
                    'teacher' => $request->teacher,
                    'introduction' => $request->introduction
                ]);

                //先刪除
                $course_datum->get_media()->delete();
                $course_datum->resources()->delete();
                //後新增

                $media_type = ['txt','pdf','doc','big5gb'];
                $sn = mb_split("-",$request->sn);
                for($i=$request->start_ep;$i<=$request->end_ep;$i++){
                    $media = new CurriculaMedia;
                    $media->course_data = $course_datum->id;
                    $media->ep = $i;
                    $media->attr = '/media/'.$request->type.'/'.$sn[0].'/'.$request->sn.'/'.$request->sn.'-'.sprintf("%04d", $i).'.'.$request->type;
                    $media->save();

                    foreach ($media_type as $t){
                        CurriculaResource::create([
                            'course_data' => $course_datum->id,
                            'media' => $media->id,
                            'ep' => $i,
                            'type' => $t,
                            'attr' => '/ft.php?sn='.$request->sn.'-'.sprintf("%04d", $i).'&docstype='.$t.'&lang=zh_TW',
                        ]);
                    }
                }
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('course_data.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }
        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CourseData $course_datum
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CourseData $course_datum)
    {
        $this->authorize('course_data.delete');
        try{
            $course_datum->delete();
        }catch (\Exception $e){
            Log::error('course_data.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}

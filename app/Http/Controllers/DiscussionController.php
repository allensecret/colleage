<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\DiscussionBoard;
use App\DiscussionPost;
use App\DiscussionReplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $request->flash();
            $news = Bulletin::orderBy('created_at','desc')->get()->take(5);
            $type = DiscussionBoard::all();

            $db = DiscussionPost::query();
            if($request->has('type')){
                $db->where('type',$request->type);
            }
            if($request->has('search')){
                $db->where('title','like','%'.$request->search.'%');
            }
            if($request->has('sort') && $request->sort == 'last'){
                $db->orderBy('created_at','asc');
            }else{
                $db->orderBy('created_at','desc');
            }
            $list = $db->paginate(15);

            $s_type = $request->query('type','');

            $sort = $request->sort;

        }catch (\Exception $e){
            Log::error('discussion.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.discussion',compact('news','type','list','s_type','sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $type = DiscussionBoard::all();
        }catch (\Exception $e){
            Log::error('discussion.create '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.publish',compact('type'));
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
            'type' => 'required',
            'title' => 'required',
            'content' => 'required|check_text'
        ],[
            'title.required'=>'標題為必填欄位',
            'content.required' => '必填欄位',
            'content.check_text' => '必填欄位'
        ]);

        try{
            DB::transaction(function ()use($request){
                DiscussionPost::create(['type'=>$request->type,'content'=>$request->input('content'),'student'=>Auth::user()->id,'title'=>$request->title]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('discussion.store '.$e->getMessage());
            return back()->withErrors('發帖錯誤');
        }

        return redirect()->route('discussion.index')->with('success','發帖成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DiscussionPost $discussion,Request $request )
    {
        try{
            $type = $request->type;
        }catch (\Exception $e){
            Log::error('discussion.show '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.discussion_content',compact('discussion','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscussionPost $discussion)
    {
        try{
            $type = DiscussionBoard::all();
        }catch (\Exception $e){
            Log::error('discussion.edit '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.discussion_edit',compact('discussion','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscussionPost $discussion)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request,$discussion){
                $discussion->update(['type'=>$request->type,'content'=>$request->input('content'),'title'=>$request->title]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('discussion.update '.$e->getMessage());
            return back()->withErrors('修改失敗');
        }

        return redirect()->route('discussion.show',['discussion'=>$discussion])->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscussionPost $discussion)
    {
        try{
            DB::transaction(function ()use($discussion){
                DiscussionReplies::where('post',$discussion->id)->delete();
                $discussion->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('discussion.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }


}

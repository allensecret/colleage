<?php

namespace App\Http\Controllers;

use App\DiscussionPost;
use App\DiscussionReplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiscussionMGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = DiscussionPost::orderBy('created_at','desc')->paginate(30);
        }catch (\Exception $e){
            Log::error('discussionMG.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('MGplatform.Discussion.index',compact('data'));
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
    public function show(DiscussionPost $discussionMG)
    {
        return view('MGplatform.Discussion.show',compact('discussionMG'));
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
    public function destroy(DiscussionPost $discussionMG)
    {
        try{
            DB::transaction(function ()use($discussionMG){
                DiscussionReplies::where('post',$discussionMG->id)->delete();
                $discussionMG->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('discussionMG.destroy '.$e->getMessage());
            return back()->withErrors('刪除錯誤');
        }
        return redirect()->route('discussionMG.index')->with('success','刪除成功');
    }
    
    public function delete_replies(DiscussionReplies $discussionMG){
        try{
            DB::transaction(function ()use($discussionMG){
                $discussionMG->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('discussionMG.delete_replies '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('success','刪除成功');
    }
}

<?php

namespace App\Http\Controllers;

use App\DiscussionPost;
use App\DiscussionReplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request){
                DiscussionReplies::create([
                    'post'=>$request->post,
                    'student'=>Auth::user()->id,
                    'content'=>$request->input('content')
                ]);
                DiscussionPost::find($request->post)->update(['last_replies'=>Auth::user()->id]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('replies.store '.$e->getMessage());
            return back()->withErrors('留言失敗');
        }
        return back()->with('success','留言成功');
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
    public function update(Request $request, DiscussionReplies $reply)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);
        try{
            DB::transaction(function ()use($request,$reply){
                $reply->update(['content'=>$request->input('content')]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('replies.update '.$e->getMessage());
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
    public function destroy(DiscussionReplies $reply)
    {
        try{
            DB::transaction(function ()use($reply){
                $reply->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('replies.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}

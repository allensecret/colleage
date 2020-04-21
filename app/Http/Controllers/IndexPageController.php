<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\BulletinType;
use App\Classes\validate_email;
use App\Config;
use App\Order;
use App\Page;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $teacher_introduction = Teacher::all();
            $news_type = BulletinType::all();
            $announcement_config = Config::where('title','announcement')->first();
            $announcement_page = Page::where('item','announcement')->first();
            $page = Page::where('item','understanding_intro')->first();
        }catch (\Exception $e){
            Log::error('IndexPage.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.index',compact('teacher_introduction','news_type','page','announcement_config','announcement_page'));
    }

    public function order(Request $request){
        try{
            $validate = new validate_email($request->order_email);
            if($validate->validate() === false){
                return back()->withErrors(['order_email'=>'信箱錯誤!!  請重新輸入']);
            }
            if(count(Order::where('email',$request->order_email)->get())>0){
                return back()->withErrors(['repeat_email'=>'此信箱已訂閱！！']);
            }

            DB::transaction(function ()use($request){
                Order::create(['email'=>$request->order_email]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('IndexPage.order '.$e->getMessage());
            return back()->withErrors('訂閱失敗');
        }

        return back()->with('success','訂閱成功');
    }

    public function disorder(Request $request){
        try{
            DB::transaction(function ()use($request){
                Order::where('email',$request->order_email)->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            return back()->withErrors('訂閱失敗');
        }
        return back()->with('success','取消訂閱');
    }
}

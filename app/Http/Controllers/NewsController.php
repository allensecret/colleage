<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\BulletinType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index(Request $request){
        try{
            $all_type = BulletinType::all();
            $type = $request->query('news_type',1);
            $news_list = Bulletin::where('type',$type)->orderBy('created_at','desc')->paginate(15);
        }catch (\Exception $e){
            Log::error('news.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.news',compact('all_type','news_list','type'));
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
    public function show(Bulletin $news)
    {
        try{

        }catch (\Exception $e){
            Log::error('news.show '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('Frontplatform.announcement',compact('news'));
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
    public function destroy($id)
    {
        //
    }
}

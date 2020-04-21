<?php

namespace App\Http\Controllers;

use App\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MagazineController extends Controller
{
    public function index(Request $request){
        try{
            $year = $request->query('year','2020');
            $data = Magazine::where('year',$year)->get();
        }catch (\Exception $e){
            Log::error('magazine.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.magazine',compact('data'));
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
    public function show(Magazine $magazine)
    {
        return view('Frontplatform.magazine_show',compact('magazine'));
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

    public function download(Magazine $magazine,Request $request){
        try{
            switch ($request->type){
                case "Traditional":
                    $pathToFile = public_path().'/storage/magazine_file/'.$magazine->file;
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    return response()->download($pathToFile,$magazine->file,$headers);
                    break;
                case "Simplified":
                    $pathToFile = public_path().'/storage/magazine_file/'.$magazine->gb_file;
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    return response()->download($pathToFile,$magazine->gb_file,$headers);
                    break;
            }
        }catch (\Exception $e){
            Log::error('magazine.download '.$e->getMessage());
            return back()->withErrors('下載錯誤');
        }


    }
}

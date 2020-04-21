<?php

namespace App\Http\Controllers;

use App\Gift;
use App\GiftItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if($request->has('encrypt')){
                $item = GiftItem::all();
                $student_id = Crypt::decryptString($request->encrypt);
                $student = User::find($student_id);
                if($student->encrypt == $request->encrypt){
                    return view('Frontplatform.gift',compact('item','student'));
                }else{
                    return redirect()->route('index');
                }
            }else{
                return redirect()->route('index');
            }
        }catch (\Exception $e){
            Log::error('gift.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'gift' => 'required',
            'addressee' => 'required',
            'send_address' => 'required',
            'phone' => 'required'
        ]);

        try{
            DB::transaction(function ()use($request){

                $update = User::find($request->student);
                $update->encrypt = Null;
                $update->save();

                $gift = implode(';',$request->gift);
                Gift::create([
                    'student' => $request->student,
                    'item' => $gift,
                    'addressee' => $request->addressee,
                    'send_address' => $request->send_address,
                    'phone' => $request->phone,
                    'send_status' => 0
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('gift.store '.$e->getMessage());
            return back()->withErrors('提交失敗');
        }
        return back()->with('success','提交成功');
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

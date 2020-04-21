<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ChangePassword extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Auth::user();
        }catch (\Exception $e){
            Log::error('change_password.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.changepassword',compact('data'));
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
    public function show(User $changePassword)
    {
        try{
            Auth::logout();
        }catch (\Exception $e){
            Log::error('change_password '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return redirect()->route('index');
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
    public function update(Request $request,User $changePassword)
    {
        $request->validate([
            'new_pwd' => 'required|min:6',
            'cnf_new_pwd' => 'required|same:new_pwd'
        ],[
            'required' => '必填欄位',
            'min' => '必須六位字元以上',
            'same' => '與密碼不相同'
        ]);

        try{
            DB::transaction(function ()use($changePassword,$request){
                $changePassword->update([
                    'password' => Hash::make($request->new_pwd)
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('change_password.update '.$e->getMessage());
            return back()->withErrors('變更密碼錯誤');
        }

        return back()->with('modal','logout');
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

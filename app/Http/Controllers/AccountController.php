<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('account.view');
        try{
            $data = Admin::all();
            $role = AdminRole::all();
        }catch (\Exception $e){
            abort('403','頁面錯誤');
            Log::error('account.view'.$e->getMessage());
        }

        return view('MGplatform.Adminstration.admin_account',compact('data','role'));
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
        $this->authorize('account.create');
        $request->validate([
            'name' => 'required',
            'account' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        try{
            DB::transaction(function ()use($request){
                Admin::create([
                    'name'=>$request->name,
                    'account'=>$request->account,
                    'password'=>Hash::make($request->password),
                    'role'=>$request->role,
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('account.store'.$e->getMessage());
            return back()->withErrors('新增錯誤');
        }

        return back()->with('success','新增成功');
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
     * @param  \Illuminate\Http\Request $request
     * @param Admin $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Admin $account)
    {
        $this->authorize('account.update');
        $validatedData = $request->validate([
            'name' => 'required',
            'account' => 'required',
            'role' => 'required'
        ]);

        try{
            DB::transaction(function ()use($account,$request){
                $account->name = $request->name;
                $account->account = $request->account;
                if($request->has('password')){
                    $account->password = encrypt($request->password);
                }
                $account->role = $request->role;
                $account->save();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('account.update',$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }
        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $account)
    {
        $this->authorize('account.delete');
        try{
            DB::transaction(function ()use($account){
                $account->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('account.destroy'.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('success','刪除成功');
    }
}

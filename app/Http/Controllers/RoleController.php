<?php

namespace App\Http\Controllers;

use App\AdminRole;
use App\Course_level;
use App\CourseLevel;
use App\Features;
use App\Role_function;
use App\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('role.view');
        try{
            $data = AdminRole::all();
        }catch (\Exception $e){
            Log::error('role.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('MGplatform.Role.admin_role',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('role.create');
        try{
            $function = RoleFunction::all();
            $class = CourseLevel::all();
            $features = Features::all();
        }catch (\Exception $e){
            Log::error('role.create '.$e->getMessage());
        }

        return view('MGplatform.Role.admin_role_add',compact('function','class','features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('role.create');
        $request->validate([
            'Character' => 'required',
        ]);
        try{
            $function = '';
            $course = '';
            
            if(!empty($request->all()['functions'])) {
                foreach (array_keys($request->all()['functions']) as $key) {
                    foreach ($request->all()['functions'][$key] as $v) {
                        $function .= $key . '.' . $v . ';';
                    }
                }
            }

            if(!empty($request->all()['courses'])) {
                foreach (array_keys($request->all()['courses']) as $key) {
                    foreach ($request->all()['courses'][$key] as $v) {
                        $course .= $key . '.' . $v . ';';
                    }
                }
            }

            DB::transaction(function ()use($request,$function,$course){
                AdminRole::create(['class'=>$request->Character,'function'=>$function,'course'=>$course]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('role.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('建立失敗');
        }

        return redirect()->route('role.index')->with('success','建立成功');
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
     * @param AdminRole $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(AdminRole $role)
    {
        $this->authorize('role.update');
        try{
            $class = CourseLevel::all();
            $features = Features::all();
        }catch (\Exception $e){
            Log::error('role.edit '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }

        return view('MGplatform.Role.admin_role_edit',compact('role','class','features'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param AdminRole $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminRole $role)
    {
        $this->authorize('role.update');
        $request->validate([
            'Character' => 'required',
        ]);
        try{
            $function = '';
            $course = '';
            if(!empty($request->all()['functions'])) {
                foreach (array_keys($request->all()['functions']) as $key) {
                    foreach ($request->all()['functions'][$key] as $v) {
                        $function .= $key . '.' . $v . ';';
                    }
                }
            }

            if(!empty($request->all()['courses'])){
                foreach (array_keys($request->all()['courses']) as $key){
                    foreach ($request->all()['courses'][$key] as $v){
                        $course .= $key.'.'.$v.';';
                    }
                }
            }


            DB::transaction(function ()use($request,$function,$course,$role){
                $role->update(['class'=>$request->Character,'function'=>$function,'course'=>$course]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('role.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改失敗');
        }

        return redirect()->route('role.index')->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdminRole $role
     * @return AdminRole
     */
    public function destroy(AdminRole $role)
    {
        try{
            $this->authorize('role.delete');
            DB::transaction(function ()use($role){
                $role->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('role.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}

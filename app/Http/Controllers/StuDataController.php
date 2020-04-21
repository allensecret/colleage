<?php

namespace App\Http\Controllers;

use App\CourseLevel;
use App\StudentData;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class StuDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('data.view');
        try {
            $request->flash();
            $level = $request->query('level','');
            $Number_pen = $request->filled('Number_pen') ? $request->Number_pen : 30;
            $search = $request->filled('search') ? $request->search : "";

            $query = User::query();
            $query->join('student_data','users.id','=','student_data.student');
            $query->select('users.*','student_data.dharma_name','student_data.gender','student_data.nationality','student_data.phone','student_data.cellphone','student_data.birthday','student_data.address');
            if(!empty($search)){
                $query->Where(function ($query) use ($search) {
                    $query->orWhere('users.account', 'like', '%' . $search . '%')
                        ->orWhere('users.name', 'like', '%' . $search . '%')
                        ->orWhere('users.email', 'like', '%' . $search . '%');
                });
            }

            if(!empty($level)){
                $query->where('course_level',$level);
            }
            $data = $query->paginate($Number_pen)->setpath('');
            $data->appends(array('Number_pen'=>$request->Number_pen,'search'=>$request->search));

            $course_level = CourseLevel::all();
        } catch (\Exception $e) {
            Log::error('stuData.index '.$e->getMessage());
            abort(403, '頁面資訊錯誤');
        }

        return view('MGplatform.StudentData.student', compact('data','course_level','level'));
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
     * @param User $data
     * @return \Illuminate\Http\Response
     */
    public function show(User $data,Request $request)
    {
        $this->authorize('data.view');
        return view('MGplatform.StudentData.student_detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $data
     * @return \Illuminate\Http\Response
     */
    public function edit(User $data)
    {
        $this->authorize('data.update');
        return view('MGplatform.StudentData.student_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $data)
    {
        $this->authorize('data.update');
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $validatedStudentData = $request->validate([
            'dharma_name' => 'nullable',
            'gender' => 'required',
            'nationality' => 'required',
            'phone' => 'nullable',
            'cellphone' => 'nullable',
            'birthday' => 'date|nullable',
            'address' => 'nullable',
            'language' =>'nullable',
            'fax' => 'nullable',
            'job' => 'nullable',
            'skill' => 'nullable',
            'Volunteer' => 'nullable',
        ]);
        try{
            DB::transaction(function ()use($validatedStudentData,$validatedData,$data,$request){
                $data->update($validatedData);
                $data->data->update($validatedStudentData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('stuData.update '.$e->getMessage());
            DB::rollBack();
            return redirect()->route('data.show',['data'=>$data])->withErrors('編輯失敗');
        }
        return redirect()->route('data.show',['data'=>$data])->with('success','編輯成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $data
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $data)
    {
        $this->authorize('data.delete');
        try{
            DB::transaction(function ()use($data){
                $data->delete();
                $data->data->delete();
                //刪除課程
                //刪除作業
                //刪除黑名單
                //刪除發文
                //刪除留言
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('stuData.destroy '.$e->getMessage());
            DB::rollBack();
        }
        return back();
    }
}

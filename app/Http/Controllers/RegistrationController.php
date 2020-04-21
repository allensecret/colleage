<?php

namespace App\Http\Controllers;

use App\Classes\convert;
use App\Classes\validate_email;
use App\Curricula;
use App\Events\FreshmanMailEvent;
use App\Events\UnreportMailEvent;
use App\StudentCurricula;
use App\StudentData;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

        }catch (\Exception $e){
            Log::error('registration.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.registration');
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
            'r_name' => 'required',
            'r_dharma_name' => 'nullable',
            'r_gender' => 'required',
            'r_job' => 'nullable',
            'r_phone' => 'nullable',
            'r_address' => 'nullable',
            'r_password' => 'required',
            'r_check_password' => 'required|same:r_password',
            'r_birthday' => 'nullable|date_format:Y/m/d',
            'r_language' => 'required',
            'r_nationality' => 'required',
            'r_email' => 'required|email|r_check_email',
            'r_skill' => 'nullable',
            'r_volunteer' => 'nullable'
        ],[
            'required' => '為必填欄位',
            'email.r_check_email' => '電子郵件已被申請',
            'birthday.date_format' => '日期格式不對'
        ]);

        try{
            $last_id = User::where('account','like','%eb%')->get()->last()->account;
            $new_student_id = 'eb'.str_pad((int)substr($last_id,2) + 1,5,0,STR_PAD_LEFT);
            $convert = new convert();
            $validate = new validate_email($convert->convertStrType($request->r_email,'TOSBC'));
            if($validate->validate()){
                DB::transaction(function ()use($request,$new_student_id,$convert){
                    $create_id = User::create([
                        'name'=>$request->r_name,
                        'account'=>$new_student_id,
                        'password'=>Hash::make($request->r_password),
                        'email' => $convert->convertStrType($request->r_email,"TOSBC"),
                    ])->id;
                    StudentData::create(
                        [
                            'student' => $create_id,
                            'dharma_name' => $request->r_dharma_name,
                            'gender' => $request->r_gender,
                            'nationality' => $request->r_nationality,
                            'phone' => $request->r_phone,
                            'birthday' => $request->r_birthday,
                            'address' => $request->r_address,
                            'language' => $request->r_language,
                            'job' => $request->r_job,
                            'skill' => $request->r_skill,
                            'volunteer' => $request->r_volunteer,
                            'course_level' => 1,
                            'stay_in_school' => 1
                        ]
                    );

                    $curriculas = Curricula::where('level',1)->where('compulsory',1)->get();
                    foreach ($curriculas as $c){
                        StudentCurricula::create([
                            'student' => $create_id,
                            'curricula' => $c->id,
                        ]);
                    }
                });
                DB::commit();

                event(new FreshmanMailEvent($request->all(),$new_student_id));
            }else{
                return back()->withErrors(['email_fail'=>'信箱錯誤!!  請重新輸入']);
            }
        }catch (\Exception $e){
            Log::error('registration.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('註冊失敗');
        }

        return back()->withInput($request->all())->with('student_id',$new_student_id)->with('modal_status','on');
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

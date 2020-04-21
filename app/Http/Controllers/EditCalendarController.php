<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditCalendarController extends Controller
{
    public function time_rage(){
        $this_date = date('Y-m');
        $this_year = date('Y');
        $start = date("Y-m",strtotime($this_year."-04"));
        $end = date("Y-m",strtotime("+1 year",strtotime($this_year."-03")));

        if( strtotime($start) <= strtotime($this_date) && strtotime($end) >= strtotime($this_date) ){
            return $this_year;
        }else if( strtotime($start) > strtotime($this_date) ){
            return $this_year - 1;
        }
    }

    public function calendar(Request $request){
        try{
            $this->authorize('edit_calendar.view');
            $year = $request->query('year',$this->time_rage());
            $data = Calendar::where('year',$year)->get();
        }catch (\Exception $e){
            Log::error('edit_calendar.calendar '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }

        return view('MGplatform.EditPage.edit_calendar',compact('data','year'));
    }

    public function calendar_save(Request $request,$date){
        try{
            $this->authorize('edit_calendar.update');
            $month = mb_split('-',$date)[1];
            $check = Calendar::where('date',$date)->first();
            if(empty($check)) {
                $data = new Calendar;
                $data->date = $date;
                $data->year = $this->time_rage();
                $data->month = $month;
                $data->list = $request->list;
                $data->save();
            }else{
                $validatedData = $request->validate([
                    'list' => 'required',
                ]);
                $check->update($validatedData);
            }
        }catch (\Exception $e){
            Log::error('edit_calendar.save '.$e->getMessage());
            return back()->withErrors('建立失敗');
        }

        return back()->with('success','成功建立');
    }
}

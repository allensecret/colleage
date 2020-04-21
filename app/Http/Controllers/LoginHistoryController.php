<?php

namespace App\Http\Controllers;

use App\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginHistoryController extends Controller
{
    public function view(){
        $this->authorize('account.view');
        try{
            $data = LoginHistory::paginate(30);
        }catch (\Exception $e){
            Log::error('LoginHistory.view '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('MGplatform.LoginHistory.index',compact('data'));
    }
}

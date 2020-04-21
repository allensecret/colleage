<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StudentCurricula;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('ep_done',function (Request $request){
    $update = StudentCurricula::find($request->student_curricula);
    $update->done_ep = $update->done_ep.$request->ep.";";
    $update->save();
});

<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\PensionStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class pensionTrackingController extends Controller
{
    public function index(Request $request){
        $user_id = $request->header("id");
        $bdno = User::select('bdno')->where("id", $user_id)->first();
        $pension_track = PensionStep::where("bdno","=", $bdno->bdno)->first();

        return view("users-pages.dashboard.pension-track", compact("pension_track"));
    }
}

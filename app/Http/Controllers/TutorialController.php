<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index(){
        $tutorial = Tutorial::first();
        return view('tutorial', compact('tutorial'));
    }
}

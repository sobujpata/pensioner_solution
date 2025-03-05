<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    public function EmpDashboard(){
        return view('employer-pages.dashboard.dashboard-emp');
    }
}

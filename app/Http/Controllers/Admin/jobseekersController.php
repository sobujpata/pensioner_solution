<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class jobseekersController extends Controller
{
    public function JobseekersPage(){
        return view('pages.dashboard.jobseekers');
    }
    public function JobSeekersForEmpPage(){
        return view('employer-pages.dashboard.job-seekers-list');
    }

    public function JobseekersList(){
        $jobseekers = JobApplication::with('user')->get();

        return response()->json($jobseekers);
    }

    public function JobseekerDelete(Request $request){
        $id = $request->input('id');

        $jobseeker = JobApplication::find($id);
        $resume = $jobseeker->resume;

        File::delete($resume);

        return $jobseeker->delete();
    }
    public function JobSeekersForEmpList(){
        $jobseekers = JobApplication::with('user')->get();

        return response()->json($jobseekers);
    }

}

<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Console\Application;

class jobApplicationController extends Controller
{
    public function index(Request $request){
        $user_id = $request->header("id");
        // dd($user_id);
        $user = User::where("id", $user_id)->first();
        $job_data = JobApplication::where("user_id", $user_id)->first();
        // dd($user->profile_image);
        return view("users-pages.dashboard.job-application-form", compact("user", "job_data"));
    }

    public function ApplicationPost(Request $request)
    {
        $user_id = $request->header("id");
        // dd($user_id);
        $bdno = User::select('bdno')->where("id", $user_id)->first();

        $messages = [
            'user_id.unique' => 'You have already submitted a job application.',
        ];

        $validation = $request->validate([
            "dob" => "required",
            "nid" => "required",
            "vill" => "required",
            "po" => "required",
            "ps" => "required",
            "district" => "required",
            "present_address" => "required",
            "qualification" => "required",
            "passingyear" => "required",
            "jobchoice" => "required",
            "jobarea" => "required",
            "experience" => "required",
            'resume' => 'nullable|mimes:pdf|max:2048',
            'user_id' => 'unique:job_applications,user_id',
        ], $messages);

        // Handle resume file if uploaded
        $resume = $request->file('resume');
        $file_url = null;  // Default to null if no file uploaded

        if ($resume) {
            $t = time();
            $file_name = $resume->getClientOriginalName();
            $pdf_name = "{$bdno->bdno}-{$t}-{$file_name}";
            $file_url = "resume/{$pdf_name}";

            // Upload File to 'public/resume' directory
            $resume->move(public_path('resume'), $pdf_name);
        }

        try {
            // Use updateOrCreate to update existing or create new job application
            JobApplication::updateOrCreate(
                // Matching conditions
                ['user_id' => $user_id],
                // Fields to update or create
                [
                    'dob' => $request->input('dob'),
                    'nid' => $request->input('nid'),
                    'vill' => $request->input('vill'),
                    'po' => $request->input('po'),
                    'ps' => $request->input('ps'),
                    'district' => $request->input('district'),
                    'present_address' => $request->input('present_address'),
                    'qualification' => $request->input('qualification'),
                    'passingyear' => $request->input('passingyear'),
                    'jobchoice' => $request->input('jobchoice'),
                    'jobarea' => $request->input('jobarea'),
                    'experience' => $request->input('experience'),
                    'resume' => $file_url // Will store file URL or null
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Job application submitted successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Job application submission failed',
                'error' => $e->getMessage(), // Optionally include the error message
            ], 417);
        }
    }
    public function edit(Request $request){
        $user_id = $request->header('id');
        $user = User::where("id", $user_id)->first();
        $job_data = JobApplication::where("user_id", $user_id)->first();
        // dd($user->profile_image);
        return view("users-pages.dashboard.job-application-edit", compact("user", "job_data"));

    }
    public function update(Request $request, $id)
    {
        $user_id = $request->header("id");
        $bdno = User::select('bdno')->where("id", $user_id)->first();
        $dob = $request->input("dob");
        $nid = $request->input("nid");
        $vill = $request->input("vill");
        $po = $request->input("po");
        $ps = $request->input("ps");
        $district = $request->input("district");
        $present_address = $request->input("present_address");
        $qualification = $request->input("qualification");
        $passingyear = $request->input("passingyear");
        $jobchoice = $request->input("jobchoice");
        $jobarea = $request->input("jobarea");
        $experience = $request->input("experience");
        $resume = $request->input("resume");

        // dd($id);

        // Validate input
        $validation = $request->validate([
            "dob" => "required|date",
            "nid" => "required|string",
            "vill" => "required|string",
            "po" => "required|string",
            "ps" => "required|string",
            "district" => "required|string",
            "present_address" => "required|string",
            "qualification" => "required|string",
            "passingyear" => "required|integer",
            "jobchoice" => "required|string",
            "jobarea" => "required|string",
            "experience" => "required|string",
            'resume' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Retrieve the current job application
        $existingJobApplication = JobApplication::where('user_id', $user_id)->first();

        // Handle resume file if uploaded
        $resume = $request->file('resume');
        $file_url = $existingJobApplication->resume ?? null; // Keep existing file URL if no new file

        if ($resume) {
            $t = time();
            $file_name = $resume->getClientOriginalName();
            $pdf_name = "{$bdno->bdno}-{$t}-{$file_name}";
            $file_url = "resume/{$pdf_name}";

            // Move the uploaded file to 'public/resume' directory
            $resume->move(public_path('resume'), $pdf_name);
        }

        // Compare new input with existing data
        $newData = [
            'dob' => $request->input('dob'),
            'nid' => $request->input('nid'),
            'vill' => $request->input('vill'),
            'po' => $request->input('po'),
            'ps' => $request->input('ps'),
            'district' => $request->input('district'),
            'present_address' => $request->input('present_address'),
            'qualification' => $request->input('qualification'),
            'passingyear' => $request->input('passingyear'),
            'jobchoice' => $request->input('jobchoice'),
            'jobarea' => $request->input('jobarea'),
            'experience' => $request->input('experience'),
            'resume' => $file_url
        ];

        // Check if the data has actually changed
        if ($existingJobApplication && $existingJobApplication->toArray() === $newData) {
            return redirect()->back()->json([
                    'status' => 'no_changes',
                    'message' => 'No updates were made, as the data is identical to the current record.'
                ], 200);
        }

        try {
            // Use updateOrCreate to find the existing job application or create a new one
            JobApplication::updateOrCreate(
                // Fields to search for (to find the record)
                ['user_id' => $user_id],

                // Fields to update or create
                $newData
            );

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Job application updated successfully'
            ], 200);

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function JobSheeker(){
        $data = JobApplication::paginate(10);
        foreach ($data as $key => $value) {
            $user_id = $value->user_id;
            $user_data = User::select('bdno', 'rank', 'fname', 'trade', 'email', 'mobile', 'profile_image')->find($user_id);
            // dd($user_data);
        }
        return view('users-pages.dashboard.job-sheekers', compact('data','user_data'));
    }

}

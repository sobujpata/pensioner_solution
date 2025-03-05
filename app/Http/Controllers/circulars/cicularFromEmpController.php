<?php

namespace App\Http\Controllers\circulars;

use Exception;
use App\Models\Employer;
use App\Models\JobCirculer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class cicularFromEmpController extends Controller
{
    public function index(){
        return view("users-pages.dashboard.employers-circular");
    }
    public function JobCircullerPage(){
        return view("employer-pages.dashboard.job-circuler");
    }

    public function CirculerList(Request $request)
    {
        try {
            // Get emp_id from the request header
            $emp_id = $request->header('id');

            // Validate emp_id (ensure it's not empty or invalid)
            if (empty($emp_id)) {
                return response()->json([
                    'message' => 'Employee ID is required.',
                    'status' => 'error'
                ], 400); // Bad Request
            }

            // Fetch job circulers with related employer data
            $circulers = JobCirculer::where('emp_id', $emp_id)
                ->with('employer') // Eager load the employers relationship
                ->get();

            // Check if data is found
            if ($circulers->isEmpty()) {
                return response()->json([
                    'message' => 'No circulers found for the given employee ID.',
                    'status' => 'success',
                    'data' => []
                ], 200); // OK
            }

            // Return success response with data
            return response()->json([
                'data' => $circulers,
                'status' => 'success'
            ], 200); // OK

        } catch (\Exception $e) {
            // Handle any unexpected errors
            return response()->json([
                'message' => 'An error occurred while fetching circulers.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500); // Internal Server Error
        }
    }

    public function CirculerCreate(Request $request)
    {
        // Validate emp_id from header
        $emp_id = $request->header('id');
        if (!$emp_id) {
            return response()->json(['status' => 'failed', 'message' => 'Employee ID is required in the header'], 400);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'office_location' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'circuler_file' => 'nullable|file|mimes:pdf|max:4048',
        ]);

        $circuler_file_path = null;

        // Handle file upload
        if ($request->hasFile('circuler_file')) {
            $circuler_file = $request->file('circuler_file');
            $t = time();
            $original_file_name = pathinfo($circuler_file->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitized_file_name = Str::slug($original_file_name, '_');
            $file_name = "{$emp_id}_{$t}_{$sanitized_file_name}.pdf";

            // Store file in public storage
            $circuler_file_path = $circuler_file->storeAs('circulers', $file_name, 'public');
        }

        try {
            // Check if emp_id exists in the database (optional validation)
            if (!Employer::find($emp_id)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid Employee ID'], 404);
            }

            // Create the record
            JobCirculer::create([
                'emp_id' => $emp_id,
                'job_title' => $validated['title'],
                'description' => $validated['description'],
                'office_location' => $validated['office_location'],
                'area' => $validated['area'],
                'status' => $validated['status'],
                'admin_status' => 0,
                'circuler_file' => $circuler_file_path,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Job Circuler Created Successfully'], 200);
        } catch (Exception $e) {
            Log::error('Job Circuler Creation Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Job Circuler Creation Failed'], 417);
        }
    }
    public function CirculerStatus(Request $request){
        $emp_id = $request->header('id');
        if(!$emp_id){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not athorized.'
            ]);
        }

        $id = $request->input('id');
        $status = $request->input('status');
        $statusUpdate = JobCirculer::find($id)->update([
            'status'=>$status,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>"Status updated successfully.",
        ]);
    }
    public function CirculerStatusByAdmin(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        
        JobCirculer::find($id)->update([
            'status'=>$status,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>"Status updated successfully.",
        ]);
    }
    public function CirculerAdminStatusByAdmin(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $statusUpdate = JobCirculer::find($id)->update([
            'admin_status'=>$status,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>"Status updated successfully.",
        ]);
    }

    public function CirculerById(Request $request){
        $circuler_id = $request->input('id');
        $circuler = JobCirculer::findOrFail($circuler_id);

        return response()->json($circuler);
    }
    public function JobCirculerUpdate(Request $request){
        $emp_id = $request->header('id');
        $id = $request->input('id');

        $title = $request->input('title');
        $office_location = $request->input('office_location');
        $description = $request->input('description');
        $area = $request->input('area');
        $status = $request->input('status');
        // Validate request
        $request->validate([
            'circuler_file' => 'nullable|file|mimes:pdf|max:2048', // Allow only PDFs, max 2MB
            'filePath' => 'nullable|string', // Optional existing file path
        ]);

        $filePath = $request->input('filePath'); // Get existing file path




        // Handle file upload
        if ($request->hasFile('circuler_file')) {
            $circuler_file = $request->file('circuler_file');
            $t = time();
            $original_file_name = pathinfo($circuler_file->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitized_file_name = Str::slug($original_file_name, '_');
            $file_name = "{$emp_id}_{$t}_{$sanitized_file_name}.pdf";

            // Store file in public storage
            $circuler_file_path = $circuler_file->storeAs('circulers', $file_name, 'public');
        }else{
            $circuler_file_path = $filePath ?: null; // Ensure null if no valid path is provided
        }
        // return $circuler_file_path;
        try {
            // Check if emp_id exists in the database (optional validation)
            if (!Employer::find($emp_id)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid Employee ID'], 404);
            }

            // Create the record
            JobCirculer::where('id', $id)->update([
                'emp_id' => $emp_id,
                'job_title' => $title,
                'description' => $description,
                'office_location' => $office_location,
                'area' => $area,
                'status' => $status,
                'admin_status' => 0,
                'circuler_file' => $circuler_file_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Job Circuler Created Successfully',
                'file_path' => asset("storage/{$circuler_file_path}") // Return accessible URL
            ], 200);
        } catch (Exception $e) {
            Log::error('Job Circuler Creation Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Job Circuler Creation Failed'], 417);
        }

    }
    public function employerCirculerUpdate(Request $request){
        $emp_id = $request->input('emp_id');
        $id = $request->input('id');

        $title = $request->input('title');
        $office_location = $request->input('office_location');
        $description = $request->input('description');
        $area = $request->input('area');
        $status = $request->input('status');
        // Validate request
        $request->validate([
            'circuler_file' => 'nullable|file|mimes:pdf|max:2048', // Allow only PDFs, max 2MB
            'filePath' => 'nullable|string', // Optional existing file path
        ]);

        $filePath = $request->input('filePath'); // Get existing file path




        // Handle file upload
        if ($request->hasFile('circuler_file')) {
            $circuler_file = $request->file('circuler_file');
            $t = time();
            $original_file_name = pathinfo($circuler_file->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitized_file_name = Str::slug($original_file_name, '_');
            $file_name = "{$emp_id}_{$t}_{$sanitized_file_name}.pdf";

            // Store file in public storage
            $circuler_file_path = $circuler_file->storeAs('circulers', $file_name, 'public');
        }else{
            $circuler_file_path = $filePath ?: null; // Ensure null if no valid path is provided
        }
        // return $circuler_file_path;
        try {
            // Check if emp_id exists in the database (optional validation)
            if (!Employer::find($emp_id)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid Employee ID'], 404);
            }

            // Create the record
            JobCirculer::where('id', $id)->update([
                'emp_id' => $emp_id,
                'job_title' => $title,
                'description' => $description,
                'office_location' => $office_location,
                'area' => $area,
                'status' => $status,
                'admin_status' => 0,
                'circuler_file' => $circuler_file_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Job Circuler Created Successfully',
                'file_path' => asset("storage/{$circuler_file_path}") // Return accessible URL
            ], 200);
        } catch (Exception $e) {
            Log::error('Job Circuler Creation Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Job Circuler Creation Failed'], 417);
        }

    }

    public function CirculerListEMP(){
        $data = JobCirculer::with('employer')->get();

        return response()->json($data);
    }

    public function employerCirculerAdminPage(){
        return view('pages.dashboard.employer-circulers');
    }
    public function employerCirculerDelete(Request $request){
        $id = $request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);

        return JobCirculer::where('id',$id)->delete();
    }



}

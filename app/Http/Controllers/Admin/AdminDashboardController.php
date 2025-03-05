<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Mail\UserApprovedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class AdminDashboardController extends Controller
{
    function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }
    public function adminUser(Request $request):View{
        return view('pages.dashboard.admins');
    }
    public function GenUser(Request $request):View{
        return view('pages.dashboard.users');
    }
    public function employerUser(Request $request):View{
        return view('pages.dashboard.employers');
    }
    public function adminList(Request $request){
        $admins = Admin::all();

        return response()->json([
            'data' => $admins->makeHidden(['password']), // show passwords in response
            'status' => 'success',
        ], 200);
    }

    public function adminUpdate(Request $request)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'id' => 'required|exists:admins,id', // Ensure 'id' exists to update the correct admin
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|digits:11', // Validates mobile number with exactly 11 digits
            'role' => 'required|numeric|min:0',
        ]);

        try {
            // Find the existing admin entry by ID
            $admin = Admin::findOrFail($validatedData['id']);

            // Update the admin fields
            $admin->update([
                "fname" => $validatedData['fname'],
                "email" => $validatedData['email'],
                "mobile" => $validatedData['mobile'],
                "role" => $validatedData['role'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'Admin updated successfully',
                'data' => $admin
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminCreate(Request $request){
        // Validate input fields
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|digits:11', // Validates mobile number with exactly 11 digits
            'password' => 'required|string|min:6', // Ensures password is at least 6 characters
            'role' => 'required|numeric|min:0',
        ]);

        try {
            // Create the admin fields
            $admin = Admin::create([
                "fname" => $validatedData['fname'],
                "email" => $validatedData['email'],
                "mobile" => $validatedData['mobile'],
                "password" => $validatedData['password'],
                "role" => $validatedData['role'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'Admin Created successfully',
                'data' => $admin
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to Create admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminDelete(Request $request){
        $id = $request->input('id');
        return Admin::where('id',$id)->delete();
    }
    public function DeleteUser(Request $request){
        $id = $request->input('id');
        return User::where('id',$id)->delete();
    }

    public function adminEdit(Request $request){
        // dd($request->id);
        $id = $request->input('id');
        $admin = Admin::find($id);

        if ($admin) {
            // Check if a new password is provided in the request
            if ($request->has('password')) {
                $admin->password = Hash::make($request->input('password')); // Hash the password
            }

            // Save any updates
            $admin->save();

            return response()->json([
                'data' => $admin,
                'status' => 'success',
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Admin not found',
            ], 404);
        }
    }
    public function userList(Request $request){
        $users = User::get();
        return response()->json([
            'data'=> $users,
            'status'=>'success'
        ], 200);
    }

    public function UserById(Request $request){
         // dd($request->id);
         $id = $request->input('id');
         $user = User::find($id);
         return response()->json([
             'data'=> $user,
             'status'=> 'success'
             ],200);

    }

    public function UserUpdate(Request $request){
        // Validate input fields
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id', // Ensure 'id' exists to update the correct user
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|digits:11', // Validates mobile number with exactly 11 digits
            'status' => 'required|numeric|min:0',
        ]);

        try {
            // Find the existing user entry by ID
            $user = User::findOrFail($validatedData['id']);

            // Update the user fields
            $user->update([
                "fname" => $validatedData['fname'],
                "email" => $validatedData['email'],
                "mobile" => $validatedData['mobile'],
                "status" => $validatedData['status'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'user updated successfully',
                'data' => $user
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function UserUpdatePass(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id', // Ensure 'id' exists to update the correct user
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
        ]);

        try {
            // Find the existing user entry by ID
            $user = User::findOrFail($validatedData['id']);

            // Update the user fields
            $user->update([
                "password" => $validatedData['password'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'User Password updated successfully',
                'data' => $user
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function AdminUpdatePass(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'id' => 'required|exists:admins,id', // Ensure 'id' exists to update the correct admin
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
        ]);
        try {
            // Find the existing Admin entry by ID
            $admin = Admin::findOrFail($validatedData['id']);

            // Update the admin fields
            $admin->update([
                "password" => $validatedData['password'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'Admin Password updated successfully',
                'data' => $admin
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function employerUserList(){
        $data = Employer::all();

        return response()->json($data);
    }
    public function employerById(Request $request){
        $id = $request->input('id');
        $data = Employer::findOrFail($id);

        return response()->json($data);
    }

    public function employerUpdate(Request $request){
        // Validate input fields
        $validatedData = $request->validate([
            'id' => 'required|exists:employers,id', // Ensure 'id' exists to update the correct employer
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|digits:11', // Validates mobile number with exactly 11 digits
            'status' => 'required|numeric|min:0',
        ]);

        try {
            // Find the existing employer entry by ID
            $employer = Employer::findOrFail($validatedData['id']);

            // Update the employer fields
            $employer->update([
                "fname" => $validatedData['fname'],
                "email" => $validatedData['email'],
                "mobile" => $validatedData['mobile'],
                "status" => $validatedData['status'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'employer updated successfully',
                'data' => $employer
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update employer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function employerUpdatePass(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'id' => 'required|exists:employers,id', // Ensure 'id' exists to update the correct employer
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
        ]);
        try {
            // Find the existing employer entry by ID
            $employer = Employer::findOrFail($validatedData['id']);

            // Update the employer fields
            $employer->update([
                "password" => $validatedData['password'],
            ]);

            // Return a successful response
            return response()->json([
                'message' => 'Employer Password updated successfully',
                'data' => $employer
            ], 200);

        } catch (\Exception $e) {
            // Return error message with detailed information
            return response()->json([
                'message' => 'Failed to update employer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function Approveemployer(Request $request){
        $employerId = $request->input('id');
        // Find the employer
        $employer = Employer::findOrFail($employerId);

        // Update the employer's status to approved
        $employer->update(['status' => '1']);

        // Send the approval email
        Mail::to($employer->email)->send(new UserApprovedMail($employer));

        return response()->json([
            'status'=>'success',
            'message'=>'Employer approved successfully.'
        ]);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Helper\JWTToken;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function LoginPage():View{
        return view('pages.auth.login-page');
    }
    function ProfilePage():View{
        return view('pages.dashboard.profile-page');
    }

    public function userLogin(Request $request)
{
    // Validate request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'failed',
            'message' => $validator->errors()->first(), // Show first validation error
        ], 400);
    }

    // Fetch admin by email
    $admin = Admin::where('email', $request->input('email'))->first();

    if (!$admin) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Please register first. Thanks.',
        ], 404);
    }

    // Verify the password securely
    if (!Hash::check($request->input('password'), $admin->password)) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Unauthorized. Incorrect credentials.',
        ], 401);
    }

    // Generate JWT token for authenticated admin
    $tokenAdmin = JWTToken::CreateTokenForAdmin($admin->email, $admin->id, $admin->role);

    return response()->json([
        'status' => 'success',
        'message' => 'Login successful',
        'userID' => $admin->id,
    ], 200)->cookie('tokenAdmin', $tokenAdmin, 1440); // Cookie expires in 1 day
}
    function adminCreate(Request $request)
    {
        $id = $request->header('id');
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|string|max:20|regex:/^[0-9]+$/',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
            'role' => 'required|numeric|min:0',
        ]);
        // return $validated;
        DB::beginTransaction();
        try {
            Admin::create([
                'fname' => $validated['fname'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'],
                'password' => Hash::make($validated['password']),
                "role" => $validated['role'],
                'created_by'=>$id,
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Admin Registration Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Admin Registration Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Admin Registration Failed'], 417);
        }
    }
    public function AdminLogout(){
        return redirect('/')->cookie('tokenAdmin', '', -1);
    }
    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=Admin::where('email','=',$email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ],200);
    }

    function UpdateProfile(Request $request){
        try{
            $email=$request->header('email');
            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $mobile=$request->input('mobile');
            Admin::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],200);
        }
    }


}


<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use App\Models\Employer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployerController extends Controller
{
    public function index(){
        return view('users-pages.dashboard.employer-pages');
    }

    public function LoginPageEmployer(){
        return view('employer-pages.auth.login-page');
    }
    public function RegistrationPageEmployer(){
        return view('employer-pages.auth.registration-page');
    }

    function SendOtpPage():View{
        return view('employer-pages.auth.send-otp-page');
    }
    function VerifyOTPPage():View{
        return view('employer-pages.auth.verify-otp-page');
    }

    function ResetPasswordPage():View{
        return view('employer-pages.auth.reset-pass-page');
    }

    function ProfilePage():View{
        return view('employer-pages.dashboard.profile-page');
    }

    public function employerRegistration(Request $request){
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'orgName' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:emplo',
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        $profile_image = $request->file('profile_image');
        $img_url = null;

        if ($profile_image) {
            $t = time();
            $file_name = $profile_image->getClientOriginalName();
            $img_name = "{$validated['mobile']}-{$t}-{$file_name}";
            $img_url = "employers/{$img_name}";
            $profile_image->move(public_path('employers'), $img_name);
        }
        // return $validated;
        DB::beginTransaction();
        try {
            Employer::create([
                'fname' => $validated['fname'],
                'org_name' => $validated['orgName'],
                'designation' => $validated['designation'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'],
                'password' => Hash::make($validated['password']),
                'image_url' => $img_url,
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Employer Registration Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Employer Registration Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'Employer Registration Failed'], 417);
        }
    }


    public function EmployeLogin(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Fetch employer by email
        $employer = Employer::where('email', $request->input('email'))->first();

        if (!$employer) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Please register first. Thanks.',
            ], 404);
        }

        // Check if the employer's account is inactive
        if ($employer->status == '0') {
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account has not yet been approved. You will be notified through email. Thanks.',
            ], 403);
        }

        // Securely verify the password
        if (!Hash::check($request->input('password'), $employer->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized. Incorrect credentials.',
            ], 401);
        }

        // Generate JWT token for authenticated employer
        $tokenEmployer = JWTToken::CreateTokenEmployer($employer->email, $employer->id, $employer->designation);

        // Return response with token in a cookie (valid for 1 day)
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'employerID' => $employer->id,
        ])->cookie('tokenEmployer', $tokenEmployer, 1440); // 1440 minutes = 1 day
    }



    public function SendOTPCode(Request $request)
    {
        $email = $request->input('email');

        $otp = rand(100000, 999999);
        $count = Employer::where('email', '=', $email)->count();

        if($count == 1){
            Mail::to($email)->send(new OTPMail($otp));

            Employer::where('email', '=', $email)->update(['otp'=>$otp]);

            return response()->json([
                'status'=>'success',
                'message'=>'6 degite OTP send your Email'
        ]);
        }else{
            return response()->json([
                'status'=>'fsiled',
                'message'=>'unauthorized'
            ]);
        }

    }

    public function VerifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = Employer::where('email', '=', $email)
                ->where('otp', '=', $otp)
                ->count();

            if($count==1){
                //Database update otp
                Employer::where('email', '=', $email)->update(['otp'=>'0']);

                //Pass reset token issue
                $token = JWTToken::CreateTokenForPassword($request->input('email'));

                return response()->json([
                    'status'=>'success',
                    'message'=>'OTP Verified',
                    'token'=>$token
                ], 200)->cookie('token',$token,60*24*30);
            }else{
                return response()->json([
                    'status'=>'fsiled',
                    'message'=>'unauthorized'
                ], 401);
            }
    }

    public function ResetPassword(Request $request)
    {
        try{
            $email = $request->header('email');
            $validated = $request->validate([
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
            Employer::where('email', '=', $email)
                ->update(['password' => Hash::make($validated['password'])]);

                return response()->json([
                    'status'=>'success',
                    'message'=>'Password reset successfully'
                ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>'fsiled',
                'message'=>'Password reset failed'
            ]);
        }
    }
    public function Logout(){
        return redirect('/')->cookie('tokenEmployer', '', -1);
    }

    public function EmployersListUser(){
        $data = Employer::where('status', 1)->get();

        return response()->json($data);
    }
}

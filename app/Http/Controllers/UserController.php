<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Mail\UserApprovedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function LoginPage():View{
        return view('users-pages.auth.login-page');
    }

    function RegistrationPage():View{
        return view('users-pages.auth.registration-page');
    }
    function SendOtpPage():View{
        return view('users-pages.auth.send-otp-page');
    }
    function VerifyOTPPage():View{
        return view('users-pages.auth.verify-otp-page');
    }

    function ResetPasswordPage():View{
        return view('users-pages.auth.reset-pass-page');
    }

    function ProfilePage():View{
        return view('users-pages.dashboard.profile-page');
    }

    public function userLogin(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to fetch user by email
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Please register first. Thanks.',
            ], 404);
        }

        // Check if the user's status is inactive
        if ($user->status == '0') {
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account has not yet been approved. You will be notified through email. Thanks.',
            ], 403);
        }

        // Verify the password securely using Hash facade
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized. Incorrect credentials.',
            ], 401);
        }

        // Generate JWT token for authenticated user
        $token = JWTToken::CreateToken($user->email, $user->id);

        // Return response with token cookie
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'userID' => $user->id,
        ])->cookie('token', $token, 1440); // 1440 minutes = 1 day
    }



    function UserRegistration(Request $request)
    {

        $validated = $request->validate([
            'person_type' => 'required|string|max:255',
            'bdno' => 'required|string|max:255|unique:users',
            'rank' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'trade' => 'required|string|max:255',
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        $profile_image = $request->file('profile_image');
        $img_url = null;

        if ($profile_image) {
            $t = time();
            $file_name = $profile_image->getClientOriginalName();
            $img_name = "{$validated['bdno']}-{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";
            $profile_image->move(public_path('uploads'), $img_name);
        }
        // dd($img_url);
        DB::beginTransaction();
        try {
            User::create([
                'person_type' => $validated['person_type'],
                'bdno' => $validated['bdno'],
                'rank' => $validated['rank'],
                'fname' => $validated['fname'],
                'trade' => $validated['trade'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'],
                'password' => Hash::make($validated['password']),
                'profile_image' => $img_url,
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'User Registration Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User Registration Error: ' . $e->getMessage());
            return response()->json(['status' => 'failed', 'message' => 'User Registration Failed'], 417);
        }
    }


    public function SendOTPCode(Request $request)
    {
        $email = $request->input('email');

        $otp = rand(100000, 999999);
        $count = User::where('email', '=', $email)->count();

        if($count == 1){
            Mail::to($email)->send(new OTPMail($otp));

            User::where('email', '=', $email)->update(['otp'=>$otp]);

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
        $count = User::where('email', '=', $email)
                ->where('otp', '=', $otp)
                ->count();

            if($count==1){
                //Database update otp
                User::where('email', '=', $email)->update(['otp'=>'0']);

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
            User::where('email', '=', $email)
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
    public function UserLogout(Request $request) {
        // Invalidate session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear the token cookie
        return redirect('/')->cookie('token', '', -1);
    }

    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
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
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
                'password'=>$password
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

    public function ApproveUser(Request $request)
    {
        $userId = $request->input('id');
        // Find the user
        $user = User::findOrFail($userId);

        // Update the user's status to approved
        $user->update(['status' => '1']);

        // Send the approval email
        Mail::to($user->email)->send(new UserApprovedMail($user));

        return response()->json([
            'status'=>'success',
            'message'=>'User approved successfully.'
        ]);
    }

}


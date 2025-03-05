<?php
namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\SuggetionUser; // Corrected the typo
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class suggertionController extends Controller
{
    public function index(Request $request) {
        $user_id = $request->header("id");
        $user = User::find($user_id);
        $image = $user ? $user->profile_image : null; // Handle potential null user
        return view("users-pages.dashboard.suggetion", compact("image"));
    }

    public function store(Request $request) {
        $user_id = $request->header("id");
        $bdno = User::where("id", $user_id)->value('bdno'); // Use 'value' to get a single field

        // Validation
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'filename' => 'nullable|mimes:pdf|max:2048', // File should be a PDF and max size of 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'error' => $validator->errors(),
            ], 417);
        }

        // File upload logic
        $filename = $request->file('filename');
        $file_url = null;

        if ($filename) {
            $t = time();
            $originalFilename = $filename->getClientOriginalName();
            $pdf_name = "{$bdno}-{$t}-{$originalFilename}";

            // Use Laravel's Storage facade to store files in 'public/suggestion' directory
            $file_url = $filename->storeAs('public/suggestion', $pdf_name);
        }

        // Use updateOrCreate to update existing or create new record in SuggestionUser table
        SuggetionUser::updateOrCreate(
            [
                'user_id' => $user_id,
                'content' => $request->input('content')
            ],
            [
                'filename' => $file_url ? str_replace('public/', '', $file_url) : null, // Store the relative file path
            ]
        );

        return redirect()->back()->with('message', 'Your suggestion has been submitted successfully!');

    }
}

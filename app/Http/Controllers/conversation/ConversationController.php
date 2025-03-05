<?php

namespace App\Http\Controllers\conversation;

use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    public function index(Request $request):View{
        return view("conversation.index");
    }
    public function demo(Request $request):View{
        return view("conversation.demo");
    }
    public function getConversations(Request $request){
        $user_id = $request->header("id");
        $user = User::where("id",$user_id)->first();
        $conversation = Conversation::where("user_id",$user_id, )->orderBy("created_at","DESC")->get();
        return response()->json([
            "data"=> $conversation,
            "userData"=>$user,
            'status'=>'success',
            ], 200);
    }


    public function store(Request $request)
    {
        $user_id = $request->header("id"); // Use authenticated user if available
        $bdno = User::select('bdno')->where("id", $user_id)->first();

        $validator = Validator::make($request->all(), [
            "title" => "required",
            "content" => "required",
            'filename' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Handle file upload if provided
        $filename = $request->file('filename');
        $file_url = null;  // Default to null if no file is uploaded
        if ($filename) {
            $t = time();
            $file_name = $filename->getClientOriginalName();
            $pdf_name = "{$bdno->bdno}-{$t}-{$file_name}";
            $file_url = "attached/{$pdf_name}";

            // Store the file in 'storage/app/public/attached' directory
            $filename->move(public_path('attached'), $pdf_name);
        }

        try {
            // Use updateOrCreate to update existing or create new conversation
            Conversation::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'title' => $request->input('title'),
                    'content' => $request->input('content')
                ],
                [
                    'filename' => $file_url, // Store the file URL or null
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Message submitted successfully',
            ], 200);

        } catch (Exception $e) {
            Log::error($e->getMessage()); // Log the error for debugging
            return response()->json([
                'status' => 'failed',
                'message' => 'Message submission failed',
                'error' => $e->getMessage(),
            ], 417);
        }
    }
    public function destroy(Request $request, $id) {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Conversation not found.'
            ], 404);
        }

        $conversation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted successfully.'
        ], 200);
    }
    public function VoiceConversation() {
        return view('conversation.voice-create');
    }
    public function uploadAudio(Request $request)
    {
        $user_id = $request->header('id');
        $user = User::select('bdno')->where('id', $user_id)->first();
        $bdno = $user->bdno;
        // dd($user_id);
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $t = time();
            $file_name = $file->getClientOriginalName();
            $fileName = "{$bdno}-{$t}-{$file_name}";
            $file_url = "voice_uploads/{$fileName}";

            $file->move(public_path("voice_uploads"), $fileName);

            Conversation::create(['user_id'=> $user_id,'voic_send'=> $file_url]);

            return response()->json([
                'status' => 'success',
                'message' => 'Message submitted successfully',
            ], 200);
        }
    }

    public function ConversationPageAdmin(){
        return view('pages.dashboard.conversation');
    }
    public function ConversationPagePension(){
        return view('pages.dashboard.conversation-pension');
    }
    public function ConversationPageDocuIV(){
        return view('pages.dashboard.conversation-docu-IV');
    }
    public function ConversationList(Request $request){
          $conversations = Conversation::with('user')->get();

        return response()->json($conversations) ;
    }
    public function ConversationPensionList(Request $request){
        // return $request;
          $conversations = Conversation::where('title','Pension')->with('user')->get();

        return response()->json($conversations) ;
    }
    public function ConversationDocuIVList(Request $request){
          $conversations = Conversation::where('title','Docu-IV')->with('user')->get();

        return response()->json($conversations) ;
    }

    public function ConversationById(Request $request){
        $id = $request->input('id');
        $conversation = Conversation::where('id',$id)->first();

        return response()->json($conversation);
    }

    public function ConversationUpdateFromAdmin(Request $request){
        $id = $request->input('id');
        $admin_id = $request->header('id');
        $admin = Admin::select('role')->where('id', $admin_id)->first();
        $admin_user = $admin->role;

        $validator = Validator::make($request->all(), [
            "title" => "required",
            "reply" => "nullable",
            // 'reply_file' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Handle file upload if provided
        $filename = $request->file('reply_file');
        $file_url = null;  // Default to null if no file is uploaded
        if ($filename) {
            $t = time();
            $file_name = $filename->getClientOriginalName();
            $pdf_name = "{$admin_user}-{$t}-{$file_name}";
            $file_url = "attached/{$pdf_name}";

            // Store the file in 'storage/app/public/attached' directory
            $filename->move(public_path('attached'), $pdf_name);
        }

        try {
            // Use updateOrCreate to update existing or create new conversation
            Conversation::where('id',$id)->update(
                [
                    'title' => $request->input('title'),
                    'reply_from' => $admin_user,
                    'reply' => $request->input('reply'),
                    'reply_file' => $file_url, // Store the file URL or null
                ],

            );

            return response()->json([
                'status' => 'success',
                'message' => 'Message updated successfully',
            ], 200);

        } catch (Exception $e) {
            Log::error($e->getMessage()); // Log the error for debugging
            return response()->json([
                'status' => 'failed',
                'message' => 'Message submission failed',
                'error' => $e->getMessage(),
            ], 417);
        }

    }

    // public function ConversationAudioPage(){
    //     return view('pages.dashboard.conversation');
    // }
    public function ConversationAudioFromAdmin(Request $request){
        // return $request;
        $admin_id = $request->header('id');
        $admin = Admin::select('role')->where('id', $admin_id)->first();
        $admin_user = $admin->role;
        $id = $request->input('id');
        // dd($admin_user);
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $t = time();
            $file_name = $file->getClientOriginalName();
            $fileName = "{$admin_user}-{$t}-{$file_name}";
            $file_url = "voice_uploads/{$fileName}";

            $file->move(public_path("voice_uploads"), $fileName);

            Conversation::where('id',$id)->update(
                [
                'reply_from'=> $admin_user,
                'voic_reply'=> $file_url
            ]
        );

            return response()->json([
                'status' => 'success',
                'message' => 'Message submitted successfully',
            ], 200);
        }
    }
    public function ConversationDelete(Request $request){
        // return $request;
    // Validate the request inputs
    $request->validate([
        'id' => 'required|integer|exists:conversations,id',
        'file_path' => 'nullable|string',
        'file_path2' => 'nullable|string',
        'file_path3' => 'nullable|string',
        'file_path4' => 'nullable|string',
    ]);

    $id = $request->input('id');
    $filePaths = array_filter([
        $request->input('file_path'),
        $request->input('file_path2'),
        $request->input('file_path3'),
        $request->input('file_path4'),
    ]);

    try {
        // Delete files if they exist
        foreach ($filePaths as $path) {
            if ($path && file_exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

        // Delete the conversation
        $deleted = Conversation::where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Conversation and associated files deleted successfully.',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete the conversation.',
        ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the conversation or files.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



}

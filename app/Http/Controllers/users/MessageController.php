<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Message;
class MessageController extends Controller
{
    public function MessageInfo(Request $request){
        $designation = $request->designation;
        $message_for = Message::where('designation', $designation)
                    ->pluck('message_url')
                    ->first();
                    // dd($message_for);
        return view('users-pages.dashboard.messages', compact('message_for'));
    }

    
}

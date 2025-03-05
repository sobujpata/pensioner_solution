<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function DashboardPage():View{
        return view('users-pages.dashboard.dashboard-page');
    }
    function RoleSutatus(Request $request){
        $admin_id = $request->header('id');
        $admin=Admin::find($admin_id);

        $admin_role=$admin->role;
        return response()->json($admin_role);
    }

    function Summary(Request $request):array{

        $user_id=$request->header('id');

        $usersAproved= User::where('status',1)->count();
        $usersNotAproved= User::where('status',0)->count();
        $usersReject= User::where('status',2)->count();
        $jobApplication = JobApplication::count();
        // $pensionConversation = Conversation::where('title', 'Pension')->count();
        $pensionConversationReply = Conversation::where('title', 'Pension')
        ->whereNotNull('reply_from')
        ->count();
        $pensionConversationNotReply = Conversation::where('title', 'Pension')
        ->whereNull('reply_from')
        ->count();

        // $Docu_IVConversation = Conversation::where('title', 'Docu-IV')->count();
        $Docu_IVConversation = Conversation::where('title', 'Docu-IV')
            ->selectRaw("
                SUM(CASE WHEN reply_from IS NOT NULL THEN 1 ELSE 0 END) as replied_count,
                SUM(CASE WHEN reply_from IS NULL THEN 1 ELSE 0 END) as not_replied_count
            ")
            ->first();
            $Docu_IVConversationReply = $Docu_IVConversation->replied_count;
            $Docu_IVConversationNotReply = $Docu_IVConversation->not_replied_count;

        return[
            'usersAproved'=> $usersAproved,
            'usersNotAproved'=> $usersNotAproved,
            'usersReject'=> $usersReject,
            'jobApplication'=> $jobApplication,
            'pensionConversationReply'=> $pensionConversationReply,
            'pensionConversationNotReply'=> $pensionConversationNotReply,
            'Docu_IVConversationReply'=> $Docu_IVConversationReply,
            'Docu_IVConversationNotReply'=> $Docu_IVConversationNotReply,
        ];
    }

}

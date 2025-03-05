<?php

namespace App\Http\Controllers\circulars;

use App\Models\BafCircular;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class bafCircularController extends Controller
{
    public function index(){
        $baf_ciculars = BafCircular::paginate(10);
        return view("users-pages.dashboard.baf-circular", compact("baf_ciculars"));
        // dd($baf_ciculars);
    }
    public function NoticeHighlight(){
        $notice = BafCircular::orderBy('created_at', 'desc')->first(); // Orders by 'created_at' in descending order
        return response()->json([
            'data' => $notice,
        ]);
    }


    public function noticeAdminPage()
    {
        return view('pages.dashboard.notice');
    }

    public function noticeAdminlist(){
        $notice = BafCircular::orderBy('created_at', 'desc')->get(); // Orders by 'created_at' in descending order
        return response()->json( $notice);
    }


    public function noticeCreate(Request $request){
        // dd($request);
        $name = $request->input('name');
        $subject = $request->input('subject');
        $remarks = $request->input('remarks');
        $published_on = $request->input('published_on');
        $image_url = $request->file('image_url');

        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="Notice-images/{$img_name}";

        // dd($img_url);
        // Upload File
        $image_url->move(public_path('Notice-images'),$img_name);

        $NoticeCreate = BafCircular::create([
            'name'=>$name,
            'subject'=>$subject,
            'remarks'=>$remarks,
            'published_on'=>$published_on,
            'file_url'=>$img_url
        ]);

        return response()->json([
            'message'=>"Notice Created Successfully.",
            'status'=>'success'
        ]);
    }

    public function noticeById(Request $request){
        $id = $request->input('id');
        $notice = BafCircular::where('id',$id)->first();

        return response()->json($notice);
    }

    public function noticeUpdate(Request $request){
        // dd($request);
        $id=$request->input('id');
        $name=$request->input('name');
        $subject=$request->input('subject');
        $remarks=$request->input('remarks');
        $published_on=$request->input('published_on');
        $image_url = $request->file('image_url');
        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="Notice-images/{$img_name}";

        // dd($img_url);
        // Upload File
        $image_url->move(public_path('Notice-images'),$img_name);

        $notice = BafCircular::where('id',$id)->update([
            'name'=>$name,
            'subject'=>$subject,
            'remarks'=>$remarks,
            'published_on'=>$published_on,
            'file_url'=>$img_url,
        ]);

        return response()->json($notice);
    }

    public function noticeDelete(Request $request){
        // $user_id=$request->header('id');
        $product_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return BafCircular::where('id',$product_id)->delete();

    }
}

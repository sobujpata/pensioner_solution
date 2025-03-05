<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormController extends Controller
{
    //Forms download
    public function FormPages(Request $request):View{
        return view('users-pages.dashboard.forms-pages');
    }
    public function formAdminPage(Request $request):View{
        return view('pages.dashboard.form');
    }
    public function Forms(Request $request){
        $data = Form::all();

        return response()->json($data);
    }
    public function FormAdminlist(Request $request){
        $data = Form::all();

        return response()->json($data);
    }
    public function FormCreate(Request $request){
        $name = $request->input('name');
        $subject = $request->input('subject');
        $published_on = $request->input('published_on');
        $image_url = $request->file('image_url');

        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="Forms/{$img_name}";

        // dd($img_url);
        // Upload File
        $image_url->move(public_path('Forms'),$img_name);

        $FormCreate = Form::create([
            'name'=>$name,
            'subject'=>$subject,
            'published_on'=>$published_on,
            'file_name'=>$img_url
        ]);

        return response()->json([
            'message'=>"Form Created Successfully.",
            'status'=>'success'
        ]);
    }

    public function FormById(Request $request){
        $id = $request->input('id');
        $data = Form::where('id',$id)->first();

        return response()->json($data);
    }
    public function FormUpdate(Request $request){
        $id=$request->input('id');
        $name=$request->input('name');
        $subject=$request->input('subject');
        $published_on=$request->input('published_on');
        $image_url = $request->file('image_url');
        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="Forms/{$img_name}";

        // dd($img_url);
        // Upload File
        $image_url->move(public_path('Forms'),$img_name);

        $form = Form::where('id',$id)->update([
            'name'=>$name,
            'subject'=>$subject,
            'published_on'=>$published_on,
            'file_name'=>$img_url,
        ]);

        return response()->json($form);
    }
    public function FormDelete(Request $request){
        $id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Form::where('id',$id)->delete();
    }
}

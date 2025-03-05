<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\HomeAbout;
use App\Models\Person_type;
use App\Models\Slider;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index(){
        return view('pages.dashboard.settings');
    }

    public function SliderPage(){
        return view('pages.dashboard.slider-page');
    }
    public function HomePageAbout(){
        return view('pages.dashboard.home-about-page');
    }
    public function HomePageHelp(){
        return view('pages.dashboard.home-help-page');
    }
    public function HomePageTutorial(){
        return view('pages.dashboard.home-tutorial-page');
    }

    public function SliderList(){
        $data = Slider::all();

        return response()->json($data);
    }

    public function SliderCreate(Request $request){
        $title = $request->input('title');
        $short_des = $request->input('short_des');
        $image_url = $request->file('image_url');

        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="slider/{$img_name}";

        // Upload File
        $image_url->move(public_path('slider'),$img_name);

       Slider::create([
            'title'=>$title,
            'short_des'=>$short_des,
            'image'=>$img_url
        ]);

        return response()->json([
            'message'=>"Form Created Successfully.",
            'status'=>'success'
        ]);
    }

    public function SliderById(Request $request){
        $id = $request->input('id');

        $data = Slider::find($id);

        return response()->json($data);
    }

    public function SliderUpdate(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $short_des = $request->input('short_des');
        $image_url = $request->file('image_url');

        // Fetch the existing slider record
        $slider = Slider::find($id);
        if (!$slider) {
            return response()->json(['error' => 'Slider not found'], 404);
        }

        // If a new image is uploaded, process it
        if ($image_url) {
            $t = time();
            $file_name = $image_url->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "Slider/{$img_name}";

            // Move uploaded file to public/Slider
            $image_url->move(public_path('Slider'), $img_name);
        } else {
            $img_url = $slider->image; // Keep existing image
        }

        // Update the slider record
        $slider->update([
            'title' => $title,
            'short_des' => $short_des,
            'image' => $img_url,
        ]);

        return response()->json(['success' => true, 'slider' => $slider]);
    }

    public function SliderDelete(Request $request){
        $id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Slider::where('id',$id)->delete();
    }

    public function HomePageAboutList(){
        $data = HomeAbout::all();

        return response()->json($data);
    }

    public function HomePageAboutCreate(Request $request){
        $title = $request->input('title');
        $short_des = $request->input('short_des');
        $image_url = $request->file('image_url');

        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="home-page/{$img_name}";

        // Upload File
        $image_url->move(public_path('home-page'),$img_name);

       HomeAbout::create([
            'title'=>$title,
            'short_des'=>$short_des,
            'image'=>$img_url
        ]);

        return response()->json([
            'message'=>"Form Created Successfully.",
            'status'=>'success'
        ]);
    }

    public function HomePageAboutById(Request $request){
        $id = $request->input('id');

        $data = HomeAbout::find($id);

        return response()->json($data);
    }

    public function HomePageAboutUpdate(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $short_des = $request->input('short_des');
        $image_url = $request->file('image_url');

        // Fetch the existing Home about record
        $home_about = HomeAbout::find($id);
        if (!$home_about) {
            return response()->json(['error' => 'Home about not found'], 404);
        }

        // If a new image is uploaded, process it
        if ($image_url) {
            $t = time();
            $file_name = $image_url->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "home-about/{$img_name}";

            // Move uploaded file to public/home-about
            $image_url->move(public_path('home-about'), $img_name);
        } else {
            $img_url = $home_about->image; // Keep existing image
        }

        // Update the home_about record
        $home_about->update([
            'title' => $title,
            'short_des' => $short_des,
            'image' => $img_url,
        ]);

        return response()->json(['success' => true, 'home_about' => $home_about]);
    }

    public function HomePageAboutDelete(Request $request){
        $id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return HomeAbout::where('id',$id)->delete();
    }

    public function HomePageHelpCreate(Request $request){
        $admin_id = $request->header('id');
        $title = $request->input('title');
        $description = $request->input('description');
        $person_type = $request->input('person_type');

       Help::create([
            'admin_id'=>$admin_id,
            'title'=>$title,
            'description'=>$description,
            'person_type'=>$person_type,
        ]);

        return response()->json([
            'message'=>"Form Created Successfully.",
            'status'=>'success'
        ]);
    }

    public function HomePageHelpList(){
        $data = Help::all();

        return response()->json($data);
    }
    public function HomePageHelpById(Request $request){
        $id = $request->input('id');

        $data = Help::findOrFail($id);

        return response()->json($data);
    }
    public function HomePageHelpUpdate(Request $request)
    {
        $admin_id = $request->header('id');
        $id = $request->input('id');
        $title = $request->input('title');
        $description = $request->input('description');
        $person_type = $request->input('person_type');


        // Update the home_about record
        Help::where('id', $id)->update([
            'admin_id' => $admin_id,
            'title' => $title,
            'description' => $description,
            'person_type' => $person_type,
        ]);

        return response()->json([
            'success' => true,
            'status'=>'success'
        ],203);
    }
    public function HomePageHelpDelete(Request $request){
        $id = $request->input('id');
        Help::where('id', $id)->delete();

        return response()->json([
            'status'=>"success",
            'message'=>"Deleted Successfully."
        ]);
    }

    public function LoginInfo(Request $request, $person_type){
        // $person_type = $request->query('perosn_type');
        $login_infos = Help::where('person_type', $person_type)->first();
        // dd($login_infos);

        return view('about_jiggasa', compact('login_infos'));
    }

    //Tutorial Info
    public function HomePageTutorialList(){
        $tutorial = Tutorial::all();

        return response()->json($tutorial);
    }



    public function HomePageTutorialCreate(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|file|mimes:mp4,avi,mov,wmv|max:504800', // 20MB max
        ]);

        $title = $request->input('title');
        $video = $request->file('video_url');

        $timestamp = time();
        $file_name = $video->getClientOriginalName();
        $video_name = "{$timestamp}-{$file_name}";
        $video_path = "tutorial/{$video_name}";

        // Upload File (using Storage)
        $video->move(public_path('tutorial'), $video_name); // Alternative: Storage::disk('public')->put($video_path, file_get_contents($video));
        // Save to Database
        $data = Tutorial::create([
            'title' => $title,
            'vedio_url' => $video_path,
        ]);

        return response()->json([
            'data'=>$data,
            'message' => "Form Created Successfully.",
            'status' => 'success'
        ]);
    }

    public function HomePageTutorialById(Request $request)
    {
        $id = $request->input('id');
        $data = Tutorial::find($id);

        return response()->json($data);
    }
    public function HomePageTutorialUpdate(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $vedio = $request->file('vedio_url');

        $tutorial = Tutorial::findOrFail($id);
        if(!$vedio){
            $tutorial->update([
                'title'=>$title
            ]);
            return response()->json([
                'status'=>'success'
            ],203);
        }else{
            $filePath = $tutorial->vedio_url;
            File::delete($filePath);

            $timestamp = time();
            $file_name = $vedio->getClientOriginalName();
            $video_name = "{$timestamp}-{$file_name}";
            $video_path = "tutorial/{$video_name}";

            // Upload File (using Storage)
            $vedio->move(public_path('tutorial'), $video_name); // Alternative: Storage::disk('public')->put($video_path, file_get_contents($video));
            // Save to Database
            $tutorial->update([
                'title' => $title,
                'vedio_url' => $video_path,
            ]);

            return response()->json([
                'message' => "Updated Successfully.",
                'status' => 'success'
            ],203);
        }



    }
    public function HomePageTutorialDelete(Request $request){
        $id = $request->input('id');
        $filePath=$request->input('vedio_url');
        // return $request;
        File::delete($filePath);
        Tutorial::where('id', $id)->delete();

        return response()->json([
            'status'=>"success",
            'message'=>"Deleted Successfully."
        ]);
    }



}

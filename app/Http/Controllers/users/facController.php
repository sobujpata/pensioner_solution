<?php

namespace App\Http\Controllers\users;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Models\FrequentlyAskedQuestion;

class facController extends Controller
{
    // Render the FAQ page
    public function index($category_id)
    {
        $faqs = FrequentlyAskedQuestion::where('category_id', $category_id)->get();
        $category = Category::find($category_id);
        // dd($category);
        return view("users-pages/dashboard/faq-pages", compact('faqs', 'category'));
    }
    public function faqAdminPage(): View
    {
        return view("pages/dashboard/faq");
    }

    // Fetch FAQ information based on category ID from route parameter
    public function faqInfo($category_id)
    {
        // Fetch FAQs for the given category_id

        // // Return the FAQs as a JSON response
        // return response()->json($faqs);

    }

    //faq admin dashboard list
    public function faqAdminlist(){
        $faq = FrequentlyAskedQuestion::with('category')->get();

        return response()->json($faq);
    }

    public function faqCreate(Request $request){

        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $respective_section = $request->input('respective_section');
        $faqImage = $request->file('image_url');

        $t=time();
        $file_name=$faqImage->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="faq-images/{$img_name}";
        // dd($img_url);
        // Upload File
        $faqImage->move(public_path('faq-images'),$img_name);

        $faqCreate = FrequentlyAskedQuestion::create([
            'category_id'=>$category_id,
            'name'=>$name,
            'description'=>$description,
            'respective_section'=>$respective_section,
            'image_url'=>$img_url
        ]);

        return response()->json([
            'message'=>"Faq Created Successfully.",
            'status'=>'success'
        ]);

    }

    function faqById(Request $request){
        $id = $request->input('id');

        $data = FrequentlyAskedQuestion::where('id', $id)->first();
        return response()->json($data);
    }

    function faqUpdate(Request $request){
        // dd($request);
        $id=$request->input('id');
        $name=$request->input('name');
        $subject=$request->input('subject');
        $category_id=$request->input('category_id');
        $respective_section=$request->input('respective_section');

        $image_url = $request->file('image_url');
        $t=time();
        $file_name=$image_url->getClientOriginalName();
        $img_name="{$t}-{$file_name}";
        $img_url="faq-images/{$img_name}";

        // dd($img_url);
        // Upload File
        $image_url->move(public_path('faq-images'),$img_name);

        $faq = FrequentlyAskedQuestion::where('id',$id)->update([
            'name'=>$name,
            'description'=>$subject,
            'category_id'=>$category_id,
            'respective_section'=>$respective_section,
            'image_url'=>$img_url,
        ]);

        return response()->json($faq);
    }

    function faqDelete(Request $request)
    {
        // $user_id=$request->header('id');
        $product_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return FrequentlyAskedQuestion::where('id',$product_id)->delete();

    }

}


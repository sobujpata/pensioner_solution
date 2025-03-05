<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function getSection(){
        $sections = Section::all();

        return response()->json([
            'data'=>$sections
        ]);
    }

    public function onlySection()
    {
        $data = Section::select('section')->distinct()->get();
        return response()->json([
            'data' => $data
        ]);
    }
}

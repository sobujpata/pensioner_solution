<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Trade;
use App\Models\RetdType;
use App\Models\Person_type;
use Illuminate\Http\Request;
use App\Models\PensionStatus;

class MiscellaneousController extends Controller
{
    public function rank(){
        $rank = Rank::pluck('short_name');
        return response()->json([
            'data' => $rank,
            'status'=>'success'
        ]);
    }

    public function trade(){
         $trade = Trade::pluck('short_name');
        return response()->json([
            'status'=>'success',
            'data'=> $trade,
        ]);
    }
    public function personType(){
        $person_type = Person_type::pluck('person_type');
        return response()->json([
            'status'=>'success',
            'data'=> $person_type,
        ]);

    }
    public function RetdType(){
        $retd_type = RetdType::pluck('retd_type');
        return response()->json([
            'status'=>'success',
            'data'=> $retd_type,
        ]);

    }

    public function PensionStatus(){
        $status = PensionStatus::pluck('status');
        return response()->json([
            'status'=>'success',
            'data'=> $status,
        ]);

    }
}

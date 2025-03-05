<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
{
    $visitorCount = Visitor::count();
    return response()->json($visitorCount);
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;

class TopController extends Controller
{
    public function index()
    {
        $min_id = Problem::limit(1)->first()->id;
    
        return view('welcome', ['min_id' => $min_id]);
    }
}

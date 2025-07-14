<?php

namespace App\Http\Controllers;
use app\Models\Inbound;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function inbound(){
        return view('pages.inbound.index');
    }
}

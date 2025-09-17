<?php

namespace App\Http\Controllers\Web\Cabang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CabangDashboardController extends Controller
{
    public function index()
    {
        return view('pages.cabang.dashboard');
    }
}

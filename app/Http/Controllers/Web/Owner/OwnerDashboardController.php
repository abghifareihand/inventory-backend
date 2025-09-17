<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        return view('pages.owner.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index(){
        return response()->json(Outlet::all());
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'owner_name'=>'nullable|string',
            'phone'=>'nullable|string',
            'gps_lat'=>'required|string',
            'gps_lng'=>'required|string'
        ]);

        $outlet = Outlet::create($request->all());
        return response()->json($outlet);
    }
}

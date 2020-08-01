<?php

namespace App\Http\Controllers\Admin\OpeningTime;

use App\Models\Admin\OpeningTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpeningTimeController extends Controller
{
    public function index(){
        $view = OpeningTime::first();
        return view('admin.opening_time.index',compact('view'));
    }
    public function openingTimeSave(Request $request){
        $update = OpeningTime::first();
        $update->mon_to_fri_opening = $request->get('mon_to_fri_opening');
        $update->mon_to_fri_closing = $request->get('mon_to_fri_closing');
        $update->opening_sat = $request->get('opening_sat');
        $update->closing_sat = $request->get('closing_sat');
        $update->opening_sun = $request->get('opening_sun');
        $update->closing_sun = $request->get('closing_sun');
        $update->save();
        return redirect()->back()->with('success','Time Update Successfully');
    }
}

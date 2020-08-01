<?php

namespace App\Http\Controllers\Admin\Dashboard;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
    	$pageTitle = "Dashboard";
        return view('admin.dashboard.index',compact('pageTitle'));
    }
}

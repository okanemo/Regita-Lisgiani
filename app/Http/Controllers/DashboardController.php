<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class DashboardController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        $data['title'] = 'Dashboard';
        return view('admin.dashboard.view',$data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class MaintenanceController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        $data['title'] = 'Maintenance';
        return view('admin.maintenance.view',$data);
    }
}

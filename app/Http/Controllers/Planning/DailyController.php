<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Session;

class DailyController extends Controller
{
    use GeneralServices;

    public function index(){
        $response = $this->GET('http://103.214.112.156:3000/api/planning/daily');
        $data['data'] = $response['content'];
        $data['title'] = 'Manufacturing Order';
        return view('admin.planning.daily.view',$data);
    }

    public function add(Request $request){
        $response = $this->GET('http://103.214.112.156:3000/api/planning/monthly');
        $data['data'] = $response['content'];
        $data['title'] = 'Input MO';
        return view('admin.planning.daily.add',$data);
    }

    public function store(Request $request){
        $store = $this->POST('http://103.214.112.156:3000/api/planning/daily', $request->all());

        if($store['message'] != 'success'){
            return redirect()->back()->withErrors($store);
        }

        return redirect('/admin/planning-daily')->with('success', "Success Input Data !");
    }
    public function show($id){
        $data['data'] = CategoryModel::where('type','=','expance')->where('user_id',Session::get('Users.id'))->where('id',$id)->first();
        $data['title'] = 'Expance Category Edit';
        return view('admin.category.expance.edit',$data);
    }
    public function import(Request $request){

	    $multipart_data = array();

        $general_data['module']      = $request['module'];
        if ($request->file) {
			$multipart_data['file']    = $request->file('file');
		}

        $store = $this->MULTIPART('http://103.214.112.156:3000/api/planning/import', $general_data, $multipart_data);
        return redirect('/admin/planning-daily')->with('success', "Data succesfully imported ".$store['content']['inserted']);
    }

}



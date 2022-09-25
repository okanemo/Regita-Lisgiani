<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\RolePrivilegesModel;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


trait GeneralServices {
    protected $request;
    public function __construct(Request $request)
    {
        $this->_client = new Client(['http_errors' => false]);
        $this->request = $request;
		$this->header = ['User-Token' =>$request->header('User-Token')];

    }
    protected function POST($url,$data = [],$headers = [],$timeout = ['connection_timeout' => 600,'timeout'=> 600]){
        return json_decode($this->_client->POST($url,[
            'form_params' => $data,
            'headers' => $this->header,
            $timeout
        ])->getBody(),true);
    }
	protected function PUT($url,$data = [], $headers = [],$timeout = ['connection_timeout' => 600,'timeout'=> 600]){
		return json_decode($this->_client->PUT($url,[
			'form_params' => $data,
			'headers' => $this->header,
			$timeout
		])->getBody(),true);
	}

    protected function GET($url,$data = [], $headers = [],$timeout = ['connection_timeout' => 600,'timeout'=> 600]){
          return json_decode($this->_client->GET($url,[
              'form_params' => $data,
              'headers' => $this->header,
              $timeout
          ])->getBody(),true);
    }

    protected function MULTIPART($url,$general_data = [], $multipart_data = [], $headers = [], $timeout = ['connection_timeout' => 600,'timeout'=> 600]){

        $data = [];
        foreach($general_data as $key => $item){
            if (is_array($item)) {
                foreach($item as $items){
                    $data[] = [
                        'name'      => $key.'[]',
                        'contents'  => $items
                    ];
                }
            }else{
                $data[] = [
                    'name'      => $key,
                    'contents'  => $item
                ];
            }
        }

        foreach($multipart_data as $key => $file){
            if($file){
                if (is_array($file)) {
                    foreach ($file as $row) {
                        $data[] = [
                            'name'      => $key.'[]',
                            'contents'  => fopen($row->getPathname(),'r'),
                            'filename'  => $row->getClientOriginalName()
                        ];
                    }
                }else{
                    $data[] = [
                        'name'      => $key,
                        'contents'  => fopen($file->getPathname(),'r'),
                        'filename'  => $file->getClientOriginalName()
                    ];
                }
            }
        }
        return json_decode($this->_client->POST($url,[
            'headers' => $headers,
            'multipart' => $data,
            $timeout
        ])->getBody(),true);

    }




    function ValidateRequest($params,$rules){

		$validator = Validator::make($params, $rules);

		if ($validator->fails()) {
            // 'message' => $validator->messages()
            return  $validator->errors()->first();
		}
	}
    function validatePermission($uri, $menu){

		$validateRoles = RolePrivilegesModel::select('*')
            ->leftJoin('menu', 'menu.menu_id', '=', 'role_privileges.menu_id')
            ->where('role_privileges.role_id','=',Session::get('Users.role.role_id'))
            ->where('role_privileges.'.$menu,'=','1')
            ->where('menu.menu_url','=',$uri)
            ->first();
        return $validateRoles;
	}
    function setMenu(){

		$data = RolePrivilegesModel::select('*')
            ->leftJoin('menu', 'menu.menu_id', '=', 'role_privileges.menu_id')
            ->where('role_privileges.role_id','=',Session::get('Users.role.role_id'))
            ->get();

        Session::put('menu_list',$data->toArray());
	}

}

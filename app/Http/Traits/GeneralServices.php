<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin\RolePrivilegesModel;

trait GeneralServices {
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
<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Admin\UsersModel;
use App\Models\Admin\UserRolesModel;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    use GeneralServices;
    public function profileDetail(Request $request){
        $data['title'] = 'Profile';
        return view('admin.profile.view',$data);
    }
    public function changePassword(Request $request){
		$rules = [
			'password' => "required|string",
			'newpassword' => [
                                'required',
                                'string',
                                'min:8',             // must be at least 10 characters in length
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                'regex:/[0-9]/',      // must contain at least one digit
                                'regex:/[@$!%*#?&]/', // must contain a special character
                            ],
			'confirm_newpassword' => "required|string",
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
		$checkAuth = UsersModel::where('id',Session::get('Users.id'))->first();
        $checkAuth->makeVisible('password');
        if (Hash::check($request['password'], $checkAuth->password)) {

            $postUpdate['password'] = hash::make($request['newpassword']);
			$updatePassword = UsersModel::where('id', Session::get('Users.id'))->update($postUpdate);
			if(!$updatePassword){
                return redirect()->back()->withErrors(['Failed! Server Error!']);  
			}
            return redirect('/admin/profile')->with('success', "Password succesfully changed");
		}else{
            return redirect()->back()->withErrors(['Failed! Invalid current password!']);  
		}

	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Manage Users';
        $data['data'] = UsersModel::select('*')->with(['role'])->get();	
        return view('admin.user.view',$data);
    }
    public function add(Request $request)
    {
        $data['title'] = 'Manage Users';
        $data['role'] = UserRolesModel::select('*')->get();
        return view('admin.user.add',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'fullname' => 'required|string',
            'role_id' => 'required|integer',
            'email' => 'required|email|unique:users,email',
			'password' => [
                                'required',
                                'string',
                                'confirmed',
                                'min:8',             // must be at least 10 characters in length
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                'regex:/[0-9]/',      // must contain at least one digit
                                'regex:/[@$!%*#?&]/', // must contain a special character
                            ],
            'password_confirmation ' => 'string',
            'gender' => 'nullable',
            'status' => 'required|in:active,inactive',
        ];
        $validateData = $this->ValidateRequest($request->all(), $rules);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        $request['password'] = hash::make($request['password']);
        $save = UsersModel::create($request->except(['_method','_token','password_confirmation']));
        if(!$save){
            return redirect()->back()->withErrors(['Failed! Server Error!']);  
        } 
        return redirect('/admin/user')->with('success', "User succesfully created");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data['title'] = 'Manage Users';
        $data['role'] = UserRolesModel::select('*')->get();
        $data['data'] = UsersModel::select('*')->where('id',$request->id)->with(['role'])->first();
        return view('admin.user.edit',$data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules = [
            'fullname' => 'required|string',
            'role_id' => 'required|integer',
            'gender' => 'nullable',
            'status' => 'required|in:active,inactive',
        ];
        $validateData = $this->ValidateRequest($request->all(), $rules);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        $request['password'] = hash::make($request['password']);
        $save = UsersModel::where('id',$id)->update($request->except(['_method','_token','password_confirmation']));
        if(!$save){
            return redirect()->back()->withErrors(['Failed! Server Error!']);  
        } 
        return redirect('/admin/user')->with('success', "User succesfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = UsersModel::where('id',$id)->delete();
        if(!$delete){
            return redirect()->back()->withErrors(['Failed! Server Error!']);  
        } 
        return redirect('/admin/user')->with('success', "User succesfully deleted");
    }
}

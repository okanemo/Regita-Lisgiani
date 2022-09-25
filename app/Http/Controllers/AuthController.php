<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Admin\UsersModel;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
        $data['title'] = 'Admin';
        return view('admin.login',$data);
    }
    public function login(Request $request)
    {
        $PostRequest = $request->only(
                'email',
                'password'
        );

        $role = [
            'email' => 'Required',
            'password' => 'Required',
        ];

        $validateData = $this->ValidateRequest($PostRequest, $role);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        // Find the member by email
        $cek_member = UsersModel::select('*')->where('email','=',$PostRequest['email'])->with(['role'])->first();
        if (empty($cek_member)) {
            return redirect()->back()->withErrors(['Failed! Email Address Not Found!']);
        }
        $cek_member->makeVisible('password');
        if (Hash::check($PostRequest['password'], $cek_member->password)) {
            if ($cek_member->status=="active") {
                Session::put('Users',$cek_member->toArray());
                return redirect('/admin/dashboard');
            }else{
                return redirect()->back()->withErrors(['Failed! Member inactive!']);
            }
        }
        return redirect()->back()->withErrors(['Failed! invalid password!']);
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}

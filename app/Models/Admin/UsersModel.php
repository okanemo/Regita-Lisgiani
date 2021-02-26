<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UsersModel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'users';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'role_id','fullname', 'email','password','gender','status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','deleted_at','updated_at'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Admin\UserRolesModel', 'role_id', 'role_id')->with('privileges');
    }

}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserRolesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'user_roles';
	public $primarykey = 'role_id';
    public $timestamps = true;

    protected $fillable = [
        'role_name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at','updated_at'
    ];
    public function users()
    {
        return $this->hasMany('App\Models\Admin\UsersModel', 'role_id', 'role_id');
    }
    public function privileges()
    {
        return $this->hasMany('App\Models\Admin\RolePrivilegesModel', 'role_id', 'role_id')->with('menu');
    }
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class RolePrivilegesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table   = 'role_privileges';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'role_id','menu_id','view','create','edit','delete'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
    public function role()
    {
        return $this->belongsTo('App\Models\Admin\UserRolesModel', 'role_id', 'role_id');
    }
    public function menu()
    {
        return $this->belongsTo('App\Models\Admin\MenuModel', 'menu_id', 'menu_id');
    }
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'menu';
	public $primarykey = 'menu_id';
    public $timestamps = true;

    protected $fillable = [
        'menu_name',
        'menu_url'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at','updated_at'
    ];
    public function privileges()
    {
        return $this->hasMany('App\Models\Admin\RolePrivilegesModel', 'menu_id', 'menu_id');
    }
}

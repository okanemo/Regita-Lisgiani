<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'category';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id','name','type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at','updated_at','created_at'
    ];
    protected $dates = [
        'entry_date'
    ];
    public function income_transactions()
    {
        return $this->hasMany('App\Models\Transaction\TrxIncomeModel', 'category_id', 'id')->where('category.type', '=', 'income');
    }
    public function expance_transactions()
    {
        return $this->hasMany('App\Models\Transaction\TrxExpenceModel', 'category_id', 'id')->where('category.type', '=', 'expance');
    }
}

<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoryModel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'subcategory';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id','category_id','name','type'
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
    public function income_transaction_details()
    {
        return $this->hasMany('App\Models\Transaction\TrxIncomeDetailModel', 'sub_category_id', 'id')->where('subcategory.type', '=', 'income');
    }
    public function expance_transaction_details()
    {
        return $this->hasMany('App\Models\Transaction\TrxExpenceDetailModel', 'sub_category_id', 'id')->where('subcategory.type', '=', 'expance');
    }
}
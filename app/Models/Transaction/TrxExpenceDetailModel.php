<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxExpenceDetailModel extends Model
{    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'trx_expance_details';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'sub_category_id','remarks','spent_at','total','trx_income_id'
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
        'spent_at'
    ];
    public function master()
    {
        return $this->belongsTo('App\Models\Transaction\TrxExpenceModel', 'trx_expance_id', 'trx_expance_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Categories\SubCategoryModel', 'sub_category_id', 'id');
    }
}

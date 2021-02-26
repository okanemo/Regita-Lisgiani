<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxIncomeDetailModel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table   = 'trx_income_details';
	public $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'sub_category_id','remarks','entry_date','total','trx_income_id'
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
    public function master()
    {
        return $this->belongsTo('App\Models\Transaction\TrxIncomeModel', 'trx_income_id', 'trx_income_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Categories\SubCategoryModel', 'sub_category_id', 'id');
    }
}

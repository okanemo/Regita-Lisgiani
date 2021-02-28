<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxIncomeModel extends Model
{
	use HasFactory;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	use SoftDeletes;
	protected $table   = 'trx_income';
	public $primarykey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'user_id','category_id','total'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'deleted_at','updated_at','created_at'
	];
	public function details()
	{
		return $this->hasMany('App\Models\Transaction\TrxIncomeDetailModel', 'trx_income_id', 'id');
	}
	public function category()
	{
		return $this->belongsTo('App\Models\Categories\CategoryModel', 'category_id', 'id');
	}
}

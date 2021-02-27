<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Transaction\TrxIncomeModel;
use App\Models\Transaction\TrxIncomeDetailModel;
use App\Models\Categories\CategoryModel;
use App\Models\Categories\SubCategoryModel;
use App\Models\Transaction\TrxExpenceModel;
use App\Models\Transaction\TrxExpenceDetailModel;
use Session;
use DB;

class TrasactionReportController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
		$data['income'] = TrxIncomeModel::with(['category'])->where('user_id',Session::get('Users.id'));
		$data['expance'] = TrxExpenceModel::with(['category'])->where('user_id',Session::get('Users.id'));
        $data['detail_income'] = TrxIncomeDetailModel::select('*',DB::raw('SUM(trx_income_details.total) AS total_details_bysub'))->with(['subcategory','master'])
						->whereHas('master', function($q) {
							$q->where('user_id', '=', Session::get('Users.id'));
						})
                        ->groupby('sub_category_id');
        $data['detail_expance'] = TrxExpenceDetailModel::select('*',DB::raw('SUM(trx_expance_details.total) AS total_details_bysub'))->with(['subcategory','master'])
                        ->whereHas('master', function($q) {
                            $q->where('user_id', '=', Session::get('Users.id'));
                        })
                        ->groupby('sub_category_id');
		$data['title'] = 'Report';
		return view('admin.transaction.report.view',$data);
	}
}

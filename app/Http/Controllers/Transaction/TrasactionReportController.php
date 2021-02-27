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
        //filter section
        $filter = $request->all();
        if(!empty($request->filter_years) && $request->filter_years != null){
            $data['income']->with(['details'=> function($q) use($request) {
                $q->whereYear('entry_date', '=', $request->filter_years);
            }]);
            $data['expance']->with(['details'=> function($q) use($request) {
                $q->whereYear('spent_at', '=', $request->filter_years);
            }]);

            $data['detail_income']->whereYear('entry_date', '=', $request->filter_years);
            $data['detail_expance']->whereYear('spent_at', '=', $request->filter_years);
        }
        if(!empty($request->filter_month) && $request->filter_month != null){
            $data['income']->with(['details'=> function($q) use($request) {
                $q->whereMonth('entry_date', '=', $request->filter_month);
            }]);
            $data['expance']->with(['details'=> function($q) use($request) {
                $q->whereMonth('spent_at', '=', $request->filter_month);
            }]);
            
            $data['detail_income']->whereMonth('entry_date', '=', $request->filter_month);
            $data['detail_expance']->whereMonth('spent_at', '=', $request->filter_month);
        }
        if(!empty($request->filter_days) && $request->filter_days != null){
            $data['income']->with(['details'=> function($q) use($request) {
                $q->whereDay('entry_date', '=', $request->filter_days);
            }]);
            $data['expance']->with(['details'=> function($q) use($request) {
                $q->whereDay('spent_at', '=', $request->filter_days);
            }]);
            $data['detail_income']->whereDay('entry_date', '=', $request->filter_days);
            $data['detail_expance']->whereDay('spent_at', '=', $request->filter_days);
        }
        $data['income'] = $this->calculatefilteredData($data['income']->get());
        $data['expance'] = $this->calculatefilteredData($data['expance']->get());
        //data static section
        $data['years'] = range(2021, 2000);
        $data['days'] = range(01, 31);
        $data['month'] =array("January","February","March","April","May","June","July","August","September","October","November","December");

        $data['title'] = 'Report';
		return view('admin.transaction.report.view',$data);
	}
    public function calculatefilteredData($income_total){
        $data_array = array();
        foreach($income_total as $key){
            $key['value'] = 0;
            if(count($key['details'])){
                $return_data = array();
                foreach($key['details'] as $raw){
                        $return_data[] =$raw['total'];
                } 
    
                $key['value'] = array_sum($return_data);
            }
        }
        return $income_total;
    }
}

<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Transaction\TrxExpenceModel;
use App\Models\Transaction\TrxExpenceDetailModel;
use App\Models\Categories\CategoryModel;
use App\Models\Categories\SubCategoryModel;
use Session;

class ExpanceTrasactionController extends Controller
{
	use GeneralServices;
	public function index(){
		$data['data'] = TrxExpenceDetailModel::with(['subcategory','master'])
						->whereHas('master', function($q) {
							$q->where('user_id', '=', Session::get('Users.id'));
						})->get();
		$data['title'] = 'Manage Expance';
		return view('admin.transaction.expance.view',$data);
	}
	public function add(Request $request){
		$data['category'] = CategoryModel::where('type','=','expance')->where('user_id','=',Session::get('Users.id'))->get();
		$data['title'] = 'Manage Expance';
		return view('admin.transaction.expance.add',$data);
	}
	public function store(Request $request){
		$rules = [
			'category_id' => 'Required|integer',
			'sub_category_id' => 'Required|integer',
			'total' => 'Required|numeric',
			'remarks' => 'Required|string',
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		$checkTrxMaster = TrxExpenceModel::where('category_id','=',$request->category_id)->where('user_id',Session::get('Users.id'))->first();
		if (!$checkTrxMaster) {
			$postDataMaster = [
				'category_id' => $request['category_id'],
				'user_id' => Session::get('Users.id'),
				'total' => $request['total'],
			];
			$save = TrxExpenceModel::create($postDataMaster); 
			if(!$save){
				return redirect()->back()->withErrors(['Failed! Server Error!']);  
			}
			$request['id'] = $save->id;
			$savedetail = $this->saveDetailTrx($request->all());  
			if(!$savedetail){
				return redirect()->back()->withErrors(['Failed! Server Error!']);  
			}
		}else{
			$request['id'] = $checkTrxMaster->id;
			$savedetail = $this->saveDetailTrx($request->all());  
			if(!$savedetail){
				return redirect()->back()->withErrors(['Failed! Server Error!']);  
			}
			$request['total'] = $checkTrxMaster->total+$request['total'];
			$savedetail = $this->updateTrx($request->all());  

		} 
		return redirect('/admin/expance')->with('success', "Expance succesfully created");
	}
	public function show($id){
		$data['category'] = CategoryModel::where('type','=','expance')->where('user_id',Session::get('Users.id'))->get();
		$data['subcategory'] = SubCategoryModel::select('subcategory.name','subcategory.id','subcategory.category_id','category.name as category_name')
						->leftJoin('category', 'category.id', '=', 'subcategory.category_id')
						->where('subcategory.type','=','expance')
						->where('category.user_id','=',Session::get('Users.id'))
						->get();
		$data['data'] = TrxExpenceDetailModel::with(['subcategory','master'])
						->where('id',$id)->first();
		$data['title'] = 'Manage Expance';
		return view('admin.transaction.expance.edit',$data);
	}
	public function update(Request $request,$id){
		$rules = [
			'category_id' => 'Required|integer',
			'sub_category_id' => 'Required|integer',
			'total' => 'Required|numeric',
			'remarks' => 'Required|string',
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		//cek if category changed 
		if($request['category_id']==$request['old_category_id']){
			$request['id'] = $id;
			$savedetail = $this->updateDetailTrx($request->all()); 
		}else{
			//if category different check trx, apakah memiliki category baru di table
			$checkTrxMaster = TrxExpenceModel::where('category_id','=',$request->category_id)->where('user_id',Session::get('Users.id'))->first();
			if(!$checkTrxMaster){
				//jika tidak ada maka akan membuat trx master baru & detail
				//lalu menghapus data detail yang lama
				$postDataMaster = [
					'category_id' => $request['category_id'],
					'user_id' => Session::get('Users.id'),
					'total' => $request['total'],
				];
				$save = TrxExpenceModel::create($postDataMaster); 

				$request['id'] = $save->id;
				$this->saveDetailTrx($request->all()); 
				//hapus data detail dan update data detail di trx lama
				TrxExpenceDetailModel::where('id','=',$id)->delete(); 
			}else{
				$request['id'] = $checkTrxMaster->id;
				$savedetail = $this->saveDetailTrx($request->all()); 
				
				$updateDataMaster['total'] = TrxExpenceDetailModel::where('trx_expance_id',$checkTrxMaster->id)->sum('total');
				TrxExpenceModel::where('id','=',$checkTrxMaster->id)->update($updateDataMaster); 
				
				TrxExpenceDetailModel::where('id','=',$id)->delete();
			}    
		}
		//update total di data master ketika terjadi trx di data detail
		$updateDataMaster['total'] = TrxExpenceDetailModel::where('trx_expance_id',$request->trx_expance_id)->sum('total');
		TrxExpenceModel::where('id','=',$request->trx_expance_id)->update($updateDataMaster); 
		
		return redirect('/admin/expance')->with('success', "Expance succesfully updated");
	}
	public function destroy(Request $request,$id,$trx_id){
		$save = TrxExpenceDetailModel::where('id','=',$id)->delete();
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		//setelah delete item data master total harus diupdate
		$updateDataMaster['total'] = TrxExpenceDetailModel::where('trx_expance_id',$trx_id)->sum('total');
		TrxExpenceModel::where('id','=',$trx_id)->update($updateDataMaster);

		return redirect('/admin/expance')->with('success', "Expance succesfully deleted");
	}
	public function saveDetailTrx($data){
		$postDataDetail = [
			'trx_expance_id' => $data['id'],
			'sub_category_id' => $data['sub_category_id'],
			'total' => $data['total'],
			'remarks' => $data['remarks'],
			'spent_at' => $data['spent_at'],
		];
		
		return TrxExpenceDetailModel::create($postDataDetail);  
	}
	public function updateDetailTrx($data){
		$updateDataDetail = [
			'sub_category_id' => $data['sub_category_id'],
			'total' => $data['total'],
			'remarks' => $data['remarks'],
			'spent_at' => $data['spent_at'],
		];
		
		return TrxExpenceDetailModel::where('id','=',$data['id'])->update($updateDataDetail); 
	}
	public function updateTrx($data){
		$updateDataMaster = [
			'total' => $data['total'],
			'category_id' => $data['category_id']
		];
		return TrxExpenceModel::where('id','=',$data['id'])->update($updateDataMaster); 
	}
}

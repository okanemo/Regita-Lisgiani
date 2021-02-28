<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Categories\CategoryModel;
use App\Models\Categories\SubCategoryModel;
use Session;

class IncomeCategoryController extends Controller
{
	use GeneralServices;
	
	public function index(){
		$data['data'] = CategoryModel::where('type','=','income')->where('user_id',Session::get('Users.id'))->get();
		$data['title'] = 'Income Category';
		return view('admin.category.income.view',$data);
	}
	public function add(Request $request){
		$data['title'] = 'Income Category';
		return view('admin.category.income.add',$data);
	}
	public function store(Request $request){
		$rules = [
			'name' => 'Required|string'
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		
		$save = CategoryModel::create($request->except(['_token']));
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		return redirect('/admin/income-category')->with('success', "Category succesfully created");
	}
	public function show($id){
		$data['data'] = CategoryModel::where('type','=','income')->where('user_id',Session::get('Users.id'))->where('id',$id)->first();
		$data['title'] = 'Income Category Edit';
		return view('admin.category.income.edit',$data);
	}
	public function update(Request $request,$id){
		$rules = [
			'name' => 'Required|string'
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		
		$save = CategoryModel::where('id','=',$id)->update($request->except(['_token']));
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		return redirect('/admin/income-category')->with('success', "Category succesfully updated");
	}
	public function destroy(Request $request,$id){
		$save = CategoryModel::where('id','=',$id)->delete();
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		
		SubCategoryModel::where('category_id','=',$id)->delete();
		return redirect('/admin/income-category')->with('success', "Category succesfully deleted");
	}

	///=============== Sub Category ========================
	public function subCategory(){
		$data['data'] = SubCategoryModel::select('subcategory.name','subcategory.id','subcategory.category_id','category.name as category_name')
						->leftJoin('category', 'category.id', '=', 'subcategory.category_id')
						->where('subcategory.type','=','income')
						->where('category.user_id','=',Session::get('Users.id'))
						->get();
		$data['title'] = 'Income Sub-Category';
		return view('admin.subcategory.income.view',$data);
	}
	public function subCategoryAdd(Request $request){
		$data['title'] = 'Income Sub-Category';
		$data['category'] = CategoryModel::where('type','=','income')->where('user_id','=',Session::get('Users.id'))->get();
		return view('admin.subcategory.income.add',$data);
	}
	public function subCategoryStore(Request $request){
		$rules = [
			'category_id' => 'Required|integer',
			'name' => 'Required|string'
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		
		$save = SubCategoryModel::create($request->except(['_token']));
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		return redirect('/admin/income-subcategory')->with('success', "Sub-Category succesfully created");
	}
	public function subCategoryShow($id){
		$data['data'] = SubCategoryModel::where('type','=','income')->where('id',$id)->first();
		$data['title'] = 'Income Sub-Category Edit';
		$data['category'] = CategoryModel::where('type','=','income')->where('user_id','=',Session::get('Users.id'))->get();
		return view('admin.subcategory.income.edit',$data);
	}
	public function subCategoryUpdate(Request $request,$id){
		$rules = [
			'category_id' => 'Required|integer',
			'name' => 'Required|string'
		];
		$validateData = $this->ValidateRequest($request->all(), $rules);

		if (!empty($validateData)) {
			return redirect()->back()->withErrors($validateData);
		}
		
		$save = SubCategoryModel::where('id','=',$id)->update($request->except(['_token']));
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		return redirect('/admin/income-subcategory')->with('success', "Sub-Category succesfully updated");
	}
	public function subCategoryDestroy(Request $request,$id){
		$save = SubCategoryModel::where('id','=',$id)->delete();
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);  
		}  
		return redirect('/admin/income-subcategory')->with('success', "Sub-Category succesfully deleted");
	}
}

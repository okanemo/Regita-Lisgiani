<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use App\Models\Categories\CategoryModel;
use App\Models\Categories\SubCategoryModel;
use Illuminate\Http\Request;
use Session;

class ExpanceCategoryController extends Controller
{
	use GeneralServices;
	public function index(){
		$data['data'] = CategoryModel::where('type','=','expance')->where('user_id',Session::get('Users.id'))->get();
		$data['title'] = 'Expance Category';
		return view('admin.category.expance.view',$data);
	}
	public function add(Request $request){
		$data['title'] = 'Expance Category';
		return view('admin.category.expance.add',$data);
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
		return redirect('/admin/expance-category')->with('success', "Category succesfully created");
	}
	public function show($id){
		$data['data'] = CategoryModel::where('type','=','expance')->where('user_id',Session::get('Users.id'))->where('id',$id)->first();
		$data['title'] = 'Expance Category Edit';
		return view('admin.category.expance.edit',$data);
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
		return redirect('/admin/expance-category')->with('success', "Category succesfully updated");
	}
	public function destroy(Request $request,$id){
		$save = CategoryModel::where('id','=',$id)->delete();
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);
		}

		SubCategoryModel::where('category_id','=',$id)->delete();
		return redirect('/admin/expance-category')->with('success', "Category succesfully deleted");
	}

	///=============== Sub Category ========================
	public function subCategory(){
		$data['data'] = SubCategoryModel::select('subcategory.name','subcategory.id','subcategory.category_id','category.name as category_name')
						->leftJoin('category', 'category.id', '=', 'subcategory.category_id')
						->where('subcategory.type','=','expance')
						->where('category.user_id','=',Session::get('Users.id'))
						->get();
		$data['title'] = 'Expance Sub-Category';
		return view('admin.subcategory.expance.view',$data);
	}
	public function subCategoryAdd(Request $request){
		$data['title'] = 'Expance Sub-Category';
		$data['category'] = CategoryModel::where('type','=','expance')->where('user_id','=',Session::get('Users.id'))->get();
		return view('admin.subcategory.expance.add',$data);
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
		return redirect('/admin/expance-subcategory')->with('success', "Sub-Category succesfully created");
	}
	public function subCategoryShow($id){
		$data['data'] = SubCategoryModel::where('type','=','expance')->where('id',$id)->first();
		$data['title'] = 'Expance Sub-Category Edit';
		$data['category'] = CategoryModel::where('type','=','expance')->where('user_id','=',Session::get('Users.id'))->get();
		return view('admin.subcategory.expance.edit',$data);
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
		return redirect('/admin/expance-subcategory')->with('success', "Sub-Category succesfully updated");
	}
	public function subCategoryDestroy(Request $request,$id){
		$save = SubCategoryModel::where('id','=',$id)->delete();
		if(!$save){
			return redirect()->back()->withErrors(['Failed! Server Error!']);
		}
		return redirect('/admin/expance-subcategory')->with('success', "Sub-Category succesfully deleted");
	}
}



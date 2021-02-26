<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories\SubCategoryModel;

class GeneralController extends Controller
{
	public function getSubCategorybyCategoryId($id){
		$data = SubCategoryModel::where('category_id','=',$id)->pluck("name","id");
		return json_encode($data);
	}
}

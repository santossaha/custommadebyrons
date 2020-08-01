<?php

namespace App\Helpers;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Front\Category;
use App\Models\Front\SubCategory;
use DB;
use Input;
use Image;
use Auth;
use Mail;

class CategoryHelper
{

	public static function CategoryWithSubcategory()
	{
		return $data = Category::with(['submenu'])->where(['deleted_at'=>NULL])->where(['status'=>'Active'])->orderBy('category_name','ASC')->get();
		
	}
}

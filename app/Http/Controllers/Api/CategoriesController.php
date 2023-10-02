<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{


    public function addCategory(Request $request){


        $validateData=$request->validate([
            'category_name'=>'required|unique:categories,category_name',
            'shop_id'=>'required'
        ]);



        $category = Category::create([
            'category_name'=>$request->category_name,
            'shop_id'=>$request->shop_id
        ]);

        if($category){
            return response([
                'notification' => 'Success',
                'message' => 'Category Created Successfully',
                'category'=>$category
            ], 200);

        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Create Category'
            ], 401);
        }



    }

    public function getCategories(){
        $categories = Category::all();
        return response([
            'categories'=>$categories
        ], 200);

    }



    public function deleteCategory(Request $request){

        $validateData=$request->validate([
            'category_id'=>'required'
        ]);

        $customer = Category::where('id',$request->category_id)->delete();

        if($customer){
            return response([
                'notification' => 'success',
                'message' => 'Category Deleted'
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Delete Category'
            ], 401);
        }



    }


}

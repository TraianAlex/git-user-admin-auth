<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function getCategoryIndex()
    {
    	$categories = Category::orderBy('created_at', 'desc')->paginate(5);
    	return view('admin.categories', compact('categories'));
    }

    public function postCreateCategory(CreateCategoryRequest $request)
    {
    	$category = new Category();
    	$category->name = $request->name;
    	if($category->save()){
    		return response()->json(['message' => 'Category created'], 200);
    	}
    	return response()->json(['message' => 'Error during creation'], 404);
    }

    public function postUpdateCategory(UpdateCategoryRequest $request)
    {
        $category = Category::find($request->category_id);
        if(!$category){
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->name = $request->name;
        $category->update();
        return response()->json(['message' => 'Category updated', 'new_name'=> $request->name], 200);
    }

    public function getDeleteCategory($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return response()->json(['massage' => 'Category deleted'], 200);
    }
}

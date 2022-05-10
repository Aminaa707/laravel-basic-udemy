<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.Category.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:50',
            ],
            [
                'category_name.required' => 'Please Add Category Name',
                'category_name.max' => 'Category Less Then 50Chares',
            ]
        );

        //using model
        // Category::insert([
        //     "category_name" => $request->category_name,
        //     "user_id" => Auth::user()->id,
        //     "created_at" => Carbon::now()
        // ]);


        //By query
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with("success", "Category Added Successfully");
    }
}

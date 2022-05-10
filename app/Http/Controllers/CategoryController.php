<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {

        // *** For using the pagination instead of get() we use paginate() and we defined per page number like 5. ***
        // ORM
        $categories = Category::latest()->paginate(5);

        // Query
        // $categories = DB::table('categories')->latest()->paginate(5);     
        return view('admin.Category.index', compact("categories"));
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

        //using model method -1 
        Category::insert([
            "category_name" => $request->category_name,
            "user_id" => Auth::user()->id,
            "created_at" => Carbon::now()
        ]);


        //using model method - 2 
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // using Query
        // $data = array();
        // $data["category_name"] = $request->category_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with("success", "Category Added Successfully");
    }
}

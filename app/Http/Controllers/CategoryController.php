<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    public function index()
    {

        // *** For using the pagination instead of get() we use paginate() and we defined per page number like 5. ***
        // ORM
        $categories = Category::latest()->paginate(5);


        // Query...
        // $categories = DB::table('categories')->latest()->paginate(5);


        // Join table by using Query....
        // $categories = DB::table("categories")
        //     ->join("users", "categories.user_id", "users.id")
        //     ->select("categories.*", "users.name")
        //     ->latest()->paginate(5);


        // soft delete
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);


        return view('admin.Category.index', compact("categories", "trashCat"));
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


        //using model method - 2 .........
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // using Query......
        // $data = array();
        // $data["category_name"] = $request->category_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with("success", "Category Added Successfully");
    }

    public function edit($id)
    {
        // orm
        $category = Category::find($id);

        //  Query
        // $category = DB::table('categories')->where('id', $id)->first();

        return view('admin.Category.edit', compact("category"));
    }

    public function update(Request $request, $id)
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

        // orm
        $update = Category::find($id)->update([
            "category_name" => $request->category_name,
            "user_id" => Auth::user()->id
        ]);

        // Query
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route("all.category")->with("success", "Category Updated Successfully");
    }

    public function softDelete($id)
    {
        $delete = Category::find($id)->delete();

        return redirect()->back()->with('success', "Category Soft Deleted Successfully done!");
    }

    public function restore($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', "Category restore Successfully");
    }

    public function permanentlyDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', "Category permanently deleted Successfully");
    }
}

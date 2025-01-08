<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    public function list()
    {
        try {
            $rows = Category::orderBy('id','ASC')->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:100',
        ]);

        try {
            // $slug = Str::slug($request->input('name'));
            Category::create($validatedData);
            return response()->json(['status' => 'success', 'message' => 'Category created successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }

    }

    function byId(Request $request)
    {
        try{
            $request->validate([
                'id' => 'required|min:1'
            ]);

            $updateId = $request->input('id');

            $rows = Category::where('id',$updateId)->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $categoryId = $request->updateId;

            Category::where('id',$categoryId)->update([
                'name' => $request->nameUpdate,
                'description' => $request->descriptionUpdate,
                'status' => $request->statusUpdate,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Category update successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $category_id = $request->deleteId;

        $deleteId = Category::where('id',$category_id)->exists();

        try {
            if ($deleteId) {
                Category::where('id',$category_id)->delete();
                return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Category does not exist']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }
}

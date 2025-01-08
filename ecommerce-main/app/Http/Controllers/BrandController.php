<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brands.index');
    }

    public function list()
    {
        try {
            $rows = Brand::orderBy('id','ASC')->get();
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
            $slug = Str::slug($request->input('name'));

            Brand::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Brand created successfully']);
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

            $rows = Brand::where('id',$updateId)->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $brandId = $request->updateId;
            $slug = Str::slug($request->input('nameUpdate'));

            Brand::where('id',$brandId)->update([
                'name' => $request->nameUpdate,
                'slug' => $slug,
                'description' => $request->descriptionUpdate,
                'status' => $request->statusUpdate,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Brand update successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $brand_id = $request->deleteId;

        $deleteId = Brand::where('id',$brand_id)->exists();

        try {
            if ($deleteId) {
                Brand::where('id',$brand_id)->delete();
                return response()->json(['status' => 'success', 'message' => 'Brand deleted successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Brand does not exist']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }



    }
}

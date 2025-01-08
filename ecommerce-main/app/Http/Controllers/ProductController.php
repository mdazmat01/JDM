<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status','active')->get();
        $brands = Brand::where('status','active')->get();
        return view('admin.products.index', compact('categories','brands'));
    }

    public function list()
    {
        try {
            $rows = Product::with('brand')->with('category')->orderBy('id','ASC')->get();
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
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|float',
        //     'stock' => 'required|integer',
        //     'color' => 'required|string|max:200',
        //     'image' => 'required|image|mimes:png,jpg,jpeg,webp',
        //     'status' => 'required|string|max:100',
        // ]);

        try {
            $product = Product::create([
                'category_id' => $request->categoryId,
                'brand_id' => $request->brandId,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'color' => $request->color,
                'status' => $request->status,
            ]);

            $imageData = [];
            if ($files = $request->file('images')) {
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $key.time().'.'.$extension;
                    $filePath = 'uploads/products/';

                    $file->move(public_path($filePath),$fileName);

                    $imageData[] = ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $filePath.$fileName
                    ]);
                }
            }

            // ProductImage::insert($imageData);

            return response()->json(['status' => 'success', 'message' => 'Product created successfully']);
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

            $rows = Product::where('id',$updateId)->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $productId = $request->updateId;

            Product::where('id',$productId)->update([
                'name' => $request->nameUpdate,
                'description' => $request->descriptionUpdate,
                'status' => $request->statusUpdate,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Product update successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->deleteId);

        $productImages = ProductImage::where('product_id',$product->id)->get();

        foreach ($productImages as $productImage) {
            $filePath = $productImage->image;

            File::delete(public_path($filePath));
        }

        $deleteExist = Product::where('id',$product->id)->exists();

        try {
            if ($deleteExist) {
                Product::where('id',$product->id)->delete();
                return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Product does not exist']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => $th->getMessage()]);
        }
    }

    public function listImage($productId) {
        $product = Product::findOrFail($productId);
        $productImages = ProductImage::where('product_id', $productId)->get();
        return view('components.admins.products.images.index',compact('productImages','product'));
    }

    public function storeImage(Request $request, $productId) {
        $request->validate([
            'productImage.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $product = Product::findOrFail($productId);

        if ($files = $request->file('productImage')) {
            // dd($request->file('productImage'));
            foreach ($files as $key => $file) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileLocation = 'uploads/products/';
                $fileName = $key.time().'.'.$fileExtension;

                $file->move(public_path($fileLocation),$fileName );

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $fileLocation.$fileName
                ]);
            }
        }

        return redirect()->back()->with('success','Product Images uploaded successfully');

    }

    public function deleteImage($prodImageId) {
        $productImage = ProductImage::findOrFail($prodImageId);
        $productImage->delete();
        return redirect()->back()->with('success', 'Product Images deleted successfully');
    }
}

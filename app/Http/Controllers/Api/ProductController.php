<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->paginate && in_array($request->paginate,['5','10','20'])){
            $paginate=$request->paginate;
        }else{
            $paginate=5;
        }

        if($request->sortBy && in_array($request->sortBy,['id','name','slug'])){
            $sortBy=$request->sortBy;
        }else{
            $sortBy='id';
        }

        if($request->sortOrder && in_array($request->sortOrder,['asc','desc'])){
            $sortOrder=$request->sortOrder;
        }else{
            $sortOrder='desc';
        }

        if($request->name){
            $products = DB::table('products') 
            ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($request->name) . '%')
            ->orderBy($sortBy,$sortOrder)
            ->paginate($paginate);
        }else{
            $products = Product::orderBy($sortBy,$sortOrder)->paginate($paginate);
        }

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required']
        ]);
        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required']
        ]);

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->save();

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}

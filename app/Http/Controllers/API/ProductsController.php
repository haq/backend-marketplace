<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{
    /**
     * Create a new ProductsController instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'available' => 'nullable',
            'paginate' => 'nullable|int',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $paginate = 10;
        if ($request->has('paginate')) {
            $paginate = $request->input('paginate');
        }
        if ($request->has('available')) {
             return response(Product::where('inventory_count', '>', 0)->paginate($paginate));
        } else {
            return Product::paginate($paginate);
        }
    }

    /**
     * Display the specified resource.  
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try { 
            return Product::findOrFail($id);
        } catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Not Found', 'status' => 404], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }
}

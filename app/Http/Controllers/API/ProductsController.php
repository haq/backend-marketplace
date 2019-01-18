<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Validator;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'available' => 'nullable',
            'paginate' => 'nullable|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $paginate = 10;
        if ($request->has('paginate')) {
            $paginate = $request->input('paginate');
        }
        if ($request->has('available')) {
            return Product::where('inventory_count', '>', 0)->paginate($paginate);
        } else {
            return Product::paginate($paginate);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }
}

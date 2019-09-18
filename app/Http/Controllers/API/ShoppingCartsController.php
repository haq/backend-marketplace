<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingCart as ShoppingCartResource;
use App\Product;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Validator;

class ShoppingCartsController extends Controller
{
    /**
     * ShoppingCartsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Creating a new shopping cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        // TODO: check if a non completed shopping cart already exists from this user
        $cart = ShoppingCart::firstOrCreate(
            [
                'user_id' => $request->user()->id,
            ]
        ); 

        return response()->json([
            'message' => 'Shopping Cart',
            'id' => $cart->id
        ], 200);
    }

    /**
     * Showing info about the shopping cart.
     *
     * @param ShoppingCart $shoppingcart
     * @return mixed
     */
    public function show(ShoppingCart $shoppingcart)
    {
        return new ShoppingCartResource($shoppingcart);
    }

    /**
     * Adding a product to the shopping cart.
     *
     * @param ShoppingCart $shoppingcart
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(ShoppingCart $shoppingcart, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|int'
        ]);
        if ($validator->fails()) {
            return $this::jsonResponse(['message' => 'Bad Request'], 400);
        }
        
        // this shopping cart does not belong to this user
        if($shoppingcart->user_id !== $request->user()->id){
            return $this::jsonResponse('403 Forbidden', 403);
        }

        // checking if the cart is already completed
        if ($shoppingcart->completed) {
            return $this::jsonResponse(['message' => 'Shopping Cart already completed.'], 409);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->product_id);

        // checking if the product is out of stock
        if ($product->inventory_count == 0) {
            return $this::jsonResponse(['message' => 'Product out of stock.'], 409);
        }

        // checking if this cart already contains this product
        foreach ($shoppingcart->products()->get() as $prod) {
            if ($prod->id == $product->id) {
                return $this::jsonResponse(['message' => 'This cart already contains this product.'], 409);
            }
        }

        // adding the product to the cart
        $shoppingcart->products()->attach($product->id);
        $shoppingcart->save();

        return $this::jsonResponse(['message' => 'Product added to cart.'], 200);
    }

    /**
     * Removing product from the cart.
     *
     * @param ShoppingCart $shoppingcart
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(ShoppingCart $shoppingcart, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|int'
        ]);
        if ($validator->fails()) {
            return $this::jsonResponse(['message' => 'Bad Request'], 400);
        }

        // this shopping cart does not belong to this user
        if($shoppingcart->user_id !== $request->user()->id){
            return $this::jsonResponse('403 Forbidden', 403);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->product_id);

        foreach ($shoppingcart->products()->get() as $prod) {
            if ($prod->id == $product->id) {
                
                // removing product from the cart
                $shoppingcart->products()->detach($product->id);
                $shoppingcart->save();

                return $this::jsonResponse(['message' => 'Product removed.'], 200);
            }
        }

        return $this::jsonResponse(['message' => 'This cart does not contain this product.'], 300);
    }

    /**
     * Completed the shopping cart.
     *
     * @param ShoppingCart $shoppingcart
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete(ShoppingCart $shoppingcart, Request $request)
    {
         // this shopping cart does not belong to this user
         if($shoppingcart->user_id !== $request->user()->id){
            return $this::jsonResponse('403 Forbidden', 403);
        }
        
        // checking if the cart has already been completed
        if ($shoppingcart->completed) {
            return $this::jsonResponse(['message' => 'This shopping cart has already been completed.'], 400);
        }

        $count = $shoppingcart->products()->count();

        // checking the cart is empty
        if ($count == 0) {
            return $this::jsonResponse(['message' => 'This shopping cart is empty.'], 400);
        }

        $price = 0;
        foreach ($shoppingcart->products()->get() as $product) {

            if ($product->inventory_count == 0) {
                return $this::jsonResponse([
                    'message' => 'This product is out of stock.',
                    'id' => $product->id
                ], 400);
            }

            $price += $product->price;

            // decreasing the inventory count
            $product->inventory_count--;
            $product->save();
        }

        $shoppingcart->completed = true;
        $shoppingcart->save();

        return response()->json([
            'message' => 'Shopping cart completed.',
            'amount' => $count,
            'price' => $price
        ], 200);
    }
}
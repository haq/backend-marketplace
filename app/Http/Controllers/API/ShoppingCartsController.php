<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingCart as ShoppingCartResource;
use App\Product;
use App\ShoppingCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $cart = ShoppingCart::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'completed' => false
            ]
        );

        return response()->json([
            'message' => 'Cart created.',
            'cart_id' => $cart->id
        ], 201);
    }

    /**
     * Showing info about the shopping cart.
     *
     * @param ShoppingCart $shoppingCart
     * @param Request $request
     * @return mixed
     */
    public function show(ShoppingCart $shoppingCart, Request $request)
    {
        if ($shoppingCart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => '403 Forbidden'
            ], 403);
        }

        return new ShoppingCartResource($shoppingCart);
    }

    /**
     * Adding a product to the shopping cart.
     *
     * @param ShoppingCart $shoppingCart
     * @param Request $request
     * @return JsonResponse
     */
    public function add(ShoppingCart $shoppingCart, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request'
            ], 400);
        }

        // checking if this shopping cart belongs to this user
        if ($shoppingCart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => '403 Forbidden'
            ], 403);
        }

        // checking if the cart is already completed
        if ($shoppingCart->completed) {
            return response()->json([
                'message' => 'Shopping Cart already completed.'
            ], 409);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->product_id);

        // checking if the product is out of stock
        if ($product->inventory_count == 0) {
            return response()->json([
                'message' => 'Product out of stock.'
            ], 409);
        }

        // checking if this cart already contains this product
        foreach ($shoppingCart->products()->get() as $prod) {
            if ($prod->id == $product->id) {
                return response()->json([
                    'message' => 'This cart already contains this product.'
                ], 409);
            }
        }

        // adding the product to the cart
        $shoppingCart->products()->attach($product->id);
        $shoppingCart->save();

        return response()->json([
            'message' => 'Product added to cart.'
        ], 200);
    }

    /**
     * Removing product from the cart.
     *
     * @param ShoppingCart $shoppingCart
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(ShoppingCart $shoppingCart, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '400 Bad Request'
            ], 400);
        }

        // this shopping cart does not belong to this user
        if ($shoppingCart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => '403 Forbidden'
            ], 403);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->product_id);

        foreach ($shoppingCart->products()->get() as $prod) {
            if ($prod->id == $product->id) {

                // removing product from the cart
                $shoppingCart->products()->detach($product->id);
                $shoppingCart->save();

                return response()->json([
                    'message' => 'Product removed.'
                ], 200);
            }
        }

        return response()->json([
            'message' => 'This cart does not contain this product.'
        ], 409);
    }

    /**
     * Completed the shopping cart.
     *
     * @param ShoppingCart $shoppingCart
     * @param Request $request
     * @return JsonResponse
     */
    public function complete(ShoppingCart $shoppingCart, Request $request)
    {
        // this shopping cart does not belong to this user
        if ($shoppingCart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => '403 Forbidden'
            ], 403);
        }

        // checking if the cart has already been completed
        if ($shoppingCart->completed) {
            return response()->json([
                'message' => 'This shopping cart has already been completed.'
            ], 409);
        }

        $count = $shoppingCart->products()->count();

        // checking the cart is empty
        if ($count == 0) {
            return response()->json([
                'message' => 'This shopping cart is empty.'
            ], 409);
        }

        $price = 0;
        foreach ($shoppingCart->products()->get() as $product) {

            if ($product->inventory_count == 0) {
                return response()->json([
                    'message' => 'This product is out of stock. Please remove this product before completing.',
                    'product_id' => $product->id
                ], 409);
            }

            $price += $product->price;

            // decreasing the inventory count
            $product->inventory_count--;
            $product->save();
        }

        $shoppingCart->completed = true;
        $shoppingCart->save();

        return response()->json([
            'message' => 'Shopping cart completed.',
            'amount' => $count,
            'price' => $price
        ], 200);
    }
}

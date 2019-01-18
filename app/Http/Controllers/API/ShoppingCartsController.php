<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
    public function create()
    {
        $cart = new ShoppingCart();
        $cart->save();
        return response()->json([
            'message' => 'New shopping cart created.',
            'id' => $cart->id
        ], 200);
    }

    /**
     * Showing info about the shopping cart.
     *
     * @param ShoppingCart $shoppingcart
     * @return mixed
     */
    // TODO: return proper info
    public function show(ShoppingCart $shoppingcart)
    {
        return $shoppingcart->products()->getResults();
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
            return response()->json(['message' => 'Bad Request'], 400);
        }

        // checking if the cart is already completed
        if ($shoppingcart->completed) {
            return response()->json(['message' => 'This shopping cart has already been completed.'], 400);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->input('product_id'));

        // checking if the product is out of stock
        if ($product->inventory_count == 0) {
            return response()->json(['message' => 'Product is out of stock.'], 400);
        }

        // checking if this cart already contains this product
        foreach ($shoppingcart->products()->get() as $prod) {
            if ($prod->id == $product->id) {
                return response()->json(['message' => 'This cart already contains this product.'], 400);
            }
        }

        // adding the product to the cart
        $shoppingcart->products()->attach($product->id);
        $shoppingcart->save();

        return response()->json(['message' => 'Product added to cart.'], 200);
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
            return response()->json(['message' => 'Bad Request'], 400);
        }

        // checking if the product exists
        $product = Product::findOrFail($request->input('product_id'));

        foreach ($shoppingcart->products()->get() as $prod) {
            if ($prod->id == $product->id) {
                // removing product from the cart
                $shoppingcart->products()->detach($product->id);
                $shoppingcart->save();

                return response()->json(['message' => 'Product removed.'], 200);
            }
        }

        return response()->json(['message' => 'This cart does not contain this product.'], 300);
    }

    /**
     * Completed the shopping cart.
     *
     * @param ShoppingCart $shoppingcart
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete(ShoppingCart $shoppingcart)
    {
        // checking if the cart has already been completed
        if ($shoppingcart->completed) {
            return response()->json(['message' => 'This shopping cart has already been completed.'], 400);
        }

        $count = $shoppingcart->products()->count();

        // checking the cart is empty
        if ($count == 0) {
            return response()->json(['message' => 'This shopping cart is empty.'], 400);
        }

        $price = 0;
        foreach ($shoppingcart->products()->get() as $product) {

            if ($product->inventory_count == 0) {
                return response()->json([
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
<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller implements HasMiddleware
{
    // !Set sanctum middle wear to controller
    public static function middleware()
    {
        return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    }

    // TODO: Get all product
    public function index()
    {
        return products::with('user')->get();
    }

    // TODO: Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:0,2',
            'quantity' => 'required|numeric',
            'description' => 'required',
        ]);
        $product =  $request->user()->products()->create($data);
        return  $product;
    }

    // TODO: Get one product
    public function show($id)
    {
        $product = products::find($id);
        if (!$product) return response()->json(['error' => 'Product not found'], 404);
        return $product;
    }


    // TODO: Update product
    public function update(Request $request, $id)
    {
        $product = products::find($id);
        if (!$product) return response()->json(['error' => 'Product not found'], 404);
        Gate::authorize('modify', $product);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:0,2',
            'quantity' => 'required|numeric',
            'description' => 'required',
        ]);
        $product->update($data);
        return $product;
    }

    // TODO: Delete product
    public function destroy($id)
    {
        $product = products::find($id);
        if (!$product) return response()->json(['error' => 'Product not found'], 404);
        Gate::authorize('modify', $product);
        $product->delete();
        return ['message' => 'Product deleted successfully'];
    }

    // front-end

    // TODO: Get all product
    public function getAll(Request $request)
    {
        $products = products::with('user')->get();
        $token = $request->session()->get('auth_token');
        return view('products.index', ['products' => $products, 'token' => $token]);
    }

    // TODO: Get product belongs to loffed user
    public function getYour(Request $request)
    {
        $userId = Auth::id();
        $products = products::with('user')->where('user_id', $userId)->get();
        $token = $request->session()->get('auth_token');
        return view('products.products', ['products' => $products, 'token' => $token]);
    }

    // TODO: Return product create form
    public function create(Request $request)
    {
        return view('products.create');
    }

    // TODO: Return product update form
    public function edit(products $product)
    {
        Gate::authorize('modify', $product);
        return view('products.edit', ['product' => $product]);
    }

    // TODO: Return product delete form
    public function delete(products $product)
    {
        Gate::authorize('modify', $product);
        return view('products.delete', ['product' => $product]);
    }
}

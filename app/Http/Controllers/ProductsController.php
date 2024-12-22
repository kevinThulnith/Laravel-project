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

    public static function middleware()
    {
        return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return products::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = products::find($id);
        if (!$product) return response()->json(['error' => 'Product not found'], 404);
        return $product;
    }


    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = products::find($id);
        if (!$product) return response()->json(['error' => 'Product not found'], 404);
        Gate::authorize('modify', $product);
        $product->delete();
        return ['message' => 'Product deleted successfully'];
    }

    public function getAll(Request $request)
    {
        $products = products::with('user')->get();
        $token = $request->session()->get('auth_token');
        return view('products.index', ['products' => $products, 'token' => $token]);
    }

    public function getYour(Request $request)
    {
        $userId = Auth::id();
        $products = products::with('user')->where('user_id', $userId)->get();
        $token = $request->session()->get('auth_token');
        return view('products.products', ['products' => $products, 'token' => $token]);
    }

    public function create(Request $request)
    {
        return view('products.create');
    }

    public function edit(products $product)
    {
        Gate::authorize('modify', $product);
        return view('products.edit', ['product' => $product]);
    }

    public function delete(products $product)
    {
        Gate::authorize('modify', $product);
        return view('products.delete', ['product' => $product]);
    }
}

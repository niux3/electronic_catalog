<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.name', 'products.sku', 'categories.name AS category', 'products.id', 'products.quantity', 'products.price', 'products.created_at', 'products.updated_at')
        ->get();
        Log::info(sprintf("display products by : %s", request()->ip()));
        return response()->json($products);
    }


    public function show($id)
    {
        $product = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.name', 'products.sku', 'categories.name AS category', 'products.id', 'products.quantity', 'products.price', 'products.created_at', 'products.updated_at')
            ->where('products.id', $id)
            ->get();
        if(count($product)){
            Log::info(sprintf("display product %s by : %s", $id, request()->ip()));
            return response()->json($product);
        }else{
            Log::warning(sprintf("can't get product %s by : %s", $id, request()->ip()));
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }


    public function create(Request $request)
    {
        $this->validate($request, Product::$rules);
        $product = $this->edit(new Product(), $request->all(), [
            'mask' => "product %s by : %s",
            'args' => ['created', request()->ip()]
        ]);
        return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, Product::$rules);
        $product = $this->edit(Product::findOrFail($id), $request->all(), [
            'mask' => "product %s %s by : %s",
            'args' => [$id, 'updated', request()->ip()]
        ]);

        return response()->json($product);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }


    private function edit($product, $data, $logs_args)
    {
        $product->name = $data['name'];
        $product->sku = $data['sku'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->category_id = $data['category'];
        Log::info(vsprintf($logs_args['mask'], $logs_args['args']));
        $x = $product->save();
        return $product;
    }


}

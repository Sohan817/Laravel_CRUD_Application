<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', ['products' => Product::latest()->paginate(5)]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,gif'
        ]);
        //Upload and Image Naming
        $imageName = time() . '.' . $request->image->extension();
        //Move to Public folder
        $request->image->move(public_path('products'), $imageName);

        //Save products to database
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->save();
        return redirect()->route('products.index')->with('Success', 'Product added successfully!');
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable | mimes:jpeg,jpg,png,gif'
        ]);

        $product = Product::where('id', $id)->first();

        if (isset($request->image)) {
            //Upload and Image Naming
            $imageName = time() . '.' . $request->image->extension();
            //Move to Public folder
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }
        //Save products to database
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('products.index')->with('Success', 'Product updated successfully!');
    }
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('products.index')->with('Success', 'Product deleted successfully!');
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.show', ['product' => $product]);
    }
}

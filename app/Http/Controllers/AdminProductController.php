<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        return view("products", [
            "products" => Product::all(),
        ]);
    }

    public function create()
    {
        return view("addProduct", [
            "categories" => Category::all(),
        ]  );
    }

    public function store(Request $request)
    {
         $data = $request->validate([
            "name" => "required|min:5|max:80",
            "price" => "required|min:0",
            "quantity" => "required|min:0",
            "category" => "required",
            "product_image" => "image|file",
        ]);

        if($request->hasFile("product_image")){
            $data["product_image"] = $request->file("product_image")->store("product-images");
        }

        Product::create([
            "product_name" => $data["name"],
            "category_id" => $data["category"],
            "product_price" => $data["price"],
            "product_quantity" => $data["quantity"],
            "product_image" => $request->hasFile("product_image") ? $data["product_image"] : null,
        
        ]);

        return redirect("/admin")->with("success", "Product has been added successfully");
    }

    public function edit(Product $product)
    {
        return view("editProduct", [
            "product" => $product,
            "categories" => Category::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            "name" => "required|min:5|max:80",
            "price" => "required|min:0",
            "quantity" => "required|min:0",
            "category" => "required",
            "product_image" => "image|file",
        ]);
        
        if($request->hasFile("product_image")){
            if($product->product_image != null){
                Storage::delete($product->product_image);
            }

            $data["product_image"] = $request->file("product_image")->store("product-images");

            Product::where("id", $product->id)->update([
                "product_name" => $data["name"],
                "category_id" => $data["category"],
                "product_price" => $data["price"],
                "product_quantity" => $data["quantity"],
                "product_image" => $data["product_image"],
            ]);
        }else{
            Product::where("id", $product->id)->update([
                "product_name" => $data["name"],
                "category_id" => $data["category"],
                "product_price" => $data["price"],
                "product_quantity" => $data["quantity"],
            ]);
        }
        
        return redirect("/admin")->with("success", "Product has been updated successfully");
    }
    
    public function destroy(Product $product)
    {
        if($product->product_image != NULL) Storage::delete($product->product_image);
        Product::destroy($product->id);
        return redirect("/admin")->with("success", "Product has been deleted successfully");
    }
}
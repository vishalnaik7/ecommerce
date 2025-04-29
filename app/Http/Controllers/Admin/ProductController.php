<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('images')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
    
        // Store uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path
                ]);
            }
        }
    
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }
    


    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product and its images.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
    
        return redirect()->route('admin.products.edit', $id)
                         ->with('success', 'Product details updated successfully.');
    }
    
    public function uploadImages(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
    
                $product->images()->create([
                    'image_path' => $path
                ]);
            }
        }
    
        return redirect()->route('admin.products.edit', $id)
                         ->with('success', 'Images uploaded successfully.');
    } 

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete related images from storage
        foreach($product->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Remove a single product image (used separately if needed).
     */
    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        $product = $image->product;
    
        // Delete the image from storage
        Storage::disk('public')->delete($image->image_path); // image_path already includes 'products/filename.jpg'
    
        // Delete the database record
        $image->delete();
    
        return redirect()
            ->route('admin.products.edit', $product->id)
            ->with('success', 'Image deleted successfully.');
    }
    

}

@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Edit Product</h2>

    <!-- Form to update product title and price -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product Details</button>
    </form>

    <hr class="my-5">

    <!-- Existing Images Section -->
    @if($product->images->count())
        <div class="mb-3">
            <h5>Existing Images:</h5>
            <div class="row">
                @foreach($product->images as $image)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image"
                             class="img-fluid mb-2" style="max-height: 150px;">
                        <form action="{{ route('admin.products.deleteImage', $image->id) }}"
                              method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <hr class="my-5">

    <!-- Separate form for uploading images -->
    <form action="{{ route('admin.products.uploadImages', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="images" class="form-label">Upload New Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
            <small class="text-muted">You can upload multiple images</small>
        </div>

        <button type="submit" class="btn btn-secondary">Upload Images</button>
    </form>
</div>
@endsection

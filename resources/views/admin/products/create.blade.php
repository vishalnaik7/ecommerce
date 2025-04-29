@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Product</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="images">Product Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
            </div>

            <button type="submit" class="btn btn-success">Create Product</button>
        </form>
    </div>
@endsection

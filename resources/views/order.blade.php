@extends('layouts.user')

@section('content')
<div class="container py-5">
    <!-- Order Success Message -->
    <div class="row mb-4 text-center">
        <div class="col-12">
            <h2 class="text-success">🎉 Order Placed Successfully!</h2>
            <p class="lead">Thank you for your purchase! Below are your order details:</p>
        </div>
    </div>

    <!-- Display Grouped Order Items -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                @foreach($groupedOrderItems as $orderId => $items)
                    <table class="table table-bordered table-striped mb-4">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $orderTotal = 0;
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->order_id }}</td>
                                    <!-- Product Image -->
                                    <td>
                                        @if($item->product && $item->product->firstImage)
                                            <img src="{{ asset('storage/' . $item->product->firstImage->image_path) }}" class="img-fluid" alt="Product Image" width="80">
                                        @else
                                            <img src="https://via.placeholder.com/80x80?text=No+Image" class="img-fluid" alt="No Image">
                                        @endif
                                    </td>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @php
                                    $orderTotal += $item->price * $item->quantity;
                                @endphp
                            @endforeach

                            <!-- Total row for each order -->
                            <tr>
                                <td colspan="5" class="text-right"><strong>Total Amount:</strong></td>
                                <td><strong>₹{{ number_format($orderTotal, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Order Actions -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a> 
        </div>
    </div>
</div>
@endsection

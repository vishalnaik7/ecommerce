@extends('layouts.user') <!-- or your layout -->

@section('title', 'Order Success')

@section('content')
<div class="container text-center py-5">
    <h1 class="text-success">🎉 Order Placed Successfully!</h1>
    <p class="lead">Thank you for your purchase. Below are your order details:</p>
    
    <div class="order-details">
        <h4>Order ID: {{ $order->order_number }}</h4>
        <h5>Total: ₹{{ $order->total_amount }}</h5> 
    </div>
    
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Homepage</a>
</div>
@endsection

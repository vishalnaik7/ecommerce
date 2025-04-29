@extends('layouts.user')

@section('content')

<main id="content">
    <section class="py-2 bg-gray-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none text-body" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="text-center mt-9 mb-8">Shopping Cart</h2>

            @if($cartItems->isEmpty())
            <p class="text-center">Your cart is empty.</p>
            @else
            <div class="table-responsive-md pb-8 pb-lg-10">
                <table class="table border-right border-left mb-0">
                    <thead>
                        <tr>
                            <th class="pl-xl-6">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-right pr-6">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($cartItems as $item)
<tr class="position-relative align-middle">
    {{-- Product --}}
    <td class="pl-xl-6 py-4 d-flex align-items-center">
        <div class="media align-items-center">
            <div class="ml-3 mr-4">
                @php
                    $primaryImage = $item->product->images->first();
                @endphp
                @if($primaryImage)
                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="mw-75px">
                @else
                    <img src="{{ asset('storage/default.jpg') }}" alt="Default Image" class="mw-75px">
                @endif
            </div>
            <div class="media-body mw-210">
                <p class="font-weight-500 text-secondary mb-2 lh-13">{{ $item->product->name }}</p>
                <p class="font-weight-500 mb-0">{{ $item->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </td>

    {{-- Price --}}
    <td class="text-center align-middle">
        <span class="font-weight-bold">{{ number_format($item->product->price, 2) }}</span>
    </td>

    {{-- Quantity --}}
    <td class="text-center align-middle">
        <div class="input-group input-group-sm justify-content-center" style="max-width: 120px;">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary btn-decrease" type="button" data-id="{{ $item->id }}">-</button>
            </div>
            <input type="text" class="form-control text-center quantity-input" value="{{ $item->quantity }}" data-id="{{ $item->id }}" readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-increase" type="button" data-id="{{ $item->id }}">+</button>
            </div>
        </div>
    </td>

    {{-- Total Price --}}
    <td class="text-center align-middle">
        <span class="font-weight-bold" id="total-{{ $item->id }}">{{ number_format($item->product->price * $item->quantity, 2) }}</span>
    </td>

    {{-- Actions --}}
    <td class="text-right pr-6 align-middle">
        <button class="btn btn-link text-danger p-0 btn-remove" type="button" data-id="{{ $item->id }}">
            <i class="fal fa-times"></i>
        </button>
    </td>
</tr>
@endforeach

{{-- Total Cart Price --}}
<div class="d-flex justify-content-end">
    <h5>Total: <span id="cart-total">{{ number_format($total, 2) }}</span></h5>
</div>


                        {{-- Buttons --}}
                        <tr>
                            <td colspan="5" class="d-flex justify-content-between bg-white p-4">
                                <a href="{{ url('/checkOut') }}" class="btn btn-outline-secondary border-2x border border-hover-secondary">
                                   Place Order
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
</main>

 
@endsection

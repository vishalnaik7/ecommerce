@extends('layouts.user')

@section('content')

<main id="content">
<section class="mx-0 slick-slider dots-inner-center custom-slider-02 slider"
            data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600}'>
            <div class="box px-0">
                <div class="slider-responsive bg-img-cover-center  py-lg-17"
                    style="background-image: url('images/banner/bg-slider-01.jpg');">
                    <div class="container container-xl pt-7 pb-9">
                        <div data-animate="fadeInDown">
                            <p class="text-white margin-bottom-5 font-weight-600 fs-24 lh-15">Find Inspration</p>
                            <h1 class="text-white font-weight-500 margin-bottom-10 fs-21  fs-md-68 lh-128">Scarlet Serie
                                <br>
                                Gold
                            </h1>
                        </div>
                        <a href=""
                            class="btn btn-link btn-light bg-transparent text-white border-bottom border-0 rounded-0 p-0 fs-16 font-weight-600 border-2x mobile-display"
                            data-animate="fadeInUp">
                            Discover Now
                            <svg class="icon icon-arrow-right">
                                <use xlink:href="#icon-arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="box px-0">
                <div class="slider-responsive bg-img-cover-center  py-lg-17"
                    style="background-image: url('images/banner/bg-slider-02.jpg');">
                    <div class="container container-xl pt-7 pb-9">
                        <div data-animate="fadeInDown">
                            <p class="text-white margin-bottom-5 font-weight-600 fs-24 lh-15">Shop Our Set</p>
                            <h1 class="text-white font-weight-500 margin-bottom-10 fs-21  fs-md-68 lh-128">
                                Magnificent<br>
                                Cz Diamond
                            </h1>
                        </div>
                        <a href=""
                            class="btn btn-link btn-light bg-transparent text-white border-bottom border-0 rounded-0 p-0 fs-16 font-weight-600 border-2x mobile-display"
                            data-animate="fadeInUp">
                            Discover Now
                            <svg class="icon icon-arrow-right">
                                <use xlink:href="#icon-arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="box px-0">
                <div class="slider-responsive bg-img-cover-center  py-lg-17"
                    style="background-image: url('images/banner/bg-slider-03.jpg');">
                    <div class="container container-xl pt-7 pb-9">
                        <div data-animate="fadeInDown">
                            <p class="text-white margin-bottom-5 font-weight-600 fs-24 lh-15">New Arrivals</p>
                            <h1 class="text-white font-weight-500 margin-bottom-10 fs-21  fs-md-68 lh-128">Majestic
                                Bloom <br>
                                Gemstone</h1>
                        </div>
                        <a href=""
                            class="btn btn-link btn-light bg-transparent text-white border-bottom border-0 rounded-0 p-0 fs-16 font-weight-600 border-2x mobile-display"
                            data-animate="fadeInUp">
                            Discover Now
                            <svg class="icon icon-arrow-right">
                                <use xlink:href="#icon-arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <section class="pt-lg-13 pb-lg-10 pt-11" style="background: #f8f8f8;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-6">Feature Products</h2>
                    <div class="row">

                        <!-- Product Listing -->
                        @foreach($products as $product)
                        <div class="col-lg-3 col-sm-6 mb-5">
                            <div class="card border-0 product">
                                <div class="position-relative">
                                    @if($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                        alt="Product Image" class="card-img-top">
                                    @else
                                    <img src="default-image.jpg" alt="No Image" class="card-img-top">
                                    @endif

                                    <div class="card-img-overlay d-flex p-3">
                                        <div class="ml-auto"> 
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left"
                                                  onclick="addToCart({{ $product->id }})"
                                                class="add-to-cart-button ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                                <svg class="icon icon-star-light fs-24">
                                                    <use xlink:href="#icon-star-light"></use>
                                                </svg>
                                            </a> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-center">
                                    <p class="card-text font-weight-bold fs-16 mb-1 text-secondary">
                                        ₹{{ number_format($product->price, 2) }}
                                    </p>
                                    <h5 class="card-title">
                                        <a href="#">{{ $product->name }}</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-11 pb-xl-9 pb-5" style="background-color: #d8e9e5" data-animated-id="4">
            <div class="container container-xl">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-transparent border-0 align-items-center text-center mb-xl-0 mb-6 fadeInUp animated"
                            data-animate="fadeInUp">
                            <div class="card-img">
                                <svg class="icon icon-box-01 fs-70 text-primary">
                                    <use xlink:href="#icon-box-01"></use>
                                </svg>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title fs-20 mb-2">Free Shipping</h3>
                                <p class="cart-text fs-18 mb-0">Free Shipping for orders over ₹1,30,00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-transparent border-0 align-items-center text-center mb-xl-0 mb-6 fadeInUp animated"
                            data-animate="fadeInUp">
                            <div class="card-img">
                                <svg class="icon icon-box-02 fs-70 text-primary">
                                    <use xlink:href="#icon-box-02"></use>
                                </svg>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title fs-20 mb-2">Returns</h3>
                                <p class="cart-text fs-18 mb-0">Within 5 days for an exchange.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-transparent border-0 align-items-center text-center mb-xl-0 mb-6 fadeInUp animated"
                            data-animate="fadeInUp">
                            <div class="card-img">
                                <svg class="icon icon-box-03 fs-70 text-primary">
                                    <use xlink:href="#icon-box-03"></use>
                                </svg>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title fs-20 mb-2">Online Support</h3>
                                <p class="cart-text fs-18 mb-0">24 hours a day, 7 days a week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-transparent border-0 align-items-center text-center mb-xl-0 mb-6 fadeInUp animated"
                            data-animate="fadeInUp">
                            <div class="card-img">
                                <svg class="icon icon-box-04 fs-70 text-primary">
                                    <use xlink:href="#icon-box-04"></use>
                                </svg>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title fs-20 mb-2">Flexible Payment</h3>
                                <p class="cart-text fs-18 mb-0">Pay with Multiple Credit Cards</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="quickViewProductName">Product Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="quickViewProductImages" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner"></div> <!-- Dynamic Images will go here -->
                            <a class="carousel-control-prev" href="#quickViewProductImages" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#quickViewProductImages" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 id="quickViewProductPrice">₹0</h4>
                        <p id="quickViewProductDescription">Product description will be here.</p>
                        <button class="btn btn-primary" id="addToCartButton">Add to Cart</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- jQuery + Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script>
function openQuickView(productId) {
    $.ajax({
        url: '/get-product-details/' + productId, // Route to fetch product data
        method: 'GET',
        success: function(response) {
            // Set Product Information
            document.getElementById('quickViewProductName').innerText = response.name || 'Product Name';
            document.getElementById('quickViewProductPrice').innerText = response.price ? '₹' + response
                .price : '₹0';
            document.getElementById('quickViewProductDescription').innerText = response.description ||
                'Product description will be here.';

            // Clear existing images
            document.querySelector('.carousel-inner').innerHTML = '';

            // Add each image dynamically to the carousel
            if (response.images && response.images.length > 0) {
                response.images.forEach(function(imgUrl, index) {
                    const isActive = index === 0 ? 'active' : '';
                    const carouselItem = `
                        <div class="carousel-item ${isActive}">
                            <img src="${imgUrl}" class="d-block w-100" alt="Product Image">
                        </div>
                    `;
                    document.querySelector('.carousel-inner').insertAdjacentHTML('beforeend',
                        carouselItem);
                });
            } else {
                // Add a default image if no images exist
                document.querySelector('.carousel-inner').insertAdjacentHTML('beforeend', `
                    <div class="carousel-item active">
                        <img src="default-image.jpg" class="d-block w-100" alt="No Image">
                    </div>
                `);
            }

            // Show the modal
            $('#quickViewModal').modal('show');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Failed to load product details.');
        }
    });
}
// function addToCart(productId) {
//     $.ajax({
//         url: '/add-to-cart/' + productId,
//         method: 'POST',
//         data: {
//             _token: '{{ csrf_token() }}'
//         },
//         success: function(response) {
//             alert('Product added to cart successfully!');
//             console.log(response);
//         },
//         error: function(xhr) {
//             console.error(xhr.responseText);
//             alert('Failed to add product to cart.');
//         }
//     });
// } 
function addToCart(productId) {
    $.ajax({
        url: '/add-to-cart/' + productId,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                Toastify({
                    text: response.message, // "Product added to cart"
                    duration: 3000,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "#28a745", // Green color
                }).showToast();
            } else {
                Toastify({
                    text: "Something went wrong!",
                    duration: 3000,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "#dc3545", // Red color
                }).showToast();
            }
        },
        error: function(xhr) {
            Toastify({
                text: "Failed to add product to cart!",
                duration: 3000,
                gravity: "top", 
                position: "right", 
                backgroundColor: "#dc3545", // Red color
            }).showToast();
        }
    });
}
function loadCart() {
    $.ajax({
        url: '/cart/list',
        method: 'GET',
        success: function(response) {
            let cartCanvas = $('.cart-canvas .card-body');
            cartCanvas.empty(); // Clear old cart
            
            if(response.cart.length > 0) {
                response.cart.forEach(function(item) {
                    cartCanvas.append(`
                        <div class="mb-4 d-flex">
                            <a href="javascript:void(0)" class="d-flex align-items-center mr-2 text-muted remove-cart-item" data-id="${item.id}">
                                <i class="fal fa-times"></i>
                            </a>
                            <div class="media w-100">
                                <div class="w-60px mr-3">
                                    <img src="/storage/${item.image}" alt="${item.name}">
                                </div>
                                <div class="media-body d-flex">
                                    <div class="cart-price pr-6">
                                        <p class="fs-14 font-weight-bold text-secondary mb-1">
                                            ₹${item.price}
                                        </p>
                                        <a href="javascript:void(0)" class="text-secondary">${item.name}</a>
                                    </div>
                                    <div class="position-relative ml-auto">
                                        <div class="input-group">
                                            <input type="number"
                                                class="number-cart w-90px px-6 text-center h-40px bg-input border-0" 
                                                value="${item.quantity}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
            } else {
                cartCanvas.append(`<p class="text-center">Your cart is empty!</p>`);
            }

            // Update cart counter
            $('.menu-cart .number').text(response.cart.length);
        }
    });
}

// Add to Cart Button
$('#addToCartButton').on('click', function() {
    const productId = $('#quickViewProductName').text();
    console.log('Adding to cart: ' + productId);

    // Perform actions to add the product to the cart, e.g., an AJAX request to add the item to the cart.
    // You can update this as per your cart handling logic.

    alert('Product added to cart!');
});
</script>

@endsection
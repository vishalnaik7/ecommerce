@extends('layouts.user')
@section('content')
<main id="content">
    <section class="py-2 bg-gray-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-body" href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Check Out</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pb-lg-13 pb-11">
        <div class="container">
            <h2 class="text-center my-9">Check Out</h2>
            <form>
                <div class="row">
                    <div class="col-lg-4 pb-lg-0 pb-11 order-lg-last">
                        <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                            <div class="card-body px-6 pt-5">
                                <!-- Address Section -->
                                <div class="mb-4">
                                    <h5 class="font-weight-bold text-dark mb-2">Shipping Address</h5>
                                    <p class="mb-1">Vishal Naik</p>
                                    <p class="mb-1">Test Colont, Bhandup</p>
                                    <p class="mb-1">Mumbai 400078</p>
                                    <p class="mb-1">Mobile: 9821948908</p>
                                    <p class="mb-0">Email: vishal75naik@gmail.com</p>
                                </div>
                            </div>

                            <!-- Total Section -->


                        </div>
                    </div>
                    <div class="col-lg-8 pr-xl-15 order-lg-first form-control-01">
                        <div class="card collapse mw-460 border-0" id="collapsecoupon">
                            <div class="card-body pt-6 px-5 pb-7 my-6 border">
                                <p class="card-text text-secondary mb-5">If you have a coupon code, please apply it
                                    below.</p>
                                <div class="input-group">
                                    <input type="email" name="coupon_code" class="form-control border-0"
                                        placeholder="Your Email*">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary px-3 border-0" type="submit"
                                            name="apply_coupon" value="Apply coupon">Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="fs-24 pt-1 mb-4">Shipping Infomation</h4>
                        <div class="mb-3">
                            <label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Name</label>
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <input type="text" class="form-control border-0" id="first-name" name="firstname"
                                        value="Vishal" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control border-0" id="last-name" name="lastname"
                                        value="Naik" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-8 mb-md-0 mb-4">
                                    <label for="street-address"
                                        class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                        Street Address
                                    </label>
                                    <input type="text" class="form-control border-0" id="street-address"
                                        name="streetaddress" value="Test Colont, Bhandup" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="apt"
                                        class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                        APT/Suite
                                    </label>
                                    <input type="text" class="form-control border-0" id="apt" name="apt" value="-"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4 mb-md-0 mb-4">
                                    <label for="city"
                                        class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">City</label>
                                    <input type="text" class="form-control border-0" id="city" name="city"
                                        value="Mumbai" readonly>
                                </div>
                                <div class="col-md-4 mb-md-0 mb-4">
                                    <label for="state"
                                        class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">State</label>
                                    <input type="text" class="form-control border-0" id="state" name="state"
                                        value="Maharashtra" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="zip"
                                        class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">ZIP
                                        Code</label>
                                    <input type="text" class="form-control border-0" id="zip" name="zip" value="400078"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Country</label>
                            <input type="text" class="form-control border-0" id="country" name="country" value="India"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Info</label>
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <input type="email" class="form-control border-0" id="email" name="email"
                                        value="vishal75naik@gmail.com" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control border-0" id="phone" name="phone"
                                        value="9821948908" readonly>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="place-order-btn"
                            class="btn btn-secondary bg-hover-primary border-hover-primary px-7 mt-6">
                            Place Order
                        </button> 
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<script>
    document.getElementById('place-order-btn').addEventListener('click', function () { 
    var totalAmount = {{ isset($total) ? $total * 100 : 0 }};// in paise 
    fetch("{{ url('/create-order') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ amount: totalAmount })
    })
    .then(res => res.json())
    .then(orderData => {
        var options = {
            key: "rzp_test_UV6vUdz1hzFGmw",
            amount: totalAmount,
            currency: "INR",
            name: "Your Store",
            description: "Order Payment",
            image: "https://yourdomain.com/logo.png",
            order_id: orderData.order_id, // ✅ Razorpay order_id here
            handler: function (response) {
                // ✅ Send payment details to backend
                fetch("{{ url('/payment-success') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        cartItems: @json($cartItems),
                        total: {{ $total }}
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') { 
                        window.location.href = "{{ url('/order-success') }}";
                    } else {
                        alert('Payment Captured but Order Failed. Contact Support.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong!');
                });
            },
            prefill: {
                name: "Customer Name",
                email: "customer@example.com",
                contact: "9999999999"
            },
            theme: {
                color: "#0d6efd"
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    });
});
</script>
@endsection
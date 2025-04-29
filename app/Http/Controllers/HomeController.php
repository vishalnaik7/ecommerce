<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    { 
        $products = Product::with('images')->get();
        return view('home', compact('products'));
    } 
     public function getProductDetails($id)
     {
         // Fetch product with images
         $product = Product::with('images')->findOrFail($id);
 
         return response()->json([
             'name' => $product->name,
             'price' => '₹' . number_format($product->price, 2),
             'description' => $product->description,
             'images' => $product->images->map(function ($image) {
                 return asset('storage/' . $image->image_path);  // Assuming 'image_path' contains the image file name
             })
         ]);
     }
     public function add($id)
     {
         $product = Product::findOrFail($id);
     
         $userId =1; // Or NULL if not using user login
     
         // 1. Check if cart already has the product
         $cartItem = Cart::where('user_id', $userId)
                         ->where('product_id', $id)
                         ->first();
     
         if ($cartItem) {
             // 2. Already in cart → Just increase quantity
             $cartItem->quantity += 1;
             $cartItem->save();
         } else {
             // 3. Not in cart → Create new cart entry
             Cart::create([
                 'user_id' => $userId,
                 'product_id' => $product->id,
                 'quantity' => 1
             ]);
         }
     
         return response()->json(['success' => true, 'message' => 'Product added to cart']);
     } 
     public function list()
     {
         $cartItems = Cart::with('product')
             ->where('user_id', 1)
             ->get();
 
         return response()->json([
             'success' => true,
             'cart' => $cartItems
         ]);
     }
     public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::where('id', $request->cart_id)
            ->where('user_id', 1)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cart item not found.'
        ]);
    }
    public function cartPage()
{  
    $cartItems = Cart::with('product.images')->where('user_id', 1)->get(); 
    $total = $cartItems->sum(function ($cart) {
        return $cart->product->price * $cart->quantity;
    }); 
    return view('cart', compact('cartItems', 'total'));
}

public function checkOut()
{
    $cartItems = Cart::with('product.images')->where('user_id', 1)->get();
    $total = $cartItems->sum(function ($cart) {
        return $cart->product->price * $cart->quantity;
    });

    return view('checkOut', compact('cartItems', 'total'));
}

// In CartController.php

public function updateQuantity(Request $request)
{
    $cart = Cart::findOrFail($request->cart_id);
    $cart->quantity = $request->quantity;
    $cart->save();

    // Calculate the total price for this product
    $totalPrice = $cart->product->price * $cart->quantity;

    // Calculate the overall cart total
    $cartItems = Cart::with('product')->where('user_id', 1)->get();
    $cartTotal = $cartItems->sum(function ($cartItem) {
        return $cartItem->product->price * $cartItem->quantity;
    });

    return response()->json([
        'success' => true,
        'total_price' => $totalPrice,
        'cart_total' => $cartTotal
    ]);
}  

public function paymentSuccess(Request $request)
{
    $paymentId = $request->razorpay_payment_id;
    $orderId = $request->razorpay_order_id;
    $signature = $request->razorpay_signature;
    $cartItems = $request->cartItems;
    $total = $request->total;

    try {
        // ✅ Verify Razorpay Signature
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature
        ]);

        // ✅ Generate 6-Digit Random Order ID
        $orderNumber = strtoupper(Str::random(6));

        // ✅ Create Order
        $order = new Order();
        $order->user_id = 1; // You can replace with auth()->id()
        $order->order_number = $orderNumber;  // Saving the generated order number
        $order->razorpay_payment_id = $paymentId;
        $order->razorpay_order_id = $orderId;
        $order->razorpay_signature = $signature;
        $order->total_amount = $total;
        $order->save();

        // ✅ Add Order Items
        if (!is_array($cartItems)) {
            throw new \Exception('Invalid cartItems format. Expected array.');
        }

        foreach ($cartItems as $item) {
            if (
                !isset($item['product_id'], $item['quantity'], $item['product']['price'])
            ) {
                Log::warning('Skipping item due to missing data:', ['item' => $item]);
                continue;
            }

            // Save the order item with the same order_number (order_id in order_items)
            OrderItem::create([
                'order_id'   => $orderNumber,  // Saving the same order number as order_id in order_items
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['product']['price'],
            ]);
        }

        // ✅ Clear Cart
        Cart::where('user_id', 1)->delete();

        // Store the order_number in the session
        $request->session()->put('order_number', $orderNumber);

        return response()->json([
            'status' => 'success',
            'order_id' => $orderNumber
        ]);

    } catch (\Exception $e) {
        Log::error('Order Processing Failed', [
            'message' => $e->getMessage(),
            'request' => $request->all()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Payment Captured but Order Failed. Contact Support.',
        ], 500);
    }
}

public function createRazorpayOrder(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $orderData = [
        'receipt'         => Str::random(10),
        'amount'          => $request->amount, // amount in paise
        'currency'        => 'INR',
        'payment_capture' => 1,
    ];

    $razorpayOrder = $api->order->create($orderData);

    return response()->json([
        'order_id' => $razorpayOrder['id'],
    ]);
}


 // In your OrderController.php

 public function allOrders()
{
    // Fetch the order items with the related product and product images
    $orderItems = OrderItem::with(['product.firstImage'])
        ->whereHas('product') // optional: ensure product exists
        ->latest()
        ->get();

    // Group items by order_id
    $groupedOrderItems = $orderItems->groupBy('order_id');

    return view('Order', compact('groupedOrderItems'));
}

 

public function orderSuccess(Request $request)
{
    // Get the order number from the session
    $orderNumber = $request->session()->get('order_number');

    // Check if order number exists in session
    if (!$orderNumber) {
        return redirect('/')->with('error', 'Order not found.');
    }

    // Find the order using the order number
    $order = Order::where('order_number', $orderNumber)->first();

    // If order is not found, show error message
    if (!$order) {
        return redirect('/')->with('error', 'Order not found.');
    }

    // Pass the order details to the view
    return view('orderSuccess', ['order' => $order]);
}


}
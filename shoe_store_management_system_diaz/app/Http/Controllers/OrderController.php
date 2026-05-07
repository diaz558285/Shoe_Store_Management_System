<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\ShoeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::with(['user', 'shoeProduct'])->get();
        return view('orders.index', compact('orders'));
    }

    // Show the Create Order form
    public function create()
    {
        $shoes = ShoeProduct::all();
        return view('orders.create', compact('shoes'));
    }

    // Save the order
    public function store(Request $request)
    {
        $request->validate([
            'shoe_product_id' => 'required',
            'quantity'        => 'required|numeric|min:1',
        ]);

        $shoe = ShoeProduct::findOrFail($request->shoe_product_id);

        // Formula: Total Cost = Quantity × Price
        $totalCost = $request->quantity * $shoe->price;

        Order::create([
            'user_id'         => Auth::id(),
            'shoe_product_id' => $request->shoe_product_id,
            'quantity'        => $request->quantity,
            'total_amount'      => $totalCost,
            'status'          => 'Pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created!');
    }

    // Update order status
    public function update(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Order updated!');
    }
}
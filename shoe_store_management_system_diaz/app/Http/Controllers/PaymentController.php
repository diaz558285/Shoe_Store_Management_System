<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show all payments
    public function index()
    {
        $payments = Payment::with('order.user')->get();
        return view('payments.index', compact('payments'));
    }

    // Show the Pay form for an order
    public function create(Request $request)
    {
        $orders = Order::with('shoeProduct')->get();
        return view('payments.create', compact('orders'));
    }

    // Process payment
    public function store(Request $request)
    {
        $request->validate([
            'order_id'    => 'required',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($request->order_id);
        $balance = $order->total_amount - $request->amount_paid;

        // Determine payment status
        if ($request->amount_paid <= 0) {
            $status = 'Unpaid';
        } elseif ($balance > 0) {
            $status = 'Partial';
        } else {
            $status = 'Paid';
            $balance = 0;
        }

        Payment::create([
            'order_id'    => $request->order_id,
            'amount_paid' => $request->amount_paid,
            'balance'     => $balance,
            'status'      => $status,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment recorded!');
    }
}
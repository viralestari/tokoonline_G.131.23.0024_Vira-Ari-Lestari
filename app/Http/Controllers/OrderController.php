<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error','Keranjang Anda kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('order.checkout', compact('cart','total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'notes'            => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error','Keranjang Anda kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();

        try {

            // CREATE ORDER
            $order = Order::create([
                'order_number'   => Order::generateOrderNumber(),
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total'          => $total,
                'status'         => 'pending',
                'notes'          => $request->notes,
            ]);

            // CREATE ORDER ITEMS
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'], // ✅ sync dgn cart
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                    'subtotal'   => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('order.success', $order->id)
                ->with('success','Pesanan berhasil dibuat!');

        } catch (\Throwable $e) {

            DB::rollBack();
            \Log::error($e);

            return redirect()->back()
                ->with('error','Terjadi kesalahan saat memproses pesanan.')
                ->withInput();
        }
    }

    public function success($id)
    {
        // ✅ FIX TYPO DI SINI
        $order = Order::with('orderItems.product')
                        ->findOrFail($id);

        return view('order.success', compact('order'));
    }
}

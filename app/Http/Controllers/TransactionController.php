<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showOrder($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        $hasBought = Transaction::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'success')
            ->exists();

        if ($hasBought) {
            return redirect()->route('dashboard')->with('error', 'Kamu sudah membeli kelas ini.');
        }

        return view('order.index', compact('course'));
    }

    public function checkout(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $orderId = 'ORDER-' . uniqid() . '-' . time();
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'course_price' => $course->price,
            'amount' => $course->price,
            'status' => 'completed',
            'payment_url' => null,
            'midtrans_order_id' => $orderId,
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $midtransParams = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $course->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => $course->id,
                    'price' => $course->price,
                    'quantity' => 1,
                    'name' => $course->name,
                ]
            ],
        ];

        $snapToken = Snap::getSnapToken($midtransParams);

        return view('order.payment', compact('snapToken', 'course'));
    }
}
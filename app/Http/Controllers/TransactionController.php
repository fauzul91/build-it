<?php

namespace App\Http\Controllers;

use Auth;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function studentTransaction()
    {
        $user = Auth::user();
        $studentTrx = Transaction::where('user_id', $user->id)->get();

        return view('student.transaction.index', compact('studentTrx'));
    }
    public function studentDetail($id)
    {
        $user = Auth::user();
        $studentTrx = Transaction::where('id', $id)
            ->where('user_id', $user->id)
            ->with('course')
            ->firstOrFail();

        return view('student.transaction.show', compact('studentTrx'));
    }
    public function adminTransaction()
    {
        $transactions = Transaction::with(['course', 'user'])
            ->latest()
            ->paginate(5);

        return view('transaction.admin.index', compact('transactions'));
    }
    public function tutorTransaction()
    {
        $tutorId = Auth::id();

        $transactions = Transaction::with(['course', 'user'])
            ->whereHas('course', function ($query) use ($tutorId) {
                $query->where('tutor_id', $tutorId);
            })
            ->latest()
            ->paginate(5);

        return view('transaction.tutor.index', compact('transactions'));
    }
    public function tutorTransactionShow($id)
    {
        $tutorId = Auth::id();

        $tutorTrx = Transaction::with('course')
            ->where('id', $id)
            ->whereHas('course', function ($query) use ($tutorId) {
                $query->where('tutor_id', $tutorId);
            })
            ->firstOrFail();

        return view('transaction.tutor.show', compact('tutorTrx'));
    }
    public function adminTransactionShow($id)
    {
        $user = Auth::user();
        $adminTrx = Transaction::where('id', $id)
            ->with('course')
            ->firstOrFail();

        return view('transaction.admin.show', compact('adminTrx'));
    }
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
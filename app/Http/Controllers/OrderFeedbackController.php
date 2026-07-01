<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderFeedback;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderFeedbackController extends Controller
{
    public function create(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        if ($order->status !== 'delivered') {
            abort(403, 'Feedback is only available for delivered orders.');
        }

        if ($order->feedback) {
            return redirect()->route('orders.show', $order)
                ->with('info', 'You have already submitted feedback for this order.');
        }

        return Inertia::render('Orders/Feedback', [
            'order' => $order->only(['id', 'title']),
        ]);
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        if ($order->status !== 'delivered') {
            abort(403, 'Feedback is only available for delivered orders.');
        }

        if ($order->feedback) {
            return redirect()->route('orders.show', $order)
                ->with('info', 'You have already submitted feedback for this order.');
        }

        $validated = $request->validate([
            'did_well' => 'required|string|max:2000',
            'improve' => 'required|string|max:2000',
            'would_refer' => 'required|in:yes,maybe,no',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $order->feedback()->create($validated);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Thank you for your feedback!');
    }

    private function authorizeOrder(Request $request, Order $order): void
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }
    }
}

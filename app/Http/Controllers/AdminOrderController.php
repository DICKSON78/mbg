<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $query = Purchase::with('book')->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $purchases = $query->paginate(15)->withQueryString();
        return view('admin.orders.index', compact('purchases', 'status'));
    }

    public function show(Purchase $purchase)
    {
        $purchase->load('book');
        return view('admin.orders.show', compact('purchase'));
    }

    public function updateStatus(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled',
            'notes'  => 'nullable|string|max:1000',
        ]);

        $updateData = ['status' => $validated['status']];

        if (!empty($validated['notes'])) {
            $updateData['buyer_notes'] = $validated['notes'];
        }

        $purchase->update($updateData);

        if ($purchase->user_id) {
            Notification::createForUser(
                $purchase->user_id,
                'order_status',
                'Pre-order Update: ' . $purchase->book->title,
                "Your pre-order status has been updated to: {$validated['status']}.",
                route('profile')
            );
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'status' => $validated['status']]);
        }

        return back()->with('success', 'Pre-order status updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('admin.orders')->with('success', 'Pre-order deleted.');
    }
}

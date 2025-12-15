<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
            'car_id' => 'required|exists:cars,id',
            'total_price' => 'required|numeric'
        ]);

        $code = $request->voucher_code;
        $carId = $request->car_id;
        $totalPrice = $request->total_price;

        $voucher = Voucher::where('code', $code)->first();
        $car = \App\Models\Car::find($carId);

        if (!$voucher) {
            return response()->json(['valid' => false, 'message' => 'Invalid voucher code.'], 200);
        }

        if (!$voucher->is_active) {
            return response()->json(['valid' => false, 'message' => 'Voucher is not active.'], 200);
        }

        $now = Carbon::now();
        // Since valid_until or end_date might be used, assuming start_date/end_date based on previous inspection
        if ($now->lt($voucher->start_date) || $now->gt($voucher->end_date)) {
             return response()->json(['valid' => false, 'message' => 'Voucher is expired or not yet valid.'], 200);
        }

        if ($voucher->quota > 0 && $voucher->used_count >= $voucher->quota) {
            return response()->json(['valid' => false, 'message' => 'Voucher quota exceeded.'], 200);
        }

        if ($totalPrice < $voucher->minimum_spend) {
            return response()->json(['valid' => false, 'message' => 'Minimum spend not met.'], 200);
        }

        if ($voucher->brand && strtolower($voucher->brand) !== strtolower($car->brand)) {
            return response()->json(['valid' => false, 'message' => 'Voucher not valid for this car brand.'], 200);
        }

        // Calculate discount
        $discountString = '';
        if (trim(strtolower($voucher->type)) === 'percent') {
            $discountAmount = $totalPrice * ($voucher->value / 100);
            $discountString = $voucher->value . '%';
        } else {
            $discountAmount = $voucher->value;
             $discountString = 'Rp ' . number_format($voucher->value, 0, ',', '.');
        }

        // Cap discount at total price
        $discountAmount = min($discountAmount, $totalPrice);

        return response()->json([
            'valid' => true,
            'message' => 'Voucher applied! Discount: ' . $discountString,
            'discount_amount' => $discountAmount,
            'code' => $voucher->code
        ]);
    }
}

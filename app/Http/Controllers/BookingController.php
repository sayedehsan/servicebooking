<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Json;

class BookingController extends Controller
{
    public function index() : JsonResponse{
        $user = Auth::user();

        if ($user->user_type == 'user') {
            $bookinglist = Booking::where('user_id', $user->id)->get()->map(function ($booking) {
                $booking->status = ucfirst($booking->status);
                $booking->payment_status = ucfirst($booking->payment_status);
                return $booking;
            });
        }

        $bookinglist = Booking::all()->map(function ($booking) {
            $booking->status = ucfirst($booking->status);
            $booking->payment_status = ucfirst($booking->payment_status);
            return $booking;
        });
        return response()->json([
            'code' => 200,
            'message' => 'Service created successfully.',
            'data' => $bookinglist,
        ], 200);
    }

    
    public function create(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:5',
            'notes' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $booking = Booking::create($validator->validated());
        return response()->json([
            'code' => 200,
            'message' => 'Booking created successfully.',
            'data' => $booking,
        ], 200);

    }

    public function update(Request $request, Booking $booking) : JsonResponse
    {
          $user = Auth::user(); 
        if ($user->user_type != 'admin') {
            return response()->json([
                'code' => 403,
                'message' => 'You do not have permission to update this booking.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'booking_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'sometimes|required|in:unpaid,paid,refunded',
            'amount' => 'sometimes|required|numeric|min:0',
            'currency' => 'sometimes|required|string|max:5',
            'notes' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $booking->update($validator->validated());
        return response()->json([
            'code' => 200,
            'message' => 'Booking updated successfully.',
            'data' => $booking,
        ], 200);
    }
}

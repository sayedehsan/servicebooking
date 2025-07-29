<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() : JsonResponse
    {
        $serviceLists = Service::all()->map(function ($service) {
            $service->status = ucfirst($service->status);
            return $service;
        });
        return response()->json([
                    'code'  => 200,
                    'message' => 'Service is running successfully.',
                    'data' => $serviceLists,
                ], 200);
    }

    public function create(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:5',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $service = Service::create($validator->validated());

        return response()->json([
            'code' => 200,
            'message' => 'Service created successfully.',
            'data' => $service,
        ], 200);
    }

    public function update(Request $request, Service $service) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'currency' => 'sometimes|required|string|max:5',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $service->update($validator->validated());

        return response()->json([
            'code' => 200,
            'message' => 'Service updated successfully.',
            'data' => $service,
        ], 200);
    }

    public function delete(Service $service) : JsonResponse
    {
        $service->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Service deleted successfully.',
        ], 200);
    }
}

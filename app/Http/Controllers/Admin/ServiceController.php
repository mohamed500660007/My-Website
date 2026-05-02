<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(): View|JsonResponse
    {
        $services = Service::orderBy('order_index')->latest()->get();

        if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.services.partials.service_list', compact('services'))->render(),
            ]);
        }
        
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'required|string|max:100',
                'status' => 'required|in:active,inactive',
                'order_index' => 'nullable|integer',
            ]);

            DB::transaction(function () use ($validated) {
                if (empty($validated['order_index'])) {
                    $validated['order_index'] = Service::max('order_index') + 1;
                }
                Service::create($validated);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الخدمة بنجاح!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(int $id): View
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'required|string|max:100',
                'status' => 'required|in:active,inactive',
                'order_index' => 'nullable|integer',
            ]);

            DB::transaction(function () use ($service, $validated) {
                $service->update($validated);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الخدمة بنجاح!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            DB::transaction(function () use ($id) {
                $service = Service::findOrFail($id);
                $service->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الخدمة بنجاح!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        try {
            $service = Service::findOrFail($id);
            $status = $request->input('status');

            if (!in_array($status, ['active', 'inactive'])) {
                throw new \Exception('حالة غير صالحة');
            }

            $service->status = $status;
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة الخدمة بنجاح!',
                'status' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

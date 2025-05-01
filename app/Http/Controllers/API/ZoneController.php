<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneRequest;
use App\Models\zone;
use App\Services\ZoneService;
use Illuminate\Http\JsonResponse;

class ZoneController extends Controller
{
    protected ZoneService $zoneService;

    public function __construct(ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }

    public function index(): JsonResponse
    {
        $zones = $this->zoneService->getAllZones();

        return response()->json([
            'success' => true,
            'data' => $zones
        ]);
    }

    public function store(ZoneRequest $request): JsonResponse
    {
        $zone = $this->zoneService->storeZone($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Zone created successfully',
            'data' => $zone
        ], 201);
    }


    public function show(Zone $zone): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $zone
        ]);
    }


    public function update(ZoneRequest $request, Zone $zone): JsonResponse
    {
        $updatedZone = $this->zoneService->updateZone($zone, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Zone updated successfully',
            'data' => $updatedZone
        ]);
    }

    public function destroy(Zone $zone): JsonResponse
    {
        $this->zoneService->deleteZone($zone);

        return response()->json([
            'success' => true,
            'message' => 'Zone deleted successfully'
        ]);
    }

    public function startWatering(Zone $zone): JsonResponse
    {
        $result = $this->zoneService->startWatering($zone);

        return response()->json([
            'success' => $result['status'],
            'message' => $result['message']
        ], $result['status'] ? 200 : 400);
    }

    public function stopWatering(Zone $zone): JsonResponse
    {
        $result = $this->zoneService->stopWatering($zone);

        return response()->json([
            'success' => $result['status'],
            'message' => $result['message']
        ], $result['status'] ? 200 : 400);
    }

    public function wateringStatus(Zone $zone): JsonResponse
    {
        $status = $this->zoneService->getWateringStatus($zone);

        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }
}

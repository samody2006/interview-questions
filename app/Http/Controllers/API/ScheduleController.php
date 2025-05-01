<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\zone;
use App\Services\ScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected ScheduleService $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Fetch all schedules for a zone
     * @param zone $zone
     * @return JsonResponse
     */
    public function index(Zone $zone): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->scheduleService->listSchedules($zone)
        ]);
    }

    /**
     * Create a schedule for a zone
     * @param ScheduleRequest $request
     * @param zone $zone
     * @return JsonResponse
     */
    public function store(ScheduleRequest $request, Zone $zone): JsonResponse
    {
        $schedule = $this->scheduleService->createSchedule($zone, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Schedule created successfully',
            'data' => $schedule
        ], 201);
    }

    /**
     * Fetch a schedule for a zone
     * @param zone $zone
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function show(Zone $zone, Schedule $schedule): JsonResponse
    {
        $found = $this->scheduleService->getSchedule($zone, $schedule);

        if (! $found) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found for this zone'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $found
        ]);
    }

    /**
     * Update a schedule for a zone
     * @param ScheduleRequest $request
     * @param zone $zone
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function update(ScheduleRequest $request, Zone $zone, Schedule $schedule): JsonResponse
    {
        $updated = $this->scheduleService->updateSchedule($zone, $schedule, $request->validated());

        if (! $updated) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found for this zone'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedule updated successfully',
            'data' => $updated
        ]);
    }

    /**
     * Delete a schedule for a zone
     * @param zone $zone
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function destroy(Zone $zone, Schedule $schedule): JsonResponse
    {
        $deleted = $this->scheduleService->deleteSchedule($zone, $schedule);

        if (! $deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule not found for this zone'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedule deleted successfully'
        ]);
    }

}

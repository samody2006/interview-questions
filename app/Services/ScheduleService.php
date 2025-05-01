<?php

namespace App\Services;

use App\Jobs\SendScheduleNotificationEmail;
use App\Models\Schedule;
use App\Models\zone;
use Illuminate\Database\Eloquent\Model;

class ScheduleService
{
    public function listSchedules(Zone $zone)
    {
        return $zone->schedules;
    }

    public function createSchedule(Zone $zone, array $data): Model
    {
        $schedule = $zone->schedules()->create($data);
        SendScheduleNotificationEmail::dispatch($schedule, 'created');
        return $schedule;
    }

    public function getSchedule(Zone $zone, Schedule $schedule): ?Schedule
    {
        return $schedule->zone_id === $zone->id ? $schedule : null;
    }

    public function updateSchedule(Zone $zone, Schedule $schedule, array $data): ?Schedule
    {
        if ($schedule->zone_id !== $zone->id) {
            return null;
        }

        $schedule->update($data);
        SendScheduleNotificationEmail::dispatch($schedule, 'updated');
        return $schedule;
    }

    public function deleteSchedule(Zone $zone, Schedule $schedule): bool
    {
        if ($schedule->zone_id !== $zone->id) {
            return false;
        }

        $schedule->delete();
        return true;
    }

}

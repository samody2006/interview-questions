<?php

namespace App\Services;

use App\Models\zone;
use Illuminate\Database\Eloquent\Collection;

class ZoneService
{

    public function getAllZones(): Collection|array
    {
        return Zone::all();
    }

    public function storeZone(array $data): Zone
    {
        return Zone::create($data);
    }

    public function updateZone(Zone $zone, array $data): Zone
    {
        $zone->update($data);
        return $zone;
    }

    public function deleteZone(Zone $zone): void
    {
        $zone->delete();
    }

    public function startWatering(Zone $zone): array
    {
        if ($zone->is_watering) {
            return ['status' => false, 'message' => 'Zone is already being watered'];
        }

        $zone->update(['is_watering' => true]);
        $zone->watering()->create(['start_time' => now()]);

        return ['status' => true, 'message' => 'Watering started successfully'];
    }

    public function stopWatering(Zone $zone): array
    {
        if (! $zone->is_watering) {
            return ['status' => false, 'message' => 'Zone is not being watered'];
        }

        $zone->update(['is_watering' => false]);

        $zone->watering()
            ->whereNull('end_time')
            ->latest()
            ->first()
            ?->update(['end_time' => now()]);

        return ['status' => true, 'message' => 'Watering stopped successfully'];
    }

    public function getWateringStatus(Zone $zone): array
    {
        return [
            'zone_id' => $zone->id,
            'name' => $zone->name,
            'is_watering' => (bool) $zone->is_watering
        ];
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watering extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id', 'start_time', 'end_time'];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

}

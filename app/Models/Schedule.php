<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id', 'start_time', 'duration', 'days_of_week'];

    protected $casts = [
        'days_of_week' => 'array'
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

}

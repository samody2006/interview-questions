<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class zone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'area', 'is_watering'];

    protected $casts = [
        'is_watering' => 'boolean'
    ];
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function watering(): HasMany
    {
        return $this->hasMany(Watering::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Collection extends Model
{
    protected $fillable = [
        'id_company',
        'day_start',
        'day_end',
        'location',
        'hour_start',
        'hour_end',
        'nb_employee',
        'nb_registered',
        'nb_blood_pouch',
        'onedoc_link',
    ];

    protected $casts = [
        'day_start' => 'datetime',
        'day_end'   => 'datetime',
    ];

    // Une collecte appartient à une company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::creating(function ($collection) {
            $collection->day_start = Carbon::parse($collection->day_start)->startOfDay();
            $collection->day_end   = Carbon::parse($collection->day_end)->endOfDay();
        });
    }
}

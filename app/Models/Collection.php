<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Collection extends Model
{
    protected $fillable = [
        'id_company',
        'start',
        'end',
        'location',
        'time_start',
        'time_end',
        'nb_employee',
        'nb_registered',
        'nb_blood_pouch',
        'onedoc_link',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    // Une collecte appartient à une company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::creating(function ($collection) {
            $collection->start = Carbon::parse($collection->start)->startOfDay();
            $collection->end   = Carbon::parse($collection->end)->endOfDay();
        });
    }
}

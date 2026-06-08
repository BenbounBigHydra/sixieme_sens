<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

// Modèle Entreprise
class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'color',
        'sector',
        'employee_count',
        'contact_name',
        'contact_phone',
        'contact_email',
        'is_labelled',
        'trophies_count',
    ];

    // Une company a plusieurs collectes
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    protected static function booted()
    {
        static::creating(function ($company) {
            $company->slug = Str::slug($company->name);
        });

        static::updating(function ($company) {
            if ($company->isDirty('name')) {
                $company->slug = Str::slug($company->name);
            }
        });
    }
}

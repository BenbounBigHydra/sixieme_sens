<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Modèle Entreprise
class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color',
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
}
}

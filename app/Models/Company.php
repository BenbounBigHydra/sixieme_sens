<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Modèle Entreprise
class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color',
    ];

    // Lien vers les collections
    public function collections()
    {
        return $this->hasMany(Collection::class, 'id_company');
    }
}

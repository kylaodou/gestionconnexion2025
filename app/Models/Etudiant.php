<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $primaryKey = 'INE';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'INE',
        'filiere',
        'annee_scolaire',
    ];
    public function appareils()
    {
        return $this->hasMany(Appareil::class, 'id_etudiant');
    }
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'INE');
    }
}

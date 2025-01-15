<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_personnel';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_personnel',
        'direction',
        'poste',
    ];
    public function appareils()
    {
        return $this->hasMany(Appareil::class, 'id_personnel');
    }
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personnel');
    }
}

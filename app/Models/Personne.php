<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_personne';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_personne',
        'nom',
        'prenom',
    ];
    public function personnel()
    {
        return $this->hasOne(Personnel::class, 'id_personnel');
    }
    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'INE');
    }
}

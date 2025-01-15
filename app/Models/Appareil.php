<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appareil extends Model
{
    use HasFactory;
    protected $primaryKey = 'adresse_mac';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'adresse_mac',
        'type_appareil', // Ajout du champ nom
        'marque',
        'id_etudiant',
        'id_personnel',
        'id_connexion',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function connexion()
    {
        return $this->belongsTo(Connexion::class, 'id_connexion');
    }
}

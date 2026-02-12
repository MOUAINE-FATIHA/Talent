<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobOffer extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'type_contrat',
        'entreprise',
        'image',
        'recruteur_id',
        'closed',
    ];

    protected $casts = [
        'closed' => 'boolean',
    ];

    public function recruteur(){
        return $this->belongsTo(Recruteur::class);
    }
    public function applications(){
        return $this->hasMany(Application::class);
    }
}
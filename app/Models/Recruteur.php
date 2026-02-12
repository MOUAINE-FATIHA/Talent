<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruteur extends Model{
    protected $fillable = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function jobOffers(){
        return $this->hasMany(JobOffer::class, 'recruteur_id');
    }
}

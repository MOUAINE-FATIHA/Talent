<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cv extends Model
{
    protected $fillable = ['user_id', 'title'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function formations(){
        return $this->hasMany(Formation::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class, 'cv_id');
    }

    public function competences(){
        return $this->belongsToMany(Competence::class, 'competence_cv');
    }
}
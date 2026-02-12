<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'cv_id',
        'diplome',
        'ecole',
        'annee',
    ];
    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences_cv';

    protected $fillable = [
        'cv_id',
        'poste',
        'entreprise',
        'duree',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}

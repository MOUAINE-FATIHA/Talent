<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_offer_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
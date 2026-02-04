<?php
class JobOffer extends Model{
    protected $fillable = [
        'titre',
        'description',
        'type_contrat',
        'entreprise',
        'image',
        'recruiter_id'
    ];
    public function recruiter(){
        return $this->belongsTo(Recruiter::class);
    }
}

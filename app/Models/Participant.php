<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'certification_scheme_code'];
    
    public function certificationScheme()
    {
        return $this->belongsTo(CertificationScheme::class, 'certification_scheme_code', 'code');
    }
}

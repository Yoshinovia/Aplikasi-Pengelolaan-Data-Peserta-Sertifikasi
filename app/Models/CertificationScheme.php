<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationScheme extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description'];
    
    public function participants()
    {
        return $this->hasMany(Participant::class, 'certification_scheme_code', 'code');
    }
}

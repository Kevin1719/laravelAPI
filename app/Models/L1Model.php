<?php

namespace App\Models;

use App\Models\Candidat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class L1Model extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }
    public function getanneeuniversitaireAttribute()
    {
        $annee = $this->annee + 1;

        return $this->annee.'-'.$annee;
    }
}

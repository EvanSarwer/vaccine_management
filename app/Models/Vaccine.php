<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disease;
use App\Models\VaccineTake;
use App\Models\VaccineStock;

class Vaccine extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function disease(){
        return $this->belongsTo(Disease::class,'disease_id');
    }

    public function vaccine_stocks(){
        return $this->hasMany(VaccineStock::class, 'vaccine_id');
    }

    public function vaccine_takes(){
        return $this->hasMany(VaccineTake::class, 'vaccine_id');
    }
}

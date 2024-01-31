<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VaccineTake;
use App\Models\VaccineStock;

class Center extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vaccine_stocks()
    {
        return $this->hasMany(VaccineStock::class, 'center_id');
    }

    public function vaccine_takes()
    {
        return $this->hasMany(VaccineTake::class, 'center_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaccine;
use App\Models\Center;


class VaccineStock extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}

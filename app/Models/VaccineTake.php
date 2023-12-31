<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaccine;
use App\Models\User;
use App\Models\Center;

class VaccineTake extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vaccine(){
        return $this->belongsTo(Vaccine::class,'vaccine_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function center(){
        return $this->belongsTo(Center::class,'center_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaccine;

class Disease extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vaccines(){
        return $this->hasMany(Vaccine::class, 'disease_id');
    }

}

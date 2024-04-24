<?php

namespace App\Modules\EquipmentMatricule\Models;

use App\Modules\Automobile\Models\Automobile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Equipment\Models\Equipment;

class EquipmentMatricule extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function automobile()
    {
        return $this->hasMany(Automobile::class);
    }
}

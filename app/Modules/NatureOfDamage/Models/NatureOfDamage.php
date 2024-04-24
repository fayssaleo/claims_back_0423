<?php

namespace App\Modules\NatureOfDamage\Models;

use App\Modules\Automobile\Models\Automobile;
use App\Modules\Container\Models\Container;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\Vessel\Models\Vessel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureOfDamage extends Model
{
    use HasFactory;

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
    public function Autos()
    {
        return $this->hasMany(Automobile::class);
    }
    public function Vessel()
    {
        return $this->hasMany(Vessel::class);
    }
    public function Containers()
    {
        return $this->hasMany(Container::class);
    }
    public function Claims()
    {
        return $this->hasMany(Claim::class);
    }



    protected $fillable = [
        'name',


    ];
}

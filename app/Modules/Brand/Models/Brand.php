<?php

namespace App\Modules\Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Equipment\Models\Equipment;
use App\Modules\Auto\Models\Auto;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Vessel\Models\Vessel;
use App\Modules\Container\Models\Container;

class Brand extends Model
{
    use HasFactory;

    public function Equipments()
    {
        return $this->hasMany(Equipment::class);
    }
    public function Autos()
    {
        return $this->hasMany(Automobile::class);
    }
    public function Vessels()
    {
        return $this->hasMany(Vessel::class);
    }
    public function Containers()
    {
        return $this->hasMany(Container::class);
    }

    protected $fillable = [
        'name',
    ];
}

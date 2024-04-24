<?php

namespace App\Modules\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Equipment\Models\Equipment;
use App\Modules\Auto\Models\Auto;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Vessel\Models\Vessel;
use App\Modules\Container\Models\Container;

class Company extends Model
{
    use HasFactory;


    public function Equipments()
    {
        return $this->hasMany(Equipment::class, 'companie_id');
    }
    public function Autos()
    {
        return $this->hasMany(Automobile::class, 'companie_id');
    }
    public function Vessels()
    {
        return $this->hasMany(Vessel::class, 'companie_id');
    }
    public function Containers()
    {
        return $this->hasMany(Container::class, 'companie_id');
    }

    protected $fillable = [
        'name',
    ];
}

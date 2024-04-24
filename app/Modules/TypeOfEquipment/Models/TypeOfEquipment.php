<?php

namespace App\Modules\TypeOfEquipment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Equipment\Models\Equipment;
use App\Modules\Auto\Models\Auto;
use App\Modules\Container\Models\Container;

class TypeOfEquipment extends Model
{
    use HasFactory;
    protected $table = 'type_of_equipments';

    public function Equipments(){
        return $this->hasMany(Equipment::class);
    }

    public function Autos(){
        return $this->hasMany(Auto::class);
    }

    public function Containers()
    {
        return $this->hasMany(Container::class);
    }

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}

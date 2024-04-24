<?php

namespace App\Modules\ShippingLine\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;
use App\Modules\Container\Models\Container;
use App\Modules\Vessel\Models\Vessel;

class ShippingLine extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
}

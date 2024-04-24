<?php

namespace App\Modules\LiabilityInsuranceFiles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Container\Models\Container;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\Vessel\Models\Vessel;
class LiabilityInsuranceFiles extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function equipment(){
        return $this->belongTo(Equipment::class);
    }
    public function vessel(){
        return $this->belongTo(Vessel::class);
    }
    public function automobile(){
        return $this->belongTo(Automobile::class);
    }
    public function container(){
        return $this->belongTo(Container::class);
    }


    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}

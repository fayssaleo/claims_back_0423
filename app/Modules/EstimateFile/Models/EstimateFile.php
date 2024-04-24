<?php

namespace App\Modules\EstimateFile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Estimate\Models\Estimate;
class EstimateFile extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function estimate(){
        return $this->belongTo(Estimate::class);
    }

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}

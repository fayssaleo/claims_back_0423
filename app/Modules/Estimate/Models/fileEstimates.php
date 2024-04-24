<?php

namespace App\Modules\Estimate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Estimate\Models\Estimate;

class fileEstimates extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function estimate(){
        return $this->belongTo(Estimate::class);
    }
}

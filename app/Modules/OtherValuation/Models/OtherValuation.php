<?php

namespace App\Modules\OtherValuation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Estimate\Models\Estimate;

class OtherValuation extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }
}

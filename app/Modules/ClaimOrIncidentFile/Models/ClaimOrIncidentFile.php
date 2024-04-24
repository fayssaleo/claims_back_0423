<?php

namespace App\Modules\ClaimOrIncidentFile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Claim\Models\Claim;

class ClaimOrIncidentFile extends Model
{
    use HasFactory;

    protected $guarded= ["id"];

    public function claim(){
        return $this->belongTo(Claim::class);
    }

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}

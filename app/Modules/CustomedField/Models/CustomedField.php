<?php

namespace App\Modules\CustomedField\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Estimate\Models\Estimate;

class CustomedField extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}

<?php

namespace App\Modules\Department\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Fonction\Models\Fonction;


class Department extends Model
{
    use HasFactory;
    public function fonctions()
    {
        return $this->hasMany(Fonction::class);
    }

    protected $fillable = [
        'name',
        'email',

    ];

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}

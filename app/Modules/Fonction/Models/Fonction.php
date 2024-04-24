<?php

namespace App\Modules\Fonction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Department\Models\Department;
use App\Modules\User\Models\User;

class Fonction extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'name',
        'department_id',
    ];

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];


}

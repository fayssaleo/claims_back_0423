<?php

namespace App\Modules\Action\Models;

use App\Models\User;
use App\Modules\Claim\Models\Claim;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
    public function actionDetails()
    {
        return $this->hasMany(ActionDetails::class);
    }
    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',

    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}

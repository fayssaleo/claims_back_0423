<?php

namespace App\Modules\Container\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\ShippingLine\Models\ShippingLine;
use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;
use App\Modules\Brand\Models\Brand;
use App\Modules\Department\Models\Department;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\Claim\Models\Claim;
use App\Modules\Company\Models\Company;
use App\Modules\Estimate\Models\Estimate;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;

class Container extends Model
{
    use HasFactory;
    protected $guarded= ["id"];

    public function claim(){
        return $this->belongsTo(Claim::class);
    }

    public function typeOfEquipment(){
        return $this->belongsTo(TypeOfEquipment::class);
    }

    public function natureOfDamage(){
        return $this->belongsTo(NatureOfDamage::class);
    }

    public function companie()
    {
        return $this->belongsTo(Company::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function estimate(){
        return $this->hasMany(Estimate::class);
    }

    public function shippingLine(){
        return $this->belongsTo(ShippingLine::class);
    }
    public function liabilityInsuranceFiles()
    {
        return $this->hasMany(LiabilityInsuranceFiles::class);
    }
    protected $casts = [
        'created_at' => 'datetime:m/d/Y H:i',
        'updated_at' => 'datetime:m/d/Y H:i',
        'date_of_reimbursement' => 'datetime:m/d/Y',
        'date_of_declaration' => 'datetime:m/d/Y',
        'date_of_feedback' => 'datetime:m/d/Y',
    ];

}

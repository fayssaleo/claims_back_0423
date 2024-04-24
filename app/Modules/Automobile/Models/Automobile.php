<?php

namespace App\Modules\Automobile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;
use App\Modules\Brand\Models\Brand;
use App\Modules\Department\Models\Department;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\Claim\Models\Claim;
use App\Modules\Estimate\Models\Estimate;
use App\Modules\Company\Models\Company;
use App\Modules\EquipmentMatricule\Models\EquipmentMatricule;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;

class Automobile extends Model
{
    use HasFactory;
    protected $guarded= ["id"];
    protected $table = 'automobiles';

    public function matricule()
    {
        return $this->belongsTo(EquipmentMatricule::class);
    }

    public function typeOfEquipment()
    {
        return $this->belongsTo(TypeOfEquipment::class);
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function natureOfDamage()
    {
        return $this->belongsTo(NatureOfDamage::class);
    }

    public function companie()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
    public function estimate()
    {
        return $this->hasMany(Estimate::class);
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
        'Indemnification_date' => 'datetime:m/d/Y',
    ];

}

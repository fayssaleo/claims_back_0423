<?php

namespace App\Modules\Claim\Models;

use App\Modules\Automobile\Models\Automobile;
use App\Modules\Container\Models\Container;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\ClaimOrIncidentFile\Models\ClaimOrIncidentFile;
use App\Modules\Department\Models\Department;
use App\Modules\Estimate\Models\Estimate;
use App\Modules\Vessel\Models\Vessel;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    use HasFactory;

    protected $guarded = ["id"];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    public function automobiles()
    {
        return $this->hasMany(Automobile::class);
    }

    public function claimOrIncidentFile()
    {
        return $this->hasMany(ClaimOrIncidentFile::class);
    }
    public static function getReinvoiced($claim_id)
    {

        $to_proceed = 0;
        $reinvoiced = 0;
        $paid = 0;
        $counter = 0;

        $equipments = Equipment::select()
            ->where([
                ["claim_id", $claim_id],
                ['nature_of_damage_id', '<>', null],
                ['nature_of_damage_id', '<>', 0]
            ])
            ->whereIn('damage_caused_by', ['Thirdparty', 'Outsourcer'])->get();
        for ($i = 0; $i < count($equipments); $i++) {
            $counter++;
            if ($equipments[$i]->reinvoiced == "TO PROCEED")
                $to_proceed++;
            else if ($equipments[$i]->reinvoiced == "REINVOICED")
                $reinvoiced++;
            else if ($equipments[$i]->reinvoiced == "PAID")
                $paid++;
        }

        $automobiles = Automobile::select()
            ->where([
                ["claim_id", $claim_id],
                ['nature_of_damage_id', '<>', null],
                ['nature_of_damage_id', '<>', 0]
            ])
            ->whereIn('damage_caused_by', ['Thirdparty', 'Outsourcer'])->get();
        for ($i = 0; $i < count($automobiles); $i++) {
            $counter++;
            if ($automobiles[$i]->reinvoiced == "TO PROCEED")
                $to_proceed++;
            else if ($automobiles[$i]->reinvoiced == "REINVOICED")
                $reinvoiced++;
            else if ($automobiles[$i]->reinvoiced == "PAID")
                $paid++;
        }

        $containers = Container::select()
            ->where([
                ["claim_id", $claim_id],
                ['nature_of_damage_id', '<>', null],
                ['nature_of_damage_id', '<>', 0]
            ])
            ->whereIn('damage_caused_by', ['Thirdparty', 'Outsourcer'])->get();
        for ($i = 0; $i < count($containers); $i++) {
            $counter++;
            if ($containers[$i]->reinvoiced == "TO PROCEED")
                $to_proceed++;
            else if ($containers[$i]->reinvoiced == "REINVOICED")
                $reinvoiced++;
            else if ($containers[$i]->reinvoiced == "PAID")
                $paid++;
        }

        $vessels = Vessel::select()
            ->where([
                ["claim_id", $claim_id],
                ['nature_of_damage_id', '<>', null],
                ['nature_of_damage_id', '<>', 0]
            ])
            ->whereIn('damage_caused_by', ['Thirdparty', 'Outsourcer'])->get();
        for ($i = 0; $i < count($vessels); $i++) {
            $counter++;
            if ($vessels[$i]->reinvoiced == "TO PROCEED")
                $to_proceed++;
            else if ($vessels[$i]->reinvoiced == "REINVOICED")
                $reinvoiced++;
            else if ($vessels[$i]->reinvoiced == "PAID")
                $paid++;
        }

        if ($counter > 0) {
            if ($counter == $to_proceed)
                return "TO PROCEED";
            else if ($counter == $reinvoiced)
                return "REINVOICED";
            else if ($counter == $paid)
                return "PAID";
            else if ($to_proceed == 0) {
                if ($reinvoiced == 0 && $paid != 0) {
                    return "PAID";
                } else if ($reinvoiced != 0) return "REINVOICED";
            }
            return "TO PROCEED";
        } else return "";
    }
    public static function getEquipmentIds($claim_id)
    {

        $major = [];

        $equipments = Equipment::select()->where("claim_id", $claim_id)->with("typeOfEquipment")->get();
        for ($i = 0; $i < count($equipments); $i++) {
            $majorCase = "";
            if ($equipments[$i]) {
                if (!is_null($equipments[$i]->typeOfEquipment)) {
                    if (!is_null($equipments[$i]->matricule)) {
                        $majorCase = "Equipment - " . $equipments[$i]->typeOfEquipment->name . " : " . $equipments[$i]->matricule->id_equipment;
                    } else {
                        $majorCase = "Equipment - " . $equipments[$i]->typeOfEquipment->name;
                    }
                } else
                    $majorCase = "Equipment";
            }
            array_push($major, $majorCase);
        }

        $automobiles = Automobile::select()->where("claim_id", $claim_id)->with("typeOfEquipment")->get();
        for ($i = 0; $i < count($automobiles); $i++) {
            $majorCase = "";
            if ($automobiles[$i]) {
                if (!is_null($automobiles[$i]->typeOfEquipment)) {
                    if (!is_null($automobiles[$i]->matricule)) {
                        $majorCase = "Automobile - " . $automobiles[$i]->typeOfEquipment->name . " : " . $automobiles[$i]->matricule->id_equipment;
                    } else {
                        $majorCase = "Automobile - " . $automobiles[$i]->typeOfEquipment->name;
                    }
                } else
                    $majorCase = "Automobile";
            }
            array_push($major, $majorCase);
        }

        $containers = Container::select()->where("claim_id", $claim_id)->with("typeOfEquipment")->get();
        for ($i = 0; $i < count($containers); $i++) {
            $majorCase = "";
            if ($containers[$i]) {
                if (!is_null($containers[$i]->shippingLine)) {
                    if (!empty($containers[$i]->containerID)) {
                        $majorCase = "Container - " . $containers[$i]->shippingLine->name . " : " . $containers[$i]->containerID;
                    } else {
                        $majorCase = "Container - " . $containers[$i]->shippingLine->name;
                    }
                } else {
                    if (!empty($containers[$i]->containerID)) {
                        $majorCase = "Container - : " . $containers[$i]->containerID;
                    } else {
                        $majorCase = "Container ";
                    }
                }
            }
            array_push($major, $majorCase);
        }


        $vessels = Vessel::select()->where("claim_id", $claim_id)->with("typeOfEquipment")->get();
        for ($i = 0; $i < count($vessels); $i++) {
            $majorCase = "";
            if ($vessels[$i]) {
                if (!is_null($vessels[$i]->shippingLine)) {
                    if (!empty($vessels[$i]->vessel_number)) {
                        $majorCase = "Vessel - " . $vessels[$i]->shippingLine->name . " : " . $vessels[$i]->vessel_number;
                    } else {
                        $majorCase = "Vessel - " . $vessels[$i]->shippingLine->name;
                    }
                } else {
                    if (!empty($vessels[$i]->vessel_number)) {
                        $majorCase = "Vessel - : " . $vessels[$i]->vessel_number;
                    } else {
                        $majorCase = "Vessel";
                    }
                }
            }
            array_push($major, $majorCase);
        }





        return $major;
    }

    public static function getConcernedDepartment($deparments_ids)
    {
        $ids = "";
        if ($deparments_ids != null)
            $ids = $deparments_ids;
        $idstoArray = explode("|", $ids);
        $departments = Department::whereIn('id', $idstoArray)->get();
        $departmentsName = "";
        for ($i = 0; $i < count($departments); $i++) {
            $departmentsName += $departments[$i] + " ";
        }
        return $departmentsName;
    }

    public static function getDeclare($claim_id)
    {

        $major = "";

        $equipments = Equipment::select()->where("claim_id", $claim_id)->where("date_of_declaration", "!=", null)->with("typeOfEquipment")->first();
        if ($equipments) {
            $date = new DateTimeImmutable($equipments->date_of_declaration);
            $date = $date->format('Y-m-d');
            if (!is_null($equipments->typeOfEquipment)) {
                if (!is_null($equipments->matricule)) {
                    $major = "Equipment - " . $equipments->typeOfEquipment->name . " : " . $equipments->matricule->id_equipment . " At : " . $date;
                } else
                    $major = "Equipment - " . $equipments->typeOfEquipment->name . " At : " . $date;
            } else
                $major = "Equipment" . " At : " . $date;
            return $major;
        }

        $containers = Container::select()->where("claim_id", $claim_id)->where("date_of_declaration", "!=", null)->with("typeOfEquipment")->first();
        if ($containers) {
            $date = new DateTimeImmutable($containers->date_of_declaration);
            $date = $date->format('Y-m-d');
            if (!is_null($containers->typeOfEquipment)) {
                if (!is_null($containers->matricule)) {
                    $major = "Container - " . $containers->typeOfEquipment->name . " : " . $containers->matricule->id_equipment . " At : " . $date;
                } else
                    $major = "Container - " . $containers->typeOfEquipment->name . " At : " . $date;
            } else
                $major = "Container" . " At : " . $date;
            return $major;
        }

        $vessels = Vessel::select()->where("claim_id", $claim_id)->where("date_of_declaration", "!=", null)->first();
        if ($vessels) {
            $date = new DateTimeImmutable($vessels->date_of_declaration);
            $date = $date->format('Y-m-d');
            if (!is_null($vessels->shippingLine)) {
                //                if ($vessels->id === 17)
                //                  dd($vessels->vessel_number);
                if (!empty($vessels->vessel_number)) {
                    $major = "Vessel - " . $vessels->shippingLine->name . " : " . $vessels->vessel_number . " At : " . $date;
                } else
                    $major = "Vessel - " . $vessels->shippingLine->name . " At : " . $date;
            } else if (!empty($vessels->vessel_number)) {

                $major = "Vessel :" . $vessels->vessel_number . " At : " . $date;
            } else
                $major = "Vessel" . " At : " . $date;
            return $major;
        }

        $automobiles = Automobile::select()->where("claim_id", $claim_id)->where("date_of_declaration", "!=", null)->with("typeOfEquipment")->first();
        if ($automobiles) {
            $date = new DateTimeImmutable($automobiles->date_of_declaration);
            $date = $date->format('Y-m-d');
            if (!is_null($automobiles->typeOfEquipment)) {
                if (!is_null($automobiles->matricule)) {
                    $major = "Automobile - " . $automobiles->typeOfEquipment->name . " : " . $automobiles->matricule->id_equipment . " At : " . $date;
                } else
                    $major = "Automobile - " . $automobiles->typeOfEquipment->name . " At : " . $date;
            } else
                $major = "Automobile" . " At : " . $date;
            return $major;
        }

        return $major;
    }

    public static function getType($claim_id)
    {

        $major = "";

        $equipments = Equipment::select()->where("claim_id", $claim_id)->where("major", 1)->with("typeOfEquipment")->first();
        if ($equipments) {
            if (!is_null($equipments->typeOfEquipment)) {
                if (!is_null($equipments->matricule)) {
                    $major = "Equipment - " . $equipments->typeOfEquipment->name . " : " . $equipments->matricule->id_equipment;
                } else
                    $major = "Equipment - " . $equipments->typeOfEquipment->name;
            } else
                $major = "Equipment";
            return $major;
        }

        $containers = Container::select()->where("claim_id", $claim_id)->where("major", 1)->with("typeOfEquipment")->first();
        if ($containers) {
            if (!is_null($containers->typeOfEquipment)) {
                if (!is_null($containers->matricule)) {
                    $major = "Container - " . $containers->typeOfEquipment->name . " : " . $containers->matricule->id_equipment;
                } else
                    $major = "Container - " . $containers->typeOfEquipment->name;
            } else
                $major = "Container";
            return $major;
        }

        $vessels = Vessel::select()->where("claim_id", $claim_id)->where("major", 1)->first();
        if ($vessels) {
            if (!is_null($vessels->shippingLine)) {
                //                if ($vessels->id === 17)
                //                  dd($vessels->vessel_number);
                if (!empty($vessels->vessel_number)) {
                    $major = "Vessel - " . $vessels->shippingLine->name . " : " . $vessels->vessel_number;
                } else
                    $major = "Vessel - " . $vessels->shippingLine->name;
            } else if (!empty($vessels->vessel_number)) {

                $major = "Vessel :" . $vessels->vessel_number;
            } else
                $major = "Vessel";
            return $major;
        }

        $automobiles = Automobile::select()->where("claim_id", $claim_id)->where("major", 1)->with("typeOfEquipment")->first();
        if ($automobiles) {
            if (!is_null($automobiles->typeOfEquipment)) {
                if (!is_null($automobiles->matricule)) {
                    $major = "Automobile - " . $automobiles->typeOfEquipment->name . " : " . $automobiles->matricule->id_equipment;
                } else
                    $major = "Automobile - " . $automobiles->typeOfEquipment->name;
            } else
                $major = "Automobile";
            return $major;
        }

        return $major;
    }
    public static function getEstimation($claim_id)
    {
        $equipments = Equipment::select()->where("claim_id", $claim_id)->get();
        $containers = Container::select()->where("claim_id", $claim_id)->get();
        $vessels = Vessel::select()->where("claim_id", $claim_id)->get();
        $automobiles = Automobile::select()->where("claim_id", $claim_id)->get();
        $otherValues = 0;
        for ($i = 0; $i < count($equipments); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("equipment_id", $equipments[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($containers); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("container_id", $containers[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($vessels); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("vessel_id", $vessels[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($automobiles); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("automobile_id", $automobiles[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        return $otherValues . " (EUR)";
    }

    public function getCreatedAtAttribute($value)
    {
        return date('m/d/Y H:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('m/d/Y H:i', strtotime($value));
    }

    public function getIncidentDateAttribute($value)
    {
        return date('m/d/Y', strtotime($value));
    }

    public function getCclaimD_dateAttribute($value)
    {
        return date('m/d/Y', strtotime($value));
    }

    public  function getEstimation2()
    {
        $equipments = $this->equipments()->select()->get();
        $containers = $this->containers()->select()->get();
        $vessels = $this->vessels()->select()->get();
        $automobiles = $this->automobiles()->select()->get();
        $otherValues = 0;
        for ($i = 0; $i < count($equipments); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("temporary_or_permanent", "Permanent")->where("equipment_id", $equipments[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($containers); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("temporary_or_permanent", "Permanent")->where("container_id", $containers[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($vessels); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("temporary_or_permanent", "Permanent")->where("vessel_id", $vessels[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        for ($i = 0; $i < count($automobiles); $i++) {
            $estimation = Estimate::select()->with("otherValuation")->where("temporary_or_permanent", "Permanent")->where("automobile_id", $automobiles[$i]->id)->first();
            if ($estimation)
                for ($j = 0; $j < count($estimation->otherValuation); $j++) {
                    $otherValues += $estimation->otherValuation[$j]->value * $estimation->otherValuation[$j]->taux_change;
                }
        }
        return $otherValues;
    }

    protected $casts = [
        'created_at' => 'datetime:m/d/Y H:i',
        'updated_at' => 'datetime:m/d/Y H:i',
        'incident_date' => 'datetime:m/d/Y',
        'claim_date' => 'datetime:m/d/Y',
    ];
}

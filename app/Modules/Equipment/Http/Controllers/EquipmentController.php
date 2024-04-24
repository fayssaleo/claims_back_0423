<?php

namespace App\Modules\Equipment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Brand\Models\Brand;
use App\Modules\Company\Models\Company;
use App\Modules\Claim\Models\Claim;
use App\Modules\Container\Models\Container;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\File\Models\File;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;
use App\Modules\EquipmentMatricule\Models\EquipmentMatricule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Error;
use PhpParser\Node\Expr\Array_;
use stdClass;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;
use App\Modules\Vessel\Models\Vessel;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class EquipmentController extends Controller
{
    use UploadTrait;
    public function createOrUpdateEquipment(Request $request)
    {
        if ($request->id == 0 || $request->id == null || $request->id == "undefined") {
            $claim = null;
            if ($request->claim_id == 0 || $request->claim_id == null || $request->claim_id == "undefined") {
                $claim = new Claim();
                //$claim->claimOrIncident = $request->claimOrIncident;
                $claim->save();
            } else {
                $claim = Claim::find($request->claim_id);
                if (!$claim) {
                    return [
                        "payload" => "The searched claim does not exist !",
                        "status" => "404_3"
                    ];
                }
                // $claim->claimOrIncident = $request->claimOrIncident;
                $claim->save();
            }
            $equipment = Equipment::make($request->all());
            $equipment->major = $request->major ? 1 : 0;
            $equipment->claim_id = $claim->id;
            if ($request->nature_of_damage["id"] == 0 || $request->nature_of_damage["id"] == null || $request->nature_of_damage["id"] == "undefined") {
                if ($request->nature_of_damage["name"] != null || $request->nature_of_damage["name"] != "") {
                    $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndSave($request->nature_of_damage);
                    if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $nature_of_damage_returnedValue["payload"],
                            "status" => $nature_of_damage_returnedValue["status"]
                        ];
                    }
                    $equipment->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $equipment->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
                    ];
                }
            }
            if ($request->brand["id"] == 0 || $request->brand["id"] == null || $request->brand["id"] == "undefined") {
                if ($request->brand["name"] != null || $request->brand["name"] != "") {
                    $brand_returnedValue = $this->brand_confirmAndSave($request->brand);

                    if ($brand_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $brand_returnedValue["payload"],
                            "status" => $brand_returnedValue["status"]
                        ];
                    }
                    $equipment->brand_id = $brand_returnedValue["payload"]->id;
                }
            } else {
                $band_returnedValue = $this->brand_confirmAndUpdate($request->brand);
                $equipment->brand_id = $request->brand["id"];
                if ($band_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $band_returnedValue["payload"],
                        "status" => $band_returnedValue["status"]
                    ];
                }
            }

            if ($request->companie["id"] == 0 || $request->companie["id"] == null || $request->companie["id"] == "undefined") {
                if ($request->companie["name"] != null || $request->companie["name"] != "") {
                    $companie_returnedValue = $this->companie_confirmAndSave($request->companie);

                    if ($companie_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $companie_returnedValue["payload"],
                            "status" => $companie_returnedValue["status"]
                        ];
                    }
                    $equipment->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $equipment->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
                    ];
                }
            }

            if ($request->type_of_equipment["id"] == 0 || $request->type_of_equipment["id"] == null || $request->type_of_equipment["id"] == "undefined") {
                if ($request->type_of_equipment["name"] != null || $request->type_of_equipment["name"] != "") {
                    $type_of_equipment_returnedValue = $this->type_of_equipment_confirmAndSave($request->type_of_equipment);
                    if ($type_of_equipment_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $type_of_equipment_returnedValue["payload"],
                            "status" => $type_of_equipment_returnedValue["status"]
                        ];
                    }
                    $equipment->type_of_equipment_id = $type_of_equipment_returnedValue["payload"]->id;
                }
            } else {
                $type_of_equipment_returnedValue = $this->type_of_equipment_confirmAndUpdate($request->type_of_equipment);
                $equipment->type_of_equipment_id = $request->type_of_equipment["id"];
                if ($type_of_equipment_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $type_of_equipment_returnedValue["payload"],
                        "status" => $type_of_equipment_returnedValue["status"]
                    ];
                }
            }

            if ($request->matricule["id"] == 0 || $request->matricule["id"] == null ||  $request->matricule["id"] == "undefined") {
                if ($request->matricule["matricule"] != null || $request->matricule["matricule"] != "") {
                    $equipmentMatricule_returnedValue = $this->equipmentMatricule_confirmAndSave($request->matricule);

                    if ($equipmentMatricule_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $equipmentMatricule_returnedValue["payload"],
                            "status" => $equipmentMatricule_returnedValue["status"]
                        ];
                    }
                    $equipment->matricule_id = $equipmentMatricule_returnedValue["payload"]->id;
                }
            } else {
                $equipmentMatricule_returnedValue = $this->equipmentMatricule_confirmAndUpdate($request->matricule);
                $equipment->matricule_id = $request->matricule["id"];
                if ($equipmentMatricule_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $equipmentMatricule_returnedValue["payload"],
                        "status" => $equipmentMatricule_returnedValue["status"]
                    ];
                }
            }
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $equipment->id)
                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('vessels')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
            }
            $equipment->save();




            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {

                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.equipments.path'), $filename, "public_uploads_equipments_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->equipment_id = $equipment->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.equipments.path'), $filename, "public_uploads_equipments_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->equipment_id = $equipment->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }
            // delete files
            if (!empty($request["LiabilityInsuranceFilesDelete"]) && $request["filesDelete"] != null) {
                for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                    $LiabilityInsuranceFile = LiabilityInsuranceFiles::find($request["filesDelete"][$i]["id"]);
                    $this->deleteOne(config('cdn.equipments.path'), $LiabilityInsuranceFile->filename);
                    $LiabilityInsuranceFile->delete();
                }
            }
            $equipment->claim_id = $equipment->claim->id;
            $equipment->type_of_equipment = $equipment->typeOfEquipment;
            $equipment->brand = $equipment->brand;
            $equipment->companie = $equipment->companie;
            $equipment->nature_of_damage = $equipment->natureOfDamage;
            $equipment->matricule = $equipment->matricule;
            return [
                "payload" => $equipment,
                "status" => "200"
            ];
        } else {

            $claim = Claim::find($request->claim_id);
            if (!$claim) {
                return [
                    "payload" => "The searched claim does not exist !",
                    "status" => "404_3"
                ];
            }
            // $claim->claimOrIncident = $request->claimOrIncident;
            $claim->save();
            $validator = Validator::make($request->all(), []);
            if ($validator->fails()) {
                return [
                    "payload" => $validator->errors(),
                    "status" => "406_2"
                ];
            }
            $equipment = Equipment::find($request->id);
            if (!$equipment) {
                return [
                    "payload" => "The searched row does not exist !",
                    "status" => "404_3"
                ];
            }
            $equipment->name = $request->name;
            $equipment->department_id = $request->department_id;
            $equipment->deductible_charge_TAT = $request->deductible_charge_TAT;
            $equipment->concerned_internal_department = $request->concerned_internal_department;
            $equipment->cause_damage = $request->cause_damage;
            $equipment->damage_description = $request->damage_description;
            $equipment->Liability_letter_number = $request->Liability_letter_number;
            $equipment->amount = $request->amount;
            $equipment->currency = $request->currency;
            $equipment->comment_third_party = $request->comment_third_party;
            $equipment->reinvoiced = $request->reinvoiced;
            $equipment->currency_Insurance = $request->currency_Insurance;
            $equipment->Invoice_number = $request->Invoice_number;
            $equipment->date_of_reimbursement = $request->date_of_reimbursement;
            $equipment->reimbursed_amount = $request->reimbursed_amount;
            $equipment->date_of_declaration = $request->date_of_declaration;
            $equipment->date_of_feedback = $request->date_of_feedback;
            $equipment->comment_Insurance = $request->comment_Insurance;
            $equipment->Indemnification_of_insurer = $request->Indemnification_of_insurer;
            $equipment->Indemnification_date = $request->Indemnification_date;
            $equipment->currency_indemnisation = $request->currency_indemnisation;
            $equipment->deductible_charge_TAT = $request->deductible_charge_TAT;
            $equipment->damage_caused_by = $request->damage_caused_by;
            $equipment->comment_nature_of_damage = $request->comment_nature_of_damage;
            $equipment->TAT_name_persons = $request->TAT_name_persons;
            $equipment->outsourcer_company_name = $request->outsourcer_company_name;
            $equipment->outsourcer_persons = $request->outsourcer_persons;
            $equipment->thirdparty_company_name = $request->thirdparty_company_name;
            $equipment->thirdparty_persons = $request->thirdparty_persons;
            $equipment->thirdparty_Activity_comments = $request->thirdparty_Activity_comments;
            $equipment->incident_report = $request->incident_report;
            $equipment->liability_letter = $request->liability_letter;
            $equipment->insurance_declaration = $request->insurance_declaration;
            $equipment->major = $request->major ? 1 : 0;
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $equipment->id)
                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('vessels')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
            }
            if ($request->nature_of_damage["id"] == 0 || $request->nature_of_damage["id"] == null || $request->nature_of_damage["id"] == "undefined") {
                if ($request->nature_of_damage["name"] != null || $request->nature_of_damage["name"] != "") {
                    $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndSave($request->nature_of_damage);
                    if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $nature_of_damage_returnedValue["payload"],
                            "status" => $nature_of_damage_returnedValue["status"]
                        ];
                    }
                    $equipment->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $equipment->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
                    ];
                }
            }
            if ($request->brand["id"] == 0 || $request->brand["id"] == null || $request->brand["id"] == "undefined") {
                if ($request->brand["name"] != null || $request->brand["name"] != "") {
                    $brand_returnedValue = $this->brand_confirmAndSave($request->brand);

                    if ($brand_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $brand_returnedValue["payload"],
                            "status" => $brand_returnedValue["status"]
                        ];
                    }
                    $equipment->brand_id = $brand_returnedValue["payload"]->id;
                }
            } else {
                $band_returnedValue = $this->brand_confirmAndUpdate($request->brand);
                $equipment->brand_id = $request->brand["id"];

                if ($band_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $band_returnedValue["payload"],
                        "status" => $band_returnedValue["status"]
                    ];
                }
            }

            if ($request->companie["id"] == 0 || $request->companie["id"] == null || $request->companie["id"] == "undefined") {
                if ($request->companie["name"] != null || $request->companie["name"] != "") {
                    $companie_returnedValue = $this->companie_confirmAndSave($request->companie);

                    if ($companie_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $companie_returnedValue["payload"],
                            "status" => $companie_returnedValue["status"]
                        ];
                    }
                    $equipment->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $equipment->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
                    ];
                }
            }


            if ($request->type_of_equipment["id"] == 0 || $request->type_of_equipment["id"] == null || $request->type_of_equipment["id"] == "undefined") {
                if ($request->type_of_equipment["name"] != null || $request->type_of_equipment["name"] != "") {
                    $type_of_equipment_returnedValue = $this->type_of_equipment_confirmAndSave($request->type_of_equipment);
                    if ($type_of_equipment_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $type_of_equipment_returnedValue["payload"],
                            "status" => $type_of_equipment_returnedValue["status"]
                        ];
                    }
                    $equipment->type_of_equipment_id = $type_of_equipment_returnedValue["payload"]->id;
                }
            } else {
                $type_of_equipment_returnedValue = $this->type_of_equipment_confirmAndUpdate($request->type_of_equipment);
                $equipment->type_of_equipment_id = $request->type_of_equipment["id"];

                if ($type_of_equipment_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $type_of_equipment_returnedValue["payload"],
                        "status" => $type_of_equipment_returnedValue["status"]
                    ];
                }
            }
            if ($request->matricule["id"] == 0 || $request->matricule["id"] == null || $request->matricule["id"] == "undefined") {
                if ($request->matricule["matricule"] != null || $request->matricule["matricule"] != "") {
                    $equipmentMatricule_returnedValue = $this->equipmentMatricule_confirmAndSave($request->matricule);

                    if ($equipmentMatricule_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $equipmentMatricule_returnedValue["payload"],
                            "status" => $equipmentMatricule_returnedValue["status"]
                        ];
                    }
                    $equipment->matricule_id = $equipmentMatricule_returnedValue["payload"]->id;
                }
            } else {
                $equipmentMatricule_returnedValue = $this->equipmentMatricule_confirmAndUpdate($request->matricule);
                $equipment->matricule_id = $request->matricule["id"];
                if ($equipmentMatricule_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $equipmentMatricule_returnedValue["payload"],
                        "status" => $equipmentMatricule_returnedValue["status"]
                    ];
                }
            }
            $equipment->save();

            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {

                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.equipments.path'), $filename, "public_uploads_equipments_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->equipment_id = $equipment->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.equipments.path'), $filename, "public_uploads_equipments_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->equipment_id = $equipment->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }
            if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
                for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                    $LiabilityInsuranceFile = LiabilityInsuranceFiles::find($request["filesDelete"][$i]["id"]);
                    $this->deleteOne(config('cdn.equipments.path'), $LiabilityInsuranceFile->filename);
                    $LiabilityInsuranceFile->delete();
                }
            }
            $equipment->claim_id = $equipment->claim->id;
            $equipment->type_of_equipment = $equipment->typeOfEquipment;
            $equipment->brand = $equipment->brand;
            $equipment->companie = $equipment->companie;
            $equipment->nature_of_damage = $equipment->natureOfDamage;
            $equipment->matricule = $equipment->matricule;
            return [
                "payload" => $equipment,
                "status" => "200"
            ];
        }
    }
    public function index($claim_id)
    {
        $equipment = Equipment::select()
            ->where('claim_id', $claim_id)
            ->with("typeOfEquipment")
            ->with("brand")
            ->with("companie")
            ->with("natureOfDamage")
            ->with("department")
            ->with("matricule")
            ->with("liabilityInsuranceFiles")
            ->with("estimate")
            ->with("estimate.otherValuation")
            ->get();



        for ($j = 0; $j < count($equipment); $j++) {
            $calculated = false;
            $totalAmount = 0;
            $currency = "";
            $AmountCustomedField = 0;
            for ($i = count($equipment[$j]->estimate) - 1; $i >= 0; $i--) {
                // dd($equipment[$j]->estimate[$i]->otherValuation);
                if (!$calculated) {
                    for ($d = 0; $d < count($equipment[$j]->estimate[$i]->otherValuation); $d++) {
                        $AmountCustomedField += $equipment[$j]->estimate[$i]->otherValuation[$d]->value_valuation;
                    }
                    $totalAmount += $AmountCustomedField;
                    $calculated = true;
                    $currency = $equipment[$j]->estimate[$i]->currency_estimate;
                }
            }

            $equipment[$j]->estimationAmount = $totalAmount . " (" . $currency . ")";
        }



        return [
            "payload" => $equipment,
            "totalAmount" => "fffff",

            "status" => "200_1"
        ];
    }
    public function delete(Request $request)
    {
        $equipment = Equipment::find($request->id);
        if (!$equipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $equipment->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
    public function nature_of_damage_confirmAndSave($NatureOfDamage)
    {
        $validator = Validator::make($NatureOfDamage, [
            //"name" => "required:nature_of_damages,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2",
                "IsReturnErrorRespone" => true
            ];
        }
        if (NatureOfDamage::select()->where("name", $NatureOfDamage['name'])->count() > 0) {
            return [
                "payload" => "This nature of damage is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $natureOfDamage = NatureOfDamage::make($NatureOfDamage);
        $natureOfDamage->categorie = "equipment";

        $natureOfDamage->save();
        return [
            "payload" => $natureOfDamage,
            "status" => "200",
            "IsReturnErrorRespone" => false

        ];
    }
    public function nature_of_damage_confirmAndUpdate($NatureOfDamage)
    {
        $natureOfDamage = NatureOfDamage::find($NatureOfDamage['id']);
        if (!$natureOfDamage) {
            return [
                "payload" => "nature of Damage is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($natureOfDamage) {
            //$natureOfDamage->name=$NatureOfDamage['name'];
            $natureOfDamage->save();
            return [
                "payload" => $natureOfDamage,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
    public function companie_confirmAndSave($Companie)
    {
        $validator = Validator::make($Companie, [
            //"name" => "required:brands,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        if (Company::select()->where("name", $Companie['name'])->count() > 0) {
            return [
                "payload" => "This company name is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $companie = Company::make($Companie);
        $companie->categorie = "equipment";

        $companie->save();

        return [
            "payload" => $companie,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function companie_confirmAndUpdate($Companie)
    {
        $companie = Company::find($Companie['id']);
        if (!$companie) {
            return [
                "payload" => "companie is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($Companie) {
            $companie->save();
            return [
                "payload" => $companie,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
    public function brand_confirmAndSave($Brand)
    {
        $validator = Validator::make($Brand, [
            //"name" => "required:brands,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        if (Brand::select()->where("name", $Brand['name'])->count() > 0) {
            return [
                "payload" => "This brand name is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $brand = Brand::make($Brand);
        $brand->categorie = "equipment";

        $brand->save();

        return [
            "payload" => $brand,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function brand_confirmAndUpdate($Brand)
    {
        $brand = Brand::find($Brand['id']);
        if (!$brand) {
            return [
                "payload" => "brand is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($brand) {
            //$brand->name=$Brand['name'];
            $brand->save();
            return [
                "payload" => $brand,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
    public function makeItMajor(Request $request)
    {
        $equipments = Equipment::select()
            ->where('claim_id', $request->claim_id)
            ->get();

        for ($i = 0; $i < count($equipments); $i++) {
            $thisEquipment = Equipment::find($equipments[$i])->first();
            $thisEquipment->major = false;
            $thisEquipment->save();
        }
        $equipment = Equipment::find($request->id);
        if (!$equipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $equipment->major = true;
            $equipment->save();
            return [
                "payload" => "Successfully",
                "status" => "200_4"
            ];
        }
    }
    public function disableMajor(Request $request)
    {
        $equipment = Equipment::find($request->id);
        if (!$equipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $equipment->major = false;
            $equipment->save();
            return [
                "payload" => "Successfully",
                "status" => "200_4"
            ];
        }
    }
    public function type_of_equipment_confirmAndSave($Type_of_equipment)
    {
        $validator = Validator::make($Type_of_equipment, [
            //"name" => "required:type_of_equipments,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        if (TypeOfEquipment::select()->where("name", $Type_of_equipment['name'])->count() > 0) {
            return [
                "payload" => "This type of equipment name is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $type_of_equipemnt = TypeOfEquipment::make($Type_of_equipment);
        $type_of_equipemnt->categorie = "equipment";
        $type_of_equipemnt->save();

        return [
            "payload" => $type_of_equipemnt,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function type_of_equipment_confirmAndUpdate($Type_of_equipment)
    {
        $type_of_equipment = TypeOfEquipment::find($Type_of_equipment['id']);
        if (!$type_of_equipment) {
            return [
                "payload" => "type_of_equipment is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($type_of_equipment) {
            //  $type_of_equipment->name=$Type_of_equipment['name'];
            $type_of_equipment->save();
            return [
                "payload" => $type_of_equipment,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
    public function equipmentMatricule_confirmAndSave($EquipmentMatricule)
    {
        $validator = Validator::make($EquipmentMatricule, [
            //"name" => "required:brands,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        if (EquipmentMatricule::select()->where([["matricule", $EquipmentMatricule['matricule']], ["equipment", $EquipmentMatricule['equipment']]])->count() > 0) {
            return [
                "payload" => "This type of equipment name is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $equipmentMatricule = EquipmentMatricule::make($EquipmentMatricule);

        $equipmentMatricule->save();

        return [
            "payload" => $equipmentMatricule,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function equipmentMatricule_confirmAndUpdate($EquipmentMatricule)
    {
        $equipmentMatricule = EquipmentMatricule::find($EquipmentMatricule['id']);
        if (!$equipmentMatricule) {
            return [
                "payload" => "equipmentMatricule is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($equipmentMatricule) {
            $equipmentMatricule->save();
            return [
                "payload" => $equipmentMatricule,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
    public function getIncidentReportsFilePath()
    {
        return [
            "payload" => asset("/storage/cdn/equipments/incident_report"),
            "status" => "200_1"
        ];
    }
}

<?php

namespace App\Modules\Vessel\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Brand\Models\Brand;
use App\Modules\Claim\Models\Claim;
use App\Modules\Vessel\Models\Vessel;
use App\Modules\File\Models\File;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\ShippingLine\Models\ShippingLine;
use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;
use App\Modules\Company\Models\Company;
use App\Modules\Container\Models\Container;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;
use Illuminate\Support\Facades\DB;
use PhpParser\Error;

class VesselController extends Controller
{
    use UploadTrait;
    public function createOrUpdateVessel(Request $request)
    {
        if ($request->id == 0 || $request->id == null || $request->id == "undefined") {



            $claim = null;
            if ($request->claim_id == 0 || $request->claim_id == null || $request->claim_id == "undefined") {
                $claim = new Claim();
                $claim->save();
            } else {
                $claim = Claim::find($request->claim_id);
                if (!$claim) {
                    return [
                        "payload" => "The searched claim does not exist !",
                        "status" => "404_3"
                    ];
                }
            }
            $vessel = Vessel::make($request->all());
            $vessel->major = $request->major ? 1 : 0;
            $vessel->claim_id = $claim->id;

            if ($request->nature_of_damage["id"] == 0 || $request->nature_of_damage["id"] == null ||  $request->nature_of_damage["id"] == "undefined") {
                if ($request->nature_of_damage["name"] != null || $request->nature_of_damage["name"] != "") {
                    $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndSave($request->nature_of_damage);
                    if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $nature_of_damage_returnedValue["payload"],
                            "status" => $nature_of_damage_returnedValue["status"]
                        ];
                    }
                    $vessel->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $vessel->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
                    ];
                }
            }

            if ($request->companie["id"] == 0 || $request->companie["id"] == null ||  $request->companie["id"] == "undefined") {
                if ($request->companie["name"] != null || $request->companie["name"] != "") {
                    $companie_returnedValue = $this->companie_confirmAndSave($request->companie);

                    if ($companie_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $companie_returnedValue["payload"],
                            "status" => $companie_returnedValue["status"]
                        ];
                    }
                    $vessel->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $vessel->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
                    ];
                }
            }

            if ($request->shipping_line["id"] == 0 || $request->shipping_line["id"] == null ||  $request->shipping_line["id"] == "undefined") {
                if ($request->shipping_line["name"] != null || $request->shipping_line["name"] != "") {
                    $shipping_line_returnedValue = $this->shipping_line_confirmAndSave($request->shipping_line);
                    if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $shipping_line_returnedValue["payload"],
                            "status" => $shipping_line_returnedValue["status"]
                        ];
                    }
                    $vessel->shipping_line_id = $shipping_line_returnedValue["payload"]->id;
                }
            } else {
                $shipping_line_returnedValue = $this->shipping_line_confirmAndUpdate($request->shipping_line);
                $vessel->shipping_line_id = $request->shipping_line["id"];
                if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $shipping_line_returnedValue["payload"],
                        "status" => $shipping_line_returnedValue["status"]
                    ];
                }
            }
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('vessels')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $vessel->id)
                    ->update(['major' => 0]);
            }
            $vessel->save();
            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {

                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.vessels.path'), $filename, "public_uploads_vessels_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->vessel_id = $vessel->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.vessels.path'), $filename, "public_uploads_vessels_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->vessel_id = $vessel->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }

            $vessel->claim_id = $vessel->claim->id;
            $vessel->nature_of_damage = $vessel->natureOfDamage;
            $vessel->companie = $vessel->companie;

            $vessel->shipping_line = $vessel->shippingLine;

            return [
                "payload" => $vessel,
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

            $vessel = Vessel::find($request->id);
            if (!$vessel) {
                return [
                    "payload" => "The searched row does not exist !",
                    "status" => "404_3"
                ];
            }

            $vessel->vessel_number = $request->vessel_number;
            $vessel->name = $request->name;
            $vessel->deductible_charge_TAT = $request->deductible_charge_TAT;
            $vessel->concerned_internal_department = $request->concerned_internal_department;
            $vessel->vessel_number = $request->vessel_number;
            $vessel->cause_damage = $request->cause_damage;
            $vessel->damage_description = $request->damage_description;
            $vessel->Liability_letter_number = $request->Liability_letter_number;
            $vessel->amount = $request->amount;
            $vessel->currency = $request->currency;
            $vessel->comment_third_party = $request->comment_third_party;
            $vessel->reinvoiced = $request->reinvoiced;
            $vessel->currency_Insurance = $request->currency_Insurance;
            $vessel->Invoice_number = $request->Invoice_number;
            $vessel->date_of_reimbursement = $request->date_of_reimbursement;
            $vessel->reimbursed_amount = $request->reimbursed_amount;
            $vessel->date_of_declaration = $request->date_of_declaration;
            $vessel->date_of_feedback = $request->date_of_feedback;
            $vessel->comment_Insurance = $request->comment_Insurance;
            $vessel->Indemnification_of_insurer = $request->Indemnification_of_insurer;
            $vessel->Indemnification_date = $request->Indemnification_date;
            $vessel->currency_indemnisation = $request->currency_indemnisation;
            $vessel->deductible_charge_TAT = $request->deductible_charge_TAT;
            $vessel->damage_caused_by = $request->damage_caused_by;
            $vessel->comment_nature_of_damage = $request->comment_nature_of_damage;
            $vessel->TAT_name_persons = $request->TAT_name_persons;
            $vessel->outsourcer_company_name = $request->outsourcer_company_name;
            $vessel->outsourcer_persons = $request->outsourcer_persons;
            $vessel->thirdparty_company_name = $request->thirdparty_company_name;
            $vessel->thirdparty_Activity_comments = $request->thirdparty_Activity_comments;
            $vessel->thirdparty_persons = $request->thirdparty_persons;
            $vessel->incident_report = $request->incident_report;
            $vessel->liability_letter = $request->liability_letter;
            $vessel->insurance_declaration = $request->insurance_declaration;
            $vessel->major = $request->major ? 1 : 0;
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)

                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('vessels')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $vessel->id)
                    ->update(['major' => 0]);
            }
            if ($request->nature_of_damage["id"] == 0 || $request->nature_of_damage["id"] == null ||  $request->nature_of_damage["id"] == "undefined") {
                if ($request->nature_of_damage["name"] != null || $request->nature_of_damage["name"] != "") {
                    $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndSave($request->nature_of_damage);
                    if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $nature_of_damage_returnedValue["payload"],
                            "status" => $nature_of_damage_returnedValue["status"]
                        ];
                    }
                    $vessel->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $vessel->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
                    ];
                }
            }



            if ($request->shipping_line["id"] == 0 || $request->shipping_line["id"] == null || $request->shipping_line["id"] == "undefined") {
                if ($request->shipping_line["name"] != null || $request->shipping_line["name"] != "") {
                    $shipping_line_returnedValue = $this->shipping_line_confirmAndSave($request->shipping_line);
                    if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $shipping_line_returnedValue["payload"],
                            "status" => $shipping_line_returnedValue["status"]
                        ];
                    }
                    $vessel->shipping_line_id = $shipping_line_returnedValue["payload"]->id;
                }
            } else {
                $shipping_line_returnedValue = $this->shipping_line_confirmAndUpdate($request->shipping_line);
                $vessel->shipping_line_id = $request->shipping_line["id"];
                if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $shipping_line_returnedValue["payload"],
                        "status" => $shipping_line_returnedValue["status"]
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
                    $vessel->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $vessel->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
                    ];
                }
            }

            $vessel->save();

            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {

                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.vessels.path'), $filename, "public_uploads_vessels_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->vessel_id = $vessel->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.vessels.path'), $filename, "public_uploads_vessels_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->vessel_id = $vessel->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }
            // delete files
            if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
                for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                    $LiabilityInsuranceFile = LiabilityInsuranceFiles::find($request["filesDelete"][$i]["id"]);
                    $this->deleteOne(config('cdn.vessels.path'), $LiabilityInsuranceFile->filename);
                    $LiabilityInsuranceFile->delete();
                }
            }
            $vessel->claim_id = $vessel->claim->id;
            $vessel->nature_of_damage = $vessel->natureOfDamage;
            $vessel->companie = $vessel->companie;
            $vessel->shipping_line = $vessel->shippingLine;

            return [
                "payload" => $vessel,
                "status" => "200"
            ];
        }
    }
    public function index($claim_id)
    {
        $vessel = Vessel::select()->where('claim_id', $claim_id)
            ->with("shippingLine")
            ->with("companie")
            ->with("natureOfDamage")
            ->with("department")
            ->with("estimate")
            ->with("estimate.otherValuation")
            ->get();

        for ($j = 0; $j < count($vessel); $j++) {
            $calculated = false;
            $totalAmount = 0;
            $currency = "";
            $AmountCustomedField = 0;
            for ($i = count($vessel[$j]->estimate) - 1; $i >= 0; $i--) {
                // dd($vessel[$j]->estimate[$i]->otherValuation);
                if (!$calculated) {
                    for ($d = 0; $d < count($vessel[$j]->estimate[$i]->otherValuation); $d++) {
                        $AmountCustomedField += $vessel[$j]->estimate[$i]->otherValuation[$d]->value_valuation;
                    }
                    $totalAmount += $AmountCustomedField;
                    $calculated = true;
                    $currency = $vessel[$j]->estimate[$i]->currency_estimate;
                }
            }

            $vessel[$j]->estimationAmount = $totalAmount . " (" . $currency . ")";
        }

        return [
            "payload" => $vessel,
            "status" => "200_1"
        ];
    }
    public function delete(Request $request)
    {
        $vessel = Vessel::find($request->id);
        if (!$vessel) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $vessel->delete();
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
        $natureOfDamage->categorie = "vessel";

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
                "payload" => "nature Of Damage is not exist !",
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
    public function shipping_line_confirmAndSave($shipping_line)
    {
        $validator = Validator::make($shipping_line, [
            "name" => "required:shipping_lines,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        if (ShippingLine::select()->where("name", $shipping_line['name'])->count() > 0) {
            return [
                "payload" => "This shippingline name is already existed !",
                "status" => "406_3",
                "IsReturnErrorRespone" => true
            ];
        }
        $shipping_line = ShippingLine::make($shipping_line);
        $shipping_line->save();

        return [
            "payload" => $shipping_line,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
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
        $companie->categorie = "vessel";

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
    public function shipping_line_confirmAndUpdate($shipping_line)
    {
        $shipping_line = ShippingLine::find($shipping_line['id']);
        if (!$shipping_line) {
            return [
                "payload" => "shipping_line is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($shipping_line) {
            //  $shipping_line->name=$Type_of_equipment['name'];
            $shipping_line->save();
            return [
                "payload" => $shipping_line,
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
    public function type_of_equipment_confirmAndSave($Type_of_equipment)
    {
        $validator = Validator::make($Type_of_equipment, [
            //"name" => "required:type_of_vessels,name",
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
    public function getIncidentReportsFilePath()
    {
        return [
            "payload" => asset("/storage/cdn/vessels/incident_report"),
            "status" => "200_1"
        ];
    }
}

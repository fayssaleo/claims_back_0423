<?php

namespace App\Modules\Container\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libs\UploadTrait;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Claim\Models\Claim;
use App\Modules\Container\Models\Container;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\ShippingLine\Models\ShippingLine;
use App\Modules\Company\Models\Company;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;
use App\Modules\Vessel\Models\Vessel;
use Illuminate\Support\Facades\DB;
use PhpParser\Error;

class ContainerController extends Controller
{
    use UploadTrait;

    public function createOrUpdateContainer(Request $request)
    {

        if ($request->id == 0 || $request->id == null || $request->id == "undefined") {


            $claim = null;
            if ($request->claim_id == 0 || $request->claim_id == null ||  $request->claim_id == "undefined") {
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
            $container = Container::make($request->all());
            $container->major = $request->major ? 1 : 0;
            $container->claim_id = $claim->id;
            if ($request->nature_of_damage["id"] == 0 || $request->nature_of_damage["id"] == null || $request->nature_of_damage["id"] == "undefined") {
                if ($request->nature_of_damage["name"] != null || $request->nature_of_damage["name"] != "") {
                    $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndSave($request->nature_of_damage);
                    if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $nature_of_damage_returnedValue["payload"],
                            "status" => $nature_of_damage_returnedValue["status"]
                        ];
                    }
                    $container->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $container->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
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
                    $container->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $container->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
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
                    $container->shipping_line_id = $shipping_line_returnedValue["payload"]->id;
                }
            } else {
                $shipping_line_returnedValue = $this->shipping_line_confirmAndUpdate($request->shipping_line);
                $container->shipping_line_id = $request->shipping_line["id"];
                if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $shipping_line_returnedValue["payload"],
                        "status" => $shipping_line_returnedValue["status"]
                    ];
                }
            }
            $container->save();
            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {
                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.containers.path'), $filename, "public_uploads_containers_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->container_id = $container->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.containers.path'), $filename, "public_uploads_containers_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->container_id = $container->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }
            $container->claim_id = $container->claim->id;
            $container->nature_of_damage = $container->natureOfDamage;
            $container->companie = $container->companie;
            $container->shipping_line = $container->shippingLine;
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $container->id)
                    ->update(['major' => 0]);
                DB::table('vessels')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
            }
            return [
                "payload" => $container,
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
            $container = Container::find($request->id);
            if (!$container) {
                return [
                    "payload" => "The searched row does not exist !",
                    "status" => "404_3"
                ];
            }
            $container->name = $request->name;
            $container->containerType = $request->containerType;
            $container->containerID = $request->containerID;
            $container->marchandise = $request->marchandise;
            $container->marchandise_nature = $request->marchandise_nature;
            $container->marchandise_type = $request->marchandise_type;
            $container->deductible_charge_TAT = $request->deductible_charge_TAT;
            $container->categorie_of_container = $request->categorie_of_container;
            $container->status = $request->status;
            $container->concerned_internal_department = $request->concerned_internal_department;
            $container->damage_description = $request->damage_description;
            $container->cause_damage = $request->cause_damage;
            $container->Liability_letter_number = $request->Liability_letter_number;
            $container->amount = $request->amount;
            $container->currency = $request->currency;
            $container->comment_third_party = $request->comment_third_party;
            $container->reinvoiced = $request->reinvoiced;
            $container->currency_Insurance = $request->currency_Insurance;
            $container->Invoice_number = $request->Invoice_number;
            $container->date_of_reimbursement = $request->date_of_reimbursement;
            $container->reimbursed_amount = $request->reimbursed_amount;
            $container->date_of_declaration = $request->date_of_declaration;
            $container->date_of_feedback = $request->date_of_feedback;
            $container->comment_Insurance = $request->comment_Insurance;
            $container->Indemnification_of_insurer = $request->Indemnification_of_insurer;
            $container->Indemnification_date = $request->Indemnification_date;
            $container->currency_indemnisation = $request->currency_indemnisation;
            $container->deductible_charge_TAT = $request->deductible_charge_TAT;
            $container->damage_caused_by = $request->damage_caused_by;
            $container->comment_nature_of_damage = $request->comment_nature_of_damage;
            $container->TAT_name_persons = $request->TAT_name_persons;
            $container->outsourcer_company_name = $request->outsourcer_company_name;
            $container->outsourcer_persons = $request->outsourcer_persons;
            $container->thirdparty_company_name = $request->thirdparty_company_name;
            $container->thirdparty_Activity_comments = $request->thirdparty_Activity_comments;
            $container->thirdparty_persons = $request->thirdparty_persons;
            $container->liability_letter = $request->liability_letter;
            $container->insurance_declaration = $request->insurance_declaration;
            $container->major = $request->major ? 1 : 0;
            if ($request->major) {
                DB::table('equipment')
                    ->where('claim_id', $request->claim_id)

                    ->update(['major' => 0]);
                DB::table('automobiles')
                    ->where('claim_id', $request->claim_id)
                    ->update(['major' => 0]);
                DB::table('containers')
                    ->where('claim_id', $request->claim_id)
                    ->where('id', '<>', $container->id)
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
                    $container->nature_of_damage_id = $nature_of_damage_returnedValue["payload"]->id;
                }
            } else {
                $nature_of_damage_returnedValue = $this->nature_of_damage_confirmAndUpdate($request->nature_of_damage);
                $container->nature_of_damage_id = $request->nature_of_damage["id"];

                if ($nature_of_damage_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $nature_of_damage_returnedValue["payload"],
                        "status" => $nature_of_damage_returnedValue["status"]
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
                    $container->shipping_line_id = $shipping_line_returnedValue["payload"]->id;
                }
            } else {
                $shipping_line_returnedValue = $this->shipping_line_confirmAndUpdate($request->shipping_line);
                $container->shipping_line_id = $request->shipping_line["id"];

                if ($shipping_line_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $shipping_line_returnedValue["payload"],
                        "status" => $shipping_line_returnedValue["status"]
                    ];
                }
            }
            if ($request->companie["id"] == 0 || $request->companie["id"] == null ||   $request->companie["id"] == "undefined") {
                if ($request->companie["name"] != null || $request->companie["name"] != "") {
                    $companie_returnedValue = $this->companie_confirmAndSave($request->companie);

                    if ($companie_returnedValue["IsReturnErrorRespone"]) {
                        return [
                            "payload" => $companie_returnedValue["payload"],
                            "status" => $companie_returnedValue["status"]
                        ];
                    }
                    $container->companie_id = $companie_returnedValue["payload"]->id;
                }
            } else {
                $companie_returnedValue = $this->companie_confirmAndUpdate($request->companie);
                $container->companie_id = $request->companie["id"];
                if ($companie_returnedValue["IsReturnErrorRespone"]) {
                    return [
                        "payload" => $companie_returnedValue["payload"],
                        "status" => $companie_returnedValue["status"]
                    ];
                }
            }
            $container->save();
            if ($request->file()) {
                if (!empty($request["liability_letter_files"]) && $request["liability_letter_files"] != null) {

                    for ($i = 0; $i < count($request["liability_letter_files"]); $i++) {
                        $file = $request["liability_letter_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.containers.path'), $filename, "public_uploads_containers_liability_letter");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "liability";
                        $LiabilityInsuranceFile->container_id = $container->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
                if (!empty($request["insurance_declaration_files"]) && $request["insurance_declaration_files"] != null) {

                    for ($i = 0; $i < count($request["insurance_declaration_files"]); $i++) {
                        $file = $request["insurance_declaration_files"][$i];
                        $filename = time() . "_" . $file->getClientOriginalName();
                        $this->uploadOne($file, config('cdn.containers.path'), $filename, "public_uploads_containers_insurance_declaration");
                        $LiabilityInsuranceFile = new LiabilityInsuranceFiles();
                        $LiabilityInsuranceFile->filename = $filename;
                        $LiabilityInsuranceFile->type = "insurance";
                        $LiabilityInsuranceFile->container_id = $container->id;
                        $LiabilityInsuranceFile->save();
                    }
                }
            }
            // delete files
            if (!empty($request["LiabilityInsuranceFilesDelete"]) && $request["filesDelete"] != null) {
                for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                    $LiabilityInsuranceFile = LiabilityInsuranceFiles::find($request["filesDelete"][$i]["id"]);
                    $this->deleteOne(config('cdn.containers.path'), $LiabilityInsuranceFile->filename);
                    $LiabilityInsuranceFile->delete();
                }
            }
            $container->claim_id = $container->claim->id;
            $container->nature_of_damage = $container->natureOfDamage;
            $container->companie = $container->companie;
            $container->shipping_line = $container->shippingLine;
            return [
                "payload" => $container,
                "status" => "200"
            ];
        }
    }

    public function index($claim_id)
    {
        $container = Container::select()->where('claim_id', $claim_id)
            ->with("shippingLine")
            ->with("natureOfDamage")
            ->with("companie")
            ->with("department")
            ->with("estimate")
            ->with("estimate.otherValuation")
            ->get();

        for ($j = 0; $j < count($container); $j++) {
            $calculated = false;
            $totalAmount = 0;
            $currency = "";
            $AmountCustomedField = 0;
            for ($i = count($container[$j]->estimate) - 1; $i >= 0; $i--) {
                // dd($container[$j]->estimate[$i]->otherValuation);
                if (!$calculated) {
                    for ($d = 0; $d < count($container[$j]->estimate[$i]->otherValuation); $d++) {
                        $AmountCustomedField += $container[$j]->estimate[$i]->otherValuation[$d]->value_valuation;
                    }
                    $totalAmount += $AmountCustomedField;
                    $calculated = true;
                    $currency = $container[$j]->estimate[$i]->currency_estimate;
                }
            }

            $container[$j]->estimationAmount = $totalAmount . " (" . $currency . ")";
        }



        return [
            "payload" => $container,
            "status" => "200_1"
        ];
    }



    public function delete(Request $request)
    {
        $container = Container::find($request->id);
        if (!$container) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $container->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

    public function nature_of_damage_confirmAndSave($NatureOfDamage)
    {
        $validator = Validator::make($NatureOfDamage, [
            "name" => "required:nature_of_damage,name",
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
        $natureOfDamage->categorie = "container";

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
                "payload" => "natureOfDamage is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($natureOfDamage) {
            // $natureOfDamage->name=$NatureOfDamage['name'];

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
        $companie->categorie = "container";

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
}

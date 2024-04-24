<?php

namespace App\Modules\Estimate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Modules\Estimate\Models\Estimate;
use \stdClass;
use App\Libs\UploadTrait;
use App\Modules\CustomedField\Models\CustomedField;
use App\Modules\EstimateFile\Models\EstimateFile;
use App\Modules\OtherValuation\Models\OtherValuation;

class EstimateController extends Controller
{

    use UploadTrait;


    public function indexEquipment($id)
    {
        $estimtesWithAmount = collect([]);
        $estimate = Estimate::select()
            ->where('equipment_id', "=", $id)
            ->with("otherValuation")
            ->with("estimateFile")
            ->get();
        $amount = 0;

        for ($i = 0; $i < count($estimate); $i++) {
            $amount = 0;

            $otherValuationsByEstimateID = OtherValuation::select()->where('estimate_id', $estimate[$i]->id)
                ->get();

            for ($j = 0; $j < count($otherValuationsByEstimateID); $j++) {


                $amount = $otherValuationsByEstimateID[$j]["value_valuation"] + $amount;
            }

            $EstimateModel = new stdClass();

            $EstimateModel->estimate = $estimate[$i];
            $EstimateModel->estimate_amount = $amount;

            $estimtesWithAmount->push($EstimateModel);
        }

        return [
            "payload" => $estimtesWithAmount,
            "status" => "200_00"
        ];
    }
    public function indexContainer($id)
    {
        $estimtesWithAmount = collect([]);
        $estimate = Estimate::select()
            ->where('container_id', "=", $id)
            ->with("otherValuation")
            ->with("estimateFile")
            ->get();
        $amount = 0;

        for ($i = 0; $i < count($estimate); $i++) {
            $amount = 0;
            $otherValuationsByEstimateID = OtherValuation::select()->where('estimate_id', $estimate[$i]->id)
                ->get();
            for ($j = 0; $j < count($otherValuationsByEstimateID); $j++) {


                $amount = $otherValuationsByEstimateID[$j]["value_valuation"] + $amount;
            }

            $EstimateModel = new stdClass();
            $EstimateModel->estimate = $estimate[$i];
            $EstimateModel->estimate_amount =  $amount;

            $estimtesWithAmount->push($EstimateModel);
        }

        return [
            "payload" => $estimtesWithAmount,
            "status" => "200_00"
        ];
    }
    public function indexAutomobile($id)
    {
        $estimtesWithAmount = collect([]);
        $estimate = Estimate::select()
            ->where('automobile_id', "=", $id)
            ->with("otherValuation")
            ->with("estimateFile")
            ->get();
        $amount = 0;
        for ($i = 0; $i < count($estimate); $i++) {
            $amount = 0;
            $otherValuationsByEstimateID = OtherValuation::select()->where('estimate_id', $estimate[$i]->id)
                ->get();
            for ($j = 0; $j < count($otherValuationsByEstimateID); $j++) {


                $amount = $otherValuationsByEstimateID[$j]["value_valuation"] + $amount;
            }
            $EstimateModel = new stdClass();
            $EstimateModel->estimate = $estimate[$i];
            $EstimateModel->estimate_amount = $amount;

            $estimtesWithAmount->push($EstimateModel);
        }

        return [
            "payload" => $estimtesWithAmount,
            "status" => "200_00"
        ];
    }
    public function indexVessel($id)
    {
        $estimtesWithAmount = collect([]);
        $estimate = Estimate::select()
            ->where('vessel_id', "=", $id)
            ->with("otherValuation")
            ->with("estimateFile")
            ->get();
        $amount = 0;

        for ($i = 0; $i < count($estimate); $i++) {
            $amount = 0;
            $otherValuationsByEstimateID = OtherValuation::select()->where('estimate_id', $estimate[$i]->id)
                ->get();
            for ($j = 0; $j < count($otherValuationsByEstimateID); $j++) {


                $amount = $otherValuationsByEstimateID[$j]["value_valuation"] + $amount;
            }

            $EstimateModel = new stdClass();

            $EstimateModel->estimate = $estimate[$i];
            $EstimateModel->estimate_amount = $amount;

            $estimtesWithAmount->push($EstimateModel);
        }

        return [
            "payload" => $estimtesWithAmount,
            "status" => "200_00"
        ];
    }
    public function getCustomedFieldByEstimate($id)
    {
        $customedField = CustomedField::select()
            ->where('estimate_id', "=", $id)
            ->get();
        if (!$customedField) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        } else {
            return [
                "payload" => $customedField,
                "status" => "200_1"
            ];
        }
    }
    public function get($id)
    {
        $estimate = Estimate::find($id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        } else {
            return [
                "payload" => $estimate,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate = Estimate::make($request->all());
        //if (!empty($request->file) || $request->file != null || $request->file != "update" ) {
        $estimate->save();
        if ($request->file()) {
            for ($i = 0; $i < count($request["files"]); $i++) {
                $file = $request["files"][$i];
                $filename = time() . "_" . $file->getClientOriginalName();
                $this->uploadOne($file, config('cdn.fileEstimates.path'), $filename, 'public_uploads_fileEstimates');
                $estimateFile = new EstimateFile();
                $estimateFile->filename = $filename;
                $estimateFile->estimate_id = $estimate->id;
                $estimateFile->save();
            }
        }

        $estimate->otherValuations = [];
        $dataotherValuations = [];
        $amount = 0;

        if (!empty($request->otherValuations)) {
            for ($i = 0; $i < count($request->otherValuations); $i++) {


                $otherValuation = OtherValuation::make($request->otherValuations[$i]);
                $otherValuation->estimate_id = $estimate->id;

                $otherValuation->save();

                array_push($dataotherValuations, $otherValuation);

                $amount = $request->otherValuations[$i]["value_valuation"];
            }
        }
        $estimate->otherValuations = $dataotherValuations;
        $EstimateModel = new stdClass();


        $EstimateModel->estimate = $estimate;
        $EstimateModel->estimate_amount = $amount;

        //  dd($EstimateModel);

        return [
            "payload" => $EstimateModel,
            "status" => "200"
        ];
    }

    public function sendEstimateFileStoragePath()
    {
        return [
            "payload" => asset("/storage/cdn/fileEstimates/"),
            "status" => "200_1"
        ];
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate = Estimate::find($request->id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $estimate->temporary_or_permanent = $request->temporary_or_permanent;
        $estimate->currency_estimate = $request->currency_estimate;
        $estimate->equipment_id = $request->equipment_id;
        $estimate->created_at = $estimate->created_at;
        $estimate->updated_at = $estimate->updated_at;


        $amount = 0;

        //add other files
        if (!empty($request["files"]) && $request["files"] != null) {
            if ($request["files"] != "create") {
                for ($i = 0; $i < count($request["files"]); $i++) {
                    $file = $request["files"][$i];
                    $filename = time() . "_" . $file->getClientOriginalName();
                    $this->uploadOne($file, config('cdn.fileEstimates.path'), $filename, 'public_uploads_fileEstimates');
                    $estimateFile = new EstimateFile();
                    $estimateFile->filename = $filename;
                    $estimateFile->estimate_id = $estimate->id;
                    $estimateFile->save();
                }
            }
        }
        // delete files
        if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
            for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                $estimateFile = EstimateFile::find($request["filesDelete"][$i]["id"]);
                $this->deleteOne(config('cdn.fileEstimates.path'), $estimateFile->filename);
                $estimateFile->delete();
            }
        }




        $otherValuationsByEstimateID = OtherValuation::select()->where('estimate_id', $estimate->id)
            ->get();
        // delete otherValuations
        if (!empty($request->deleteInputs)) {
            for ($i = 0; $i < count($request->deleteInputs); $i++) {
                $otherValuationToDelete = OtherValuation::find($request->deleteInputs[$i]["id"]);
                $otherValuationToDelete->delete();
            }
        }

        // add or update otherValuations

        if (!empty($request->otherValuations)) {
            for ($j = 0; $j < count($request->otherValuations); $j++) {
                $amount = 0;
                // add new otherValuations if id == 0
                if ($request->otherValuations[$j]["id"] == 0) {

                    $otherValuation = OtherValuation::make($request->otherValuations[$j]);
                    $otherValuation->estimate_id = $estimate->id;

                    $otherValuation->save();
                    $amount = $request->otherValuations[$j]["value_valuation"] + $amount;
                } else {
                    $otherValuation = OtherValuation::find($request->otherValuations[$j]["id"]);
                    $otherValuation->name = $request->otherValuations[$j]["name"];
                    $otherValuation->currency = $request->otherValuations[$j]["currency"];
                    $otherValuation->value = $request->otherValuations[$j]["value"];
                    $otherValuation->taux_change = $request->otherValuations[$j]["taux_change"];
                    $otherValuation->value_valuation = $request->otherValuations[$j]["value_valuation"];
                    $otherValuation->save();
                }
            }
        }

        $estimate->save();
        $estimate->otherValuations = OtherValuation::select()->where('estimate_id', $estimate->id)
            ->get();
        $estimate->estimate_file = EstimateFile::select()->where('estimate_id', $estimate->id)
            ->get();

        $EstimateModel = new stdClass();
        $EstimateModel->estimate = $estimate;
        $EstimateModel->estimate_amount = $amount;





        return [
            "payload" => $EstimateModel,
            "otherValuationsByEstimateID" => $otherValuationsByEstimateID,
            "request->deleteInputs" => $request->deleteInputs,
            "status" => "200_00"
        ];
    }

    public function updateContainer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate = Estimate::find($request->id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $estimate->temporary_or_permanent = $request->temporary_or_permanent;
        $estimate->currency_estimate = $request->currency_estimate;
        $estimate->container_id = $request->container_id;
        $estimate->created_at = $estimate->created_at;
        $estimate->updated_at = $estimate->updated_at;


        $amount = 0;

        if (!empty($request["files"]) && $request["files"] != null) {
            if ($request["files"] != "create") {
                for ($i = 0; $i < count($request["files"]); $i++) {
                    $file = $request["files"][$i];
                    $filename = time() . "_" . $file->getClientOriginalName();
                    $this->uploadOne($file, config('cdn.fileEstimates.path'), $filename, 'public_uploads_fileEstimates');
                    $estimateFile = new EstimateFile();
                    $estimateFile->filename = $filename;
                    $estimateFile->estimate_id = $estimate->id;
                    $estimateFile->save();
                }
            }
        }
        if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
            for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                $estimateFile = EstimateFile::find($request["filesDelete"][$i]["id"]);
                $this->deleteOne(config('cdn.fileEstimates.path'), $estimateFile->filename);
                $estimateFile->delete();
            }
        }



        // dd($estimate);

        // delete CustomedField

        $customedFieldsByEstimateID = CustomedField::select()->where('estimate_id', $estimate->id)
            ->get();
        // delete otherValuations
        if (!empty($request->deleteInputs)) {
            for ($i = 0; $i < count($request->deleteInputs); $i++) {
                $otherValuationToDelete = OtherValuation::find($request->deleteInputs[$i]["id"]);
                $otherValuationToDelete->delete();
            }
        }

        // add or update otherValuations

        if (!empty($request->otherValuations)) {
            for ($j = 0; $j < count($request->otherValuations); $j++) {
                $amount = 0;
                // add new otherValuations if id == 0
                if ($request->otherValuations[$j]["id"] == 0) {

                    $otherValuation = OtherValuation::make($request->otherValuations[$j]);
                    $otherValuation->estimate_id = $estimate->id;

                    $otherValuation->save();
                    $amount = $request->otherValuations[$j]["value_valuation"] + $amount;
                } else {
                    $otherValuation = OtherValuation::find($request->otherValuations[$j]["id"]);
                    $otherValuation->name = $request->otherValuations[$j]["name"];
                    $otherValuation->currency = $request->otherValuations[$j]["currency"];
                    $otherValuation->value = $request->otherValuations[$j]["value"];
                    $otherValuation->taux_change = $request->otherValuations[$j]["taux_change"];
                    $otherValuation->value_valuation = $request->otherValuations[$j]["value_valuation"];
                    $otherValuation->save();
                }
            }
        }
        $estimate->save();
        $estimate->otherValuations = OtherValuation::select()->where('estimate_id', $estimate->id)
            ->get();
        $estimate->estimate_file = EstimateFile::select()->where('estimate_id', $estimate->id)
            ->get();

        $EstimateModel = new stdClass();
        $EstimateModel->estimate = $estimate;
        $EstimateModel->estimate_amount = $amount;





        return [
            "payload" => $EstimateModel,
            "customedFieldsByEstimateID" => $customedFieldsByEstimateID,
            "request->deleteInputs" => $request->deleteInputs,
            "status" => "200_00"
        ];
    }

    public function updateAutomobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate = Estimate::find($request->id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $estimate->temporary_or_permanent = $request->temporary_or_permanent;
        $estimate->currency_estimate = $request->currency_estimate;
        $estimate->automobile_id = $request->automobile_id;
        $estimate->created_at = $estimate->created_at;
        $estimate->updated_at = $estimate->updated_at;


        $amount = 0;

        if (!empty($request["files"]) && $request["files"] != null) {
            if ($request["files"] != "create") {
                for ($i = 0; $i < count($request["files"]); $i++) {
                    $file = $request["files"][$i];
                    $filename = time() . "_" . $file->getClientOriginalName();
                    $this->uploadOne($file, config('cdn.fileEstimates.path'), $filename, 'public_uploads_fileEstimates');
                    $estimateFile = new EstimateFile();
                    $estimateFile->filename = $filename;
                    $estimateFile->estimate_id = $estimate->id;
                    $estimateFile->save();
                }
            }
        }
        if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
            for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                $estimateFile = EstimateFile::find($request["filesDelete"][$i]["id"]);
                $this->deleteOne(config('cdn.fileEstimates.path'), $estimateFile->filename);
                $estimateFile->delete();
            }
        }


        // dd($estimate);

        // delete CustomedField

        $customedFieldsByEstimateID = CustomedField::select()->where('estimate_id', $estimate->id)
            ->get();
        // delete otherValuations
        if (!empty($request->deleteInputs)) {
            for ($i = 0; $i < count($request->deleteInputs); $i++) {
                $otherValuationToDelete = OtherValuation::find($request->deleteInputs[$i]["id"]);
                $otherValuationToDelete->delete();
            }
        }

        // add or update otherValuations

        if (!empty($request->otherValuations)) {
            for ($j = 0; $j < count($request->otherValuations); $j++) {
                $amount = 0;
                // add new otherValuations if id == 0
                if ($request->otherValuations[$j]["id"] == 0) {

                    $otherValuation = OtherValuation::make($request->otherValuations[$j]);
                    $otherValuation->estimate_id = $estimate->id;

                    $otherValuation->save();
                    $amount = $request->otherValuations[$j]["value_valuation"] + $amount;
                } else {
                    $otherValuation = OtherValuation::find($request->otherValuations[$j]["id"]);
                    $otherValuation->name = $request->otherValuations[$j]["name"];
                    $otherValuation->currency = $request->otherValuations[$j]["currency"];
                    $otherValuation->value = $request->otherValuations[$j]["value"];
                    $otherValuation->taux_change = $request->otherValuations[$j]["taux_change"];
                    $otherValuation->value_valuation = $request->otherValuations[$j]["value_valuation"];
                    $otherValuation->save();
                }
            }
        }
        $estimate->save();
        $estimate->otherValuations = OtherValuation::select()->where('estimate_id', $estimate->id)
            ->get();
        $estimate->estimate_file = EstimateFile::select()->where('estimate_id', $estimate->id)
            ->get();

        $EstimateModel = new stdClass();
        $EstimateModel->estimate = $estimate;
        $EstimateModel->estimate_amount = $amount;





        return [
            "payload" => $EstimateModel,
            "customedFieldsByEstimateID" => $customedFieldsByEstimateID,
            "request->deleteInputs" => $request->deleteInputs,
            "status" => "200_00"
        ];
    }
    public function updateVessel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $estimate = Estimate::find($request->id);
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $estimate->temporary_or_permanent = $request->temporary_or_permanent;
        $estimate->currency_estimate = $request->currency_estimate;
        $estimate->vessel_id = $request->vessel_id;
        $estimate->created_at = $estimate->created_at;
        $estimate->updated_at = $estimate->updated_at;


        $amount = 0;

        if (!empty($request["files"]) && $request["files"] != null) {
            if ($request["files"] != "create") {
                for ($i = 0; $i < count($request["files"]); $i++) {
                    $file = $request["files"][$i];
                    $filename = time() . "_" . $file->getClientOriginalName();
                    $this->uploadOne($file, config('cdn.fileEstimates.path'), $filename, 'public_uploads_fileEstimates');
                    $estimateFile = new EstimateFile();
                    $estimateFile->filename = $filename;
                    $estimateFile->estimate_id = $estimate->id;
                    $estimateFile->save();
                }
            }
        }
        if (!empty($request["filesDelete"]) && $request["filesDelete"] != null) {
            for ($i = 0; $i < count($request["filesDelete"]); $i++) {
                $estimateFile = EstimateFile::find($request["filesDelete"][$i]["id"]);
                $this->deleteOne(config('cdn.fileEstimates.path'), $estimateFile->filename);
                $estimateFile->delete();
            }
        }



        // dd($estimate);

        // delete CustomedField

        $customedFieldsByEstimateID = CustomedField::select()->where('estimate_id', $estimate->id)
            ->get();
        // delete otherValuations
        if (!empty($request->deleteInputs)) {
            for ($i = 0; $i < count($request->deleteInputs); $i++) {
                $otherValuationToDelete = OtherValuation::find($request->deleteInputs[$i]["id"]);
                $otherValuationToDelete->delete();
            }
        }

        // add new otherValuations if id == 0

        // add or update otherValuations

        if (!empty($request->otherValuations)) {
            for ($j = 0; $j < count($request->otherValuations); $j++) {
                $amount = 0;
                // add new otherValuations if id == 0
                if ($request->otherValuations[$j]["id"] == 0) {

                    $otherValuation = OtherValuation::make($request->otherValuations[$j]);
                    $otherValuation->estimate_id = $estimate->id;

                    $otherValuation->save();
                    $amount = $request->otherValuations[$j]["value_valuation"] + $amount;
                } else {
                    $otherValuation = OtherValuation::find($request->otherValuations[$j]["id"]);
                    $otherValuation->name = $request->otherValuations[$j]["name"];
                    $otherValuation->currency = $request->otherValuations[$j]["currency"];
                    $otherValuation->value = $request->otherValuations[$j]["value"];
                    $otherValuation->taux_change = $request->otherValuations[$j]["taux_change"];
                    $otherValuation->value_valuation = $request->otherValuations[$j]["value_valuation"];
                    $otherValuation->save();
                }
            }
        }
        $estimate->save();
        $estimate->otherValuations = OtherValuation::select()->where('estimate_id', $estimate->id)
            ->get();
        $estimate->estimate_file = EstimateFile::select()->where('estimate_id', $estimate->id)
            ->get();

        $EstimateModel = new stdClass();
        $EstimateModel->estimate = $estimate;
        $EstimateModel->estimate_amount = $amount;





        return [
            "payload" => $EstimateModel,
            "customedFieldsByEstimateID" => $customedFieldsByEstimateID,
            "request->deleteInputs" => $request->deleteInputs,
            "status" => "200_00"
        ];
    }
    public function delete(Request $request)
    {
        $estimate = Estimate::find($request->id);

        if (!empty($request->customedFields)) {
            for ($i = 0; $i < count($request->customedFields); $i++) {

                $customedField = CustomedField::find($request->customedFields[$i]);
                $customedField->delete();
            }
        }
        if (!$estimate) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $estimate->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }


    public function otherValuation_confirmAndSave($OtherValuation)
    {
        $validator = Validator::make($OtherValuation, [
            //"name" => "required:brands,name",
        ]);

        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }

        $otherValuation = OtherValuation::make($OtherValuation);

        $otherValuation->save();

        return [
            "payload" => $otherValuation,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function otherValuation_confirmAndUpdate($OtherValuation)
    {
        $otherValuation = OtherValuation::find($OtherValuation['id']);
        if (!$otherValuation) {
            return [
                "payload" => "brand is not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        } else if ($otherValuation) {
            //$brand->name=$Brand['name'];
            $otherValuation->save();
            return [
                "payload" => $otherValuation,
                "status" => "200",
                "IsReturnErrorRespone" => false
            ];
        }
    }
}

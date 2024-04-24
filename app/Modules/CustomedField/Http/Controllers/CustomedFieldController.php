<?php

namespace App\Modules\CustomedField\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\CustomedField\Models\CustomedField;

class CustomedFieldController extends Controller
{

    public function index(){

        $customedFields=CustomedField::all();

        return [
            "payload" => $customedFields,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $customedFields=CustomedField::find($id);
        if(!$customedFields){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $customedFields,
                "status" => "200_1"
            ];
        }
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string:customed_fields,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $customedField=CustomedField::make($request->all());
        $customedField->save();
        return [
            "payload" => $customedField,
            "status" => "200"
        ];
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $customedField=CustomedField::find($request->id);
        if (!$customedField) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$customedField->name){
            if(CustomedField::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The customedFields has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $customedField->name=$request->name;

        $customedField->save();
        return [
            "payload" => $customedField,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $customedField=CustomedField::find($request->id);
        if(!$customedField){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $customedField->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

}

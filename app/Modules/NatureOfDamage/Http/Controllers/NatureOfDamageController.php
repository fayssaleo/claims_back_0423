<?php

namespace App\Modules\NatureOfDamage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use Illuminate\Support\Facades\Validator;


class NatureOfDamageController extends Controller
{

    public function index(){

        $natureOfDamage=NatureOfDamage::all();

        return [
            "payload" => $natureOfDamage,
            "status" => "200_00"
        ];
    }

    public function indexEquipment(){

        $natureOfDamage=NatureOfDamage::select()->where('categorie', "equipment")->get();

        return [
            "payload" => $natureOfDamage,
            "status" => "200_00"
        ];
    }
    public function indexAutomobile(){

        $natureOfDamage=NatureOfDamage::select()->where('categorie', "automobile")->get();

        return [
            "payload" => $natureOfDamage,
            "status" => "200_00"
        ];
    }
    public function indexContainer(){

        $natureOfDamage=NatureOfDamage::select()->where('categorie', "container")->get();

        return [
            "payload" => $natureOfDamage,
            "status" => "200_00"
        ];
    }
    public function indexVessel(){

        $natureOfDamage=NatureOfDamage::select()->where('categorie', "vessel")->get();

        return [
            "payload" => $natureOfDamage,
            "status" => "200_00"
        ];
    }
    public function get($id){
        $natureOfDamage=NatureOfDamage::find($id);
        if(!$natureOfDamage){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $natureOfDamage,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required:nature_of_damages,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $natureOfDamage=NatureOfDamage::make($request->all());
        $natureOfDamage->save();
        return [
            "payload" => $natureOfDamage,
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
        $natureOfDamage=NatureOfDamage::find($request->id);
        if (!$natureOfDamage) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$natureOfDamage->name){
            if(NatureOfDamage::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The natureOfDamage has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $natureOfDamage->name=$request->name;

        $natureOfDamage->save();
        return [
            "payload" => $natureOfDamage,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $natureOfDamage=NatureOfDamage::find($request->id);
        if(!$natureOfDamage){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $natureOfDamage->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

}

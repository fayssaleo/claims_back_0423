<?php

namespace App\Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Brand\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{

    public function index(){

        $brand=Brand::all();

        return [
            "payload" => $brand,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $brand=Brand::find($id);
        if(!$brand){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $brand,
                "status" => "200_1"
            ];
        }
    }
    public function indexEquipment(){

        $brand=Brand::select()->where('categorie', "equipment")->get();

        return [
            "payload" => $brand,
            "status" => "200_00"
        ];
    }
    public function indexAutomobile(){

        $brand=Brand::select()->where('categorie', "automobile")->get();

        return [
            "payload" => $brand,
            "status" => "200_00"
        ];
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required:brand,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $brand=Brand::make($request->all());
        $brand->save();
        return [
            "payload" => $brand,
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
        $brand=Brand::find($request->id);
        if (!$brand) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$brand->name){
            if(Brand::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The brand has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $brand->name=$request->name;

        $brand->save();
        return [
            "payload" => $brand,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $brand=Brand::find($request->id);
        if(!$brand){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $brand->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}

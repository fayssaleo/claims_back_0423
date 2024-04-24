<?php

namespace App\Modules\ShippingLine\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ShippingLine\Models\ShippingLine;
use App\Modules\Department\Models\Department;
use Illuminate\Support\Facades\Validator;

class ShippingLineController extends Controller
{
    public function index(){

        $shippingLine=ShippingLine::all();

        return [
            "payload" => $shippingLine,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $shippingLine=ShippingLine::find($id);
        if(!$shippingLine){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $shippingLine->department=$shippingLine->department;
            return [
                "payload" => $shippingLine,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|unique:shippingLine,name",
            "department_id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $department=Department::find($request->department_id);
        if(!$department){
            return [
                "payload"=>"department is not exist !",
                "status"=>"department_404",
            ];
        }
        $shippingLine=ShippingLine::make($request->all());
        $shippingLine->save();
        $shippingLine->department=$shippingLine->department;
        return [
            "payload" => $shippingLine,
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
        $shippingLine=ShippingLine::find($request->id);
        if (!$shippingLine) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->name!=$shippingLine->name){
            if(ShippingLine::where("name",$request->name)->count()>0)
                return [
                    "payload" => "The shippingLine has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $department=Department::find($request->department_id);
        if(!$department){
            return [
                "payload"=>"department is not exist !",
                "status"=>"department_404",
            ];
        }
        $shippingLine->name=$request->name;
        $shippingLine->department_id=$request->department_id;

        $shippingLine->save();
        $shippingLine->department=$shippingLine->department;
        return [
            "payload" => $shippingLine,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $shippingLine=ShippingLine::find($request->id);
        if(!$shippingLine){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $shippingLine->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

}

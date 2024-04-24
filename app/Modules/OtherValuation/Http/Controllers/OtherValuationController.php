<?php

namespace App\Modules\OtherValuation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\OtherValuation\Models\OtherValuation;

class OtherValuationController extends Controller
{

    public function index(){

        $otherValuation=OtherValuation::with('estimate')->get();

        return [
            "payload" => $otherValuation,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $otherValuation=OtherValuation::select()
        ->where('estimate_id', "=", $id)
        ->get();
        if(!$otherValuation){
            return [
                "payload" => [],
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $otherValuation,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }

        $otherValuation=OtherValuation::make($request->all());
        $otherValuation->save();
        return [
            "payload" => $otherValuation,
            "status" => "200"
        ];
    }

}

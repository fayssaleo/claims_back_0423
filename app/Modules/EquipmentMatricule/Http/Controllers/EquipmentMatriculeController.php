<?php

namespace App\Modules\EquipmentMatricule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\EquipmentMatricule\Models\EquipmentMatricule;

class EquipmentMatriculeController extends Controller
{

    public function index($equipment=null){

        $equipmentMatricule=EquipmentMatricule::select()->where("equipment",$equipment)->get();

        return [
            "payload" => $equipmentMatricule,
            "status" => "200_00"
        ];
    }
    public function get($id){

        $equipmentMatricule=EquipmentMatricule::find($id);

        return [
            "payload" => $equipmentMatricule,
            "status" => "200_00"
        ];
    }
}

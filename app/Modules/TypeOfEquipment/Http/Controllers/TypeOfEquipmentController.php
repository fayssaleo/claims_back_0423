<?php

namespace App\Modules\TypeOfEquipment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Brand\Models\Brand;
use App\Modules\Company\Models\Company;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\ShippingLine\Models\ShippingLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;


class TypeOfEquipmentController extends Controller
{
    public function indexAll()
    {

        $typeOfEquipments = TypeOfEquipment::all();
        foreach ($typeOfEquipments as $typeOfEquipment) {
            $typeOfEquipments2 = TypeOfEquipment::where("name", $typeOfEquipment->name)->get();
            $counter = 0;
            $firsttypeOfEquipments2 = $typeOfEquipments2->first();
            foreach ($typeOfEquipments2 as $typeOfEquipment2) {
                if ($counter != 0) {
                    $equipments = $typeOfEquipment2->Equipments;
                    foreach ($equipments as $equipment) {
                        $equipment->type_of_equipment_id = $firsttypeOfEquipments2->id;
                        $equipment->save();
                    }
                    $autos = $typeOfEquipment2->Autos;
                    foreach ($autos as $auto) {
                        $auto->type_of_equipment_id = $firsttypeOfEquipments2->id;
                        $auto->save();
                    }
                    $conatiners = $typeOfEquipment2->Containers;
                    foreach ($conatiners as $conatiner) {
                        $conatiner->type_of_equipment_id = $firsttypeOfEquipments2->id;
                        $conatiner->save();
                    }
                    $typeOfEquipment2->delete();
                } else {
                    $firsttypeOfEquipments2 = $typeOfEquipment2;
                }
                $counter++;
            }
        }


        $natueOfDamages = NatureOfDamage::all();
        foreach ($natueOfDamages as $natueOfDamage) {
            $natueOfDamages2 = NatureOfDamage::where([["name", $natueOfDamage->name], ["categorie", $natueOfDamage->categorie]])->get();
            $counter = 0;
            $firstnatueOfDamages2 = $natueOfDamages2->first();
            foreach ($natueOfDamages2 as $natueOfDamage2) {
                if ($counter != 0) {
                    $equipments = $natueOfDamage2->Equipments;
                    foreach ($equipments as $equipment) {
                        $equipment->nature_of_damage_id = $firstnatueOfDamages2->id;
                        $equipment->save();
                    }
                    $autos = $natueOfDamage2->Autos;
                    foreach ($autos as $auto) {
                        $auto->nature_of_damage_id = $firstnatueOfDamages2->id;
                        $auto->save();
                    }
                    $conatiners = $natueOfDamage2->Containers;
                    foreach ($conatiners as $conatiner) {
                        $conatiner->nature_of_damage_id = $firstnatueOfDamages2->id;
                        $conatiner->save();
                    }
                    $vessels = $natueOfDamage2->Vessels;
                    if ($vessels)
                        foreach ($vessels as $vessel) {
                            $vessel->nature_of_damage_id = $firstnatueOfDamages2->id;
                            $vessel->save();
                        }
                    $natueOfDamage2->delete();
                } else {
                    $firstnatueOfDamages2 = $natueOfDamage2;
                }
                $counter++;
            }
        }


        $brands = Brand::all();
        foreach ($brands as $brand) {
            $brands2 = Brand::where("name", $brand->name)->get();
            $counter = 0;
            $firstbrands2 = $brands2->first();
            foreach ($brands2 as $brand2) {
                if ($counter != 0) {
                    $equipments = $brand2->Equipments;
                    foreach ($equipments as $equipment) {
                        $equipment->brand_id = $firstbrands2->id;
                        $equipment->save();
                    }
                    $autos = $brand2->Autos;
                    foreach ($autos as $auto) {
                        $auto->brand_id = $firstbrands2->id;
                        $auto->save();
                    }
                    $brand2->delete();
                } else {
                    $firstbrands2 = $brand2;
                }
                $counter++;
            }
        }


        $shippingLines = ShippingLine::all();
        foreach ($shippingLines as $shippingLine) {
            $shippingLines2 = ShippingLine::where("name", $shippingLine->name)->get();
            $counter = 0;
            $firstshippingLines2 = $shippingLines2->first();
            foreach ($shippingLines2 as $shippingLine2) {
                if ($counter != 0) {
                    $containers = $shippingLine2->containers;
                    foreach ($containers as $container) {
                        $container->shipping_line_id = $firstshippingLines2->id;
                        $container->save();
                    }
                    $vessels = $shippingLine2->vessels;
                    foreach ($vessels as $vessel) {
                        $vessel->shipping_line_id = $firstshippingLines2->id;
                        $vessel->save();
                    }
                    $shippingLine2->delete();
                } else {
                    $firstshippingLines2 = $shippingLine2;
                }
                $counter++;
            }
        }


        $companys = Company::all();
        foreach ($companys as $company) {
            $companys2 = Company::where([["name", $company->name], ["categorie", $company->categorie]])->get();
            $counter = 0;
            $firstcompanys2 = $companys2->first();
            foreach ($companys2 as $company2) {
                if ($counter != 0) {
                    $equipments = $company2->Equipments;
                    foreach ($equipments as $equipment) {
                        $equipment->companie_id = $firstcompanys2->id;
                        $equipment->save();
                    }
                    $autos = $company2->Autos;
                    foreach ($autos as $auto) {
                        $auto->companie_id = $firstcompanys2->id;
                        $auto->save();
                    }
                    $conatiners = $company2->Containers;
                    foreach ($conatiners as $conatiner) {
                        $conatiner->companie_id = $firstcompanys2->id;
                        $conatiner->save();
                    }
                    $vessels = $company2->Vessels;
                    foreach ($vessels as $vessel) {
                        $vessel->companie_id = $firstcompanys2->id;
                        $vessel->save();
                    }
                    $company2->delete();
                } else {
                    $firstcompanys2 = $company2;
                }
                $counter++;
            }
        }





        return "success";
    }

    public function indexAll2()
    {

        $equipments = Equipment::all();
        foreach ($equipments as $equipment) {
            if ($equipment->reinvoiced == "NO")
                $equipment->reinvoiced = "TO PROCEED";
            else if ($equipment->reinvoiced == "YES")
                $equipment->reinvoiced = "REINVOICED";
            $equipment->save();
        }






        return "success";
    }

    public function index()
    {

        $typeOfEquipment = TypeOfEquipment::all();

        return [
            "payload" => $typeOfEquipment,
            "status" => "200_00"
        ];
    }

    public function indexEquipment()
    {

        $typeOfEquipment = TypeOfEquipment::select()->where('categorie', "equipment")->get();

        return [
            "payload" => $typeOfEquipment,
            "status" => "200_00"
        ];
    }

    public function indexAutomobile()
    {

        $typeOfEquipment = TypeOfEquipment::select()->where('categorie', "automobile")->get();

        return [
            "payload" => $typeOfEquipment,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $typeOfEquipment = TypeOfEquipment::find($id);
        if (!$typeOfEquipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        } else {
            return [
                "payload" => $typeOfEquipment,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required:nature_of_damages,name",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $typeOfEquipment = TypeOfEquipment::make($request->all());
        $typeOfEquipment->save();
        return [
            "payload" => $typeOfEquipment,
            "status" => "200"
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
        $typeOfEquipment = TypeOfEquipment::find($request->id);
        if (!$typeOfEquipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if ($request->name != $typeOfEquipment->name) {
            if (TypeOfEquipment::where("name", $request->name)->count() > 0)
                return [
                    "payload" => "The typeOfEquipment has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $typeOfEquipment->name = $request->name;

        $typeOfEquipment->save();
        return [
            "payload" => $typeOfEquipment,
            "status" => "200"
        ];
    }

    public function delete(Request $request)
    {
        $typeOfEquipment = TypeOfEquipment::find($request->id);

        if (!$typeOfEquipment) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        } else {
            $typeOfEquipment->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}

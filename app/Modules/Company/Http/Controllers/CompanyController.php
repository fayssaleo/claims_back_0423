<?php

namespace App\Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Company\Models\Company;

class CompanyController extends Controller
{

    public function indexEquipment(){

        $company=Company::select()->where('categorie', "equipment")->get();

        return [
            "payload" => $company,
            "status" => "200_00"
        ];
    }
    public function indexAutomobile(){

        $company=Company::select()->where('categorie', "automobile")->get();

        return [
            "payload" => $company,
            "status" => "200_00"
        ];
    }
    public function indexVessel(){

        $company=Company::select()->where('categorie', "vessel")->get();

        return [
            "payload" => $company,
            "status" => "200_00"
        ];
    }
    public function indexContainer(){

        $company=Company::select()->where('categorie', "container")->get();

        return [
            "payload" => $company,
            "status" => "200_00"
        ];
    }
}

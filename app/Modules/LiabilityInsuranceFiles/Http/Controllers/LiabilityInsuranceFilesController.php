<?php

namespace App\Modules\LiabilityInsuranceFiles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\LiabilityInsuranceFiles\Models\LiabilityInsuranceFiles;

class LiabilityInsuranceFilesController extends Controller
{

    public function get(Request $request)
    {
        $claimOrIncidentFile = LiabilityInsuranceFiles::select()->where('equipment_id', $request->equipment_id)
        ->where('type', $request->type)
        ->get();

            return [
                "payload" => $claimOrIncidentFile,
                "status" => "200_1"
            ];

    }
    public function getAutomobile(Request $request)
    {
        $claimOrIncidentFile = LiabilityInsuranceFiles::select()->where('automobile_id', $request->automobile_id)
        ->where('type', $request->type)
        ->get();

            return [
                "payload" => $claimOrIncidentFile,
                "status" => "200_1"
            ];

    }
    public function getContainer(Request $request)
    {
        $claimOrIncidentFile = LiabilityInsuranceFiles::select()->where('container_id', $request->container_id)
        ->where('type', $request->type)
        ->get();

            return [
                "payload" => $claimOrIncidentFile,
                "status" => "200_1"
            ];

    }
    public function getVessel(Request $request)
    {
        $claimOrIncidentFile = LiabilityInsuranceFiles::select()->where('vessel_id', $request->vessel_id)
        ->where('type', $request->type)
        ->get();

            return [
                "payload" => $claimOrIncidentFile,
                "status" => "200_1"
            ];

    }
}

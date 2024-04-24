<?php

namespace App\Modules\ClaimOrIncidentFile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ClaimOrIncidentFile\Models\ClaimOrIncidentFile;

class ClaimOrIncidentFileController extends Controller
{

    public function get($id)
    {
        $claimOrIncidentFile = ClaimOrIncidentFile::select()->where('claim_id', $id)
        ->get();
        if (!$claimOrIncidentFile) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        } else {
            return [
                "payload" => $claimOrIncidentFile,
                "status" => "200_1"
            ];
        }
    }
}

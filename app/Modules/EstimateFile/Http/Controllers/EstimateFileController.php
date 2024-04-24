<?php

namespace App\Modules\EstimateFile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\EstimateFile\Models\EstimateFile;

class EstimateFileController extends Controller
{

    public function get($id)
    {
        $estimateFile = EstimateFile::select()->where('estimate_id', $id)
        ->get();
        if (!$estimateFile) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        } else {
            return [
                "payload" => $estimateFile,
                "status" => "200_1"
            ];
        }
    }
}

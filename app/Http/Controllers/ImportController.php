<?php

namespace App\Http\Controllers;

use App\Imports\CandidatsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new CandidatsImport, $request->file('file'));
    }
}

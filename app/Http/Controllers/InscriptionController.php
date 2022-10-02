<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscriptionController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * 
     * @return json
     */
    public function inscription(Request $request, int $id)
    {
        //uri = api/candidats/{}/inscription?groupe=..
        $groupe = $request->query('groupe');

        Candidat::findOrFail($id)->update(['status' => 1]);
        $candidat = Candidat::findOrFail($id);
        $table = strtolower($candidat->classe)."_models";
        DB::table($table)->insert([
            'annee' => $candidat->anneeCandidature,
            'candidat_id' => $candidat->id,
            'groupe' => $groupe,
        ]); 
        return response()->json([
            'success' => 1,
        ]);       
    }
}

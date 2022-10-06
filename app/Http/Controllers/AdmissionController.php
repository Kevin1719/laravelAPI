<?php

namespace App\Http\Controllers;

use App\Models\L1Model;
use App\Models\L2Model;
use App\Models\L3Model;
use App\Models\M1Model;
use App\Models\M2Model;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     *
     * @return [type]
     */
    public function admis(Request $request,int $id)
    {
        $groupe = $request->query('groupe');
        $candidat = Candidat::where('id',$id)->firstOrFail();

        if($candidat->classe == 'L1') {
            $l1 = L1Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            $candidat->update([
                'classe' => 'L2',
            ]);
            L2Model::create([
                'annee' => $l1->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'L2'){
            $l2 = L2Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            $candidat->update([
                'classe' => 'L3',
            ]);
            L3Model::create([
                'annee' => $l2->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'L3'){
            $l3 = L3Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            $candidat->update([
                'classe' => 'M1',
                'finishL3' => 1,
            ]);
            M1Model::create([
                'annee' => $l3->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'M1'){
            $m1 = M1Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            $candidat->update([
                'classe' => 'M2',
            ]);
            M2Model::create([
                'annee' => $m1->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }else {
            $candidat->update(['finish' => 1]);
            return response()->json(['success' => 1],200);
        }
    }


    /**
     * @param int $id
     *
     * @return [type]
     */
    public function abandon(int $id)
    {
        Candidat::findOrFail($id)->update(['status' => 0, 'abandon' => 1,]);
        $classe = Candidat::findOrFail($id)->classe;
        $table =strtolower($classe).'_models';
        DB::table($table)->where('candidat_id',$id)->update(['status' => 0]);
        return response()->json(['success' => 1], 200);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return [type]
     */
    public function redouble(Request $request, int $id)
    {
        $candidat = Candidat::findOrFail($id);
        $groupe = $request->query('groupe');
        if($candidat->classe == 'L1') {
            $l1 = L1Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            L1Model::create([
                'annee' => $l1->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'L2'){
            $l2 = L2Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            L2Model::create([
                'annee' => $l2->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'L3'){
            $l3 = L3Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            L3Model::create([
                'annee' => $l3->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }elseif($candidat->classe == 'M1'){
            $m1 = M1Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            M1Model::create([
                'annee' => $m1->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);

        }else {
            $m2 = M2Model::where('candidat_id',$id)->orderByDesc('annee')->first();
            M2Model::create([
                'annee' => $m2->annee + 1,
                'candidat_id' => $candidat->id,
                'groupe' => $groupe,
            ]);
            return response()->json(['success' => 1],200);
        }


    }
}

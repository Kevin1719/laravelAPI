<?php

namespace App\Http\Controllers;

use App\Models\L1Model;
use Illuminate\Http\Request;

class L1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $listes = L1Model::all();
        foreach($listes as $liste){
            $data[] = [
                'candidat'=>$liste->candidat,
                'annee' => $liste->anneeUniversitaire,
                'groupe' => $liste->groupe,
                'status' => $liste->status
            ]; 
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\L1Model  $l1Model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, L1Model $l1Model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $candidat = L1Model::where('candidat_id',$id)->firstOrFail();
        ($candidat->delete()) ? $reponse = response()->json(['success' => 1],200) : $reponse = response()->json(['success' => 0],200);
        return $reponse;
    }
}

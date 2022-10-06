<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $nombreGarconTotate = Candidat::where('genre','G')->count();
        $nombreFemmeTotate = Candidat::where('genre','F')->count();
        $annee = date('Y');
        $anneeExist = [];
        $candidats = Candidat::all();
        foreach($candidats as $candidat){
            if(!in_array($candidat->anneeCandidature,$anneeExist)){
                $anneeExist[] = $candidat->anneeCandidature;
            }
        }     
        foreach($anneeExist as $year){
            $data [] = [
                'annee'.$year => [
                    'nombreFemme' => Candidat::where('genre', 'F')->where('anneeCandidature', $year)->count(),
                    'nombreHomme' => Candidat::where('genre', 'G')->where('anneeCandidature', $year)->count(),
                ],
            ];
        }   
        return [
            'nombreDeGarconTotale' => $nombreGarconTotate,
            'nombreDeFilleTotale' => $nombreFemmeTotate,
            'annee' => $anneeExist,
            'nombreParAnnee' => $data,
        ];
    }
}

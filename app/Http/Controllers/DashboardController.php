<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Niv;
use App\Models\Preparatoire;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $year;

    public function index()
    {
        $data = [];
        // $nombreGarconTotate = Candidat::where('genre','G')->count();
        // $nombreFemmeTotate = Candidat::where('genre','F')->count();
        // $annee = date('Y');
        $anneeExist = [];
        $candidats = Candidat::all();
        $preparatoires = Preparatoire::all();
        foreach($candidats as $candidat){
            if(!in_array($candidat->anneeCandidature,$anneeExist)){
                $anneeExist[] = $candidat->anneeCandidature;
            }
        }
        foreach($preparatoires as $preparatoire){
            if(!in_array($preparatoire->annee, $anneeExist)){
                $anneeExist[] = $preparatoire->annee;
            }
        }
        foreach($anneeExist as $year){
            $this->year = $year;
            $data [] = [
                'annee' => [
                    'year' => $year,
                    'nombreCourPrepT' => Preparatoire::where('annee',$year)->count(),
                    // 'nombreCourPrepF' => Pre
                    'nombreInscritT' => Candidat::where('entretien',1)->where('status', '<>', null)->where('anneeCandidature', $year)->count(),
                    'nombreInscritL1' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L1')
                                                    ->count(),
                    'nombreInscritL1Garcon' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'G')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L1')
                                                    ->count(),
                    'nombreInscritL1Femme' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'F')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L1')
                                                    ->count(),

                    'nombreInscritL2' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L2')
                                                    ->count(),
                    'nombreInscritL2Garcon' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'G')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L2')
                                                    ->count(),
                    'nombreInscritL2Femme' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'F')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L2')
                                                    ->count(),

                    'nombreInscritL3' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L3')
                                                    ->count(),
                    'nombreInscritL3Garcon' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'G')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L3')
                                                    ->count(),
                    'nombreInscritL3Femme' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'F')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'L3')
                                                    ->count(),


                    'nombreInscritM1' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M1')
                                                    ->count(),
                    'nombreInscritM1Garcon' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'G')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M1')
                                                    ->count(),
                    'nombreInscritM1Femme' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'F')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M1')
                                                    ->count(),

                    'nombreInscritM2' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M2')
                                                    ->count(),
                    'nombreInscritM2Garcon' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'G')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M2')
                                                    ->count(),
                    'nombreInscritM2Femme' => Candidat::where('entretien',1)
                                                    ->where('status', '<>', null)
                                                    ->where('genre', 'F')
                                                    ->where('anneeCandidature', $year)
                                                    ->where(function ($query){
                                                        $query->select('classe')
                                                            ->from('nivs')
                                                            ->where('annee',$this->year)
                                                            ->whereColumn('candidats.id','nivs.candidat_id');
                                                    },'M2')
                                                    ->count(),
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    'nombreAbondonT' => Candidat::where('abandon' , 1)->where('anneeCandidature', $year)->count(),
                    'nombreAbondonTGarcon' => Candidat::where('abandon' , 1)->where('genre', 'G')->where('anneeCandidature', $year)->count(),
                    'nombreAbondonTFemme' => Candidat::where('abandon' , 1)->where('genre', 'F')->where('anneeCandidature', $year)->count(),
                    'nombreAbondonL1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L1')
                                            ->count(),

                    'nombreAbondonGarconL1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'G')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L1')
                                            ->count(),

                    'nombreAbondonFilleL1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'F')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L1')
                                            ->count(),


                    'nombreAbondonL2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L2')
                                            ->count(),

                    'nombreAbondonGarconL2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'G')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L2')
                                            ->count(),

                    'nombreAbondonFilleL2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'F')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L2')
                                            ->count(),


                    'nombreAbondonL3' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L3')
                                            ->count(),
                    'nombreAbondonGarconL3' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'G')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L3')
                                            ->count(),

                    'nombreAbondonFilleL3' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'F')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'L3')
                                            ->count(),

                    'nombreAbondonM1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M1')
                                            ->count(),

                    'nombreAbondonGarconM1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'G')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M1')
                                            ->count(),

                    'nombreAbondonFilleM1' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'F')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M1')
                                            ->count(),

                    'nombreAbondonM2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M2')
                                            ->count(),
                    'nombreAbondonGarconM2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'G')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M2')
                                            ->count(),

                    'nombreAbondonFilleM2' => Candidat::where('abandon', 1)
                                            ->where('anneeCandidature', $year)
                                            ->where('genre', 'F')
                                            ->where(function ($query){
                                                $query->select('classe')
                                                    ->from('nivs')
                                                    ->where('annee',$this->year)
                                                    ->whereColumn('candidats.id','nivs.candidat_id');
                                                },'M2')
                                            ->count(),
                ],
            ];
        }

        return $data;
    }
}

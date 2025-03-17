<?php

namespace App\Http\Controllers;
use App\Models\SoinEntrain;

class SoinEntrainController extends Controller
{
    /**
     * index
     *
     * affiche les soins des chevaux sur les 30 derniers jours 
     * pas besoin d'avoir la liste de tous les soins existants
     * return  --> passe les informations dans la vue soins.entraineur
     */
    public function index()
    {

        //ici j'utilise l'ORM de Laravel pour prendre la date des soins sur les 30 derniers jours
        //je me connecte avec le modele SoinEntrain 
        $soins = SoinEntrain::where('date_soin', '<=', now())
            ->whereDate('date_soin', '>=', now()->subDays(30))
            ->get();

        return view('soins.entraineur', compact('soins'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\VueCheval;
use Illuminate\Support\Facades\DB;

class ChevalController extends Controller
{
    public function index()
    {
        //recuperation de tous les chevaux depuis la vue "vue_chev" qui se trouve dans le modele VueCheval
        $chevaux = VueCheval::all();

        //envoie les valeurs de chevaux dans ma vue php chevaux/index.blade.php
        return view('chevaux.index', compact('chevaux'));
    }



/**
 * chevauxParRaceEtCompet
 * 
 * requete SQL pour obtenir les chevaux classés par nombre de compétitions
 * ici j'appelle directement ma BDD (DB) pour afficher le fait qu'on puisse faire la requête directement ici mais on peut également
 * utiliser l'ORM de Laravel (requete effectuee dans SoinEntrainController.php)
 * 
 * affiche les informations stockées dans chevauxCompetitions de la requete
 * return  --> passe les informations dans la vue chevaux.compet_chevaux
 */
public function chevauxParRaceEtCompet()
{
      
   
    $chevauxCompetitions = DB::select("
        SELECT c.nom_cheval, COUNT(p.id_cheval) as compet_count
        FROM cheval as c
        LEFT JOIN palmares as p ON c.id_cheval = p.id_cheval
        GROUP BY c.nom_cheval
        ORDER BY compet_count DESC"
    );
        return view('chevaux.compet_chevaux', compact('chevauxCompetitions'));
    }

}

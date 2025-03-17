<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{    
    /**
     * index
     *
     * recuparation des competes avec villes associées
     * return  --> passe les informations dans la vue competitions.index
     */
    public function index()
    {
        $competitions = Competition::with('ville')->get();
        return view('competitions.index', compact('competitions'));
    }

      
    /**
     * cavaliersActifs
     *
     * recupere les cavaliers ayant participes a une competition au cours des 6 derniers mois
     * return  --> passe les informations dans la vue competitions.cav_six_mois
     */
    public function cavaliersActifs()
    {
        $cavaliers = DB::select("SELECT c.prenom_caval, c.nom_caval, co.date_compet
                                  FROM cavalier AS c 
                                  JOIN participe AS p ON c.id_licence = p.id_licence 
                                  JOIN competition AS co ON co.id_compet = p.id_compet 
                                  WHERE DATEDIFF(NOW(), co.date_compet) <= 180");

        return view('competitions.cav_six_mois', compact('cavaliers'));
    }
    
    /**
     * moyenneCompetParCheval
     *
     * affiche vue avec les donnees des competitions pour l'annee selectionnee dans le filtre dans la page resources/views/competitions/moyenne.blade.php
     * @param  mixed $request --> accede aux donnees envoyees par l'utilisateur via une requete HTTP (ici GET)
     * return  --> passe les informations dans la vue competitions.moyenne
     */
    public function moyenneCompetParCheval(Request $request)
    {
        //par defaut l'annee est definie a 2025
        $year = $request->input('year', 2025); 
    
        $stats = DB::select("
            SELECT ch.nom_cheval, COUNT(p.id_compet) AS nombre_competitions
            FROM cheval AS ch
            JOIN palmares AS p ON ch.id_cheval = p.id_cheval
            JOIN competition AS c ON p.id_compet = c.id_compet
            WHERE YEAR(c.date_compet) = :year
            GROUP BY ch.nom_cheval", ['year' => $year]);
    
        return view('competitions.moyenne', compact('stats', 'year'));
    }
    
        
    /**
     * villesVictoires
     *
     * recupere les chevaux qui ont remporte une competition (qui ont le rang 1) et les villes ou ils ont gagne
     * return void --> passe les informations dans la vue competitions.villes_victoires
     */
    public function villesVictoires()
    {
        $villes = DB::select("SELECT ch.nom_cheval, v.nom_ville, COUNT(p.id_cheval) AS nombre_competition 
                               FROM cheval AS ch 
                               JOIN palmares AS p ON p.id_cheval=ch.id_cheval 
                               JOIN competition AS c ON p.id_compet=c.id_compet 
                               JOIN ville AS v ON v.id_ville=c.id_ville 
                               WHERE p.rang=1 
                               GROUP BY v.id_ville, ch.nom_cheval,v.nom_ville");

        return view('competitions.villes_victoires', compact('villes'));
    }

}

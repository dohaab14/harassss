<?php

namespace App\Http\Controllers;

use App\Models\Cavalier;
use Illuminate\Http\Request;

class CavalierController extends Controller
{    
    /**
     * infoCaval
     *
     * affiche les informations du cavlier connecté -- les valeurs stockées dans cavalier de la requete
     * return  --> passe les informations dans la vue cavaliers.info
     */
    public function infoCaval()
    {      
        $user = auth()->user();
        $cavalier = Cavalier::where('id_licence', $user->id_licence)->first(); 
        return view('cavaliers.info', compact('cavalier'));
    }
    
    /**
     * infoCollegues
     *
     * affiche les informations de tous les cavaliers  -- les valeurs stockées dans cavaliers de la requete
     * return   --> passe les informations dans la vue cavaliers.collegues
     */
    public function infoCollegues()
    {
        $cavaliers = Cavalier::all();
        return view('cavaliers.collegues', compact('cavaliers'));
    }

}

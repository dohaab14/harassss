<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palmares;
use App\Models\Cheval;

class PalmaresController extends Controller
{    
    /**
     * index
     *
     * affiche les palmares et trie pas rang ordre croissant
     * return  --> passe les informations dans la vue palmares.index
     */
    public function index()
    {
        $palmares = Palmares::with(['cheval', 'competition'])->orderBy('rang')->get();
        return view('palmares.index', compact('palmares'));
    }

    /**
     * showPalmares
     *
     * affiche les palmares d'un cheval choisi
     * @param  mixed $id_cheval
     * return  --> passe les informations dans la vue palmares.show
     */
    public function showPalmares($id_cheval){

        $cheval = Cheval::findOrFail($id_cheval); //recherche de  l'id du cheval selectionne s'il esxist
        $palmares = Palmares::where('id_cheval', $id_cheval)->get(); //get les palmares qui ont cet id cheval 
        return view('palmares.show', compact('cheval','palmares'));
   
    }
}

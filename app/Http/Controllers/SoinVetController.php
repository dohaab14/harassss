<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoinVet;
use App\Models\Cheval;
use App\Models\Veterinaire;
use Illuminate\Support\Facades\Auth;

class SoinVetController extends Controller
{    
    /**
     * __construct
     * 
     * ce construcuteur permet de verifier une seule fois si l'utilisateur est un veterinaire
     * cela evite que pour chaque fonction on verifie cela 
     * idee proposee par ChatGPT
     * @return void
     */
    public function __construct()
    {
        //on check si l'utilisateur est un veterinaire 
        //si ce n'est pas le cas alors on repart a la page d'accueil
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'veterinaire') {
                return redirect('/home'); 
            }
            return $next($request);
        });
    }
        
    /**
     * index
     *
     * affiche tous les elements se trouvant dans le modele SoinVet
     * return --> passe les informations dans la vue soins.index
     */
    public function index()
    {
        $soins = SoinVet::all();
        return view('soins.index', compact('soins'));
    }

    
    /**
     * soins30j
     * 
     * affiche les soins des chevaux sur les 30 derniers jours 
     * pas besoin d'avoir la liste de tous les soins existants
     * 
     * @param  mixed $request
     * return --> passe les informations dans la vue soins.soins30j
     */
    public function soins30j(Request $request)
    {
        //$soins = SoinVet::all();
        $soins = SoinVet::where('date_soin', '>=', now()->subDays(30))->get();
        return view('soins.soins30j', compact('soins'));
    }


     /**
     * gerer
     *
     * methode qui va afficher le formulaire pour ajouter un soin dans la BD
     * return --> passe les informations dans la vue soins.gerer
     */
    public function gerer()
    {
        $soins = SoinVet::all();
        $chevaux = Cheval::all();
        $veterinaires = Veterinaire::all();
        return view('soins.gerer', compact('soins', 'chevaux', 'veterinaires'));
    }


    /**
     * ajouter
     *
     * methode qui va ajouter un soin dans la BD
     * @param  mixed $request
     * @return void --> retourne a la page des soins generales (soins.index)
     */
    public function ajouter(Request $request)
    {

        //on valide d'abord les donnees 
        $request->validate([
            'id_vet' => 'required|exists:veterinaire,id_vet|string',  //check de l'id_vet existe + force pour que l'id soit un type str
            'id_cheval' => 'required|exists:cheval,id_cheval',  //check de l'id_cheval existe
            'nature_soin' => 'required',
            'date_soin' => 'required|date',
        ]);

        //on recupere les id du cheval et du veterinaire avec ce que l'utilisateur a selectionne dans le formulaire
        $cheval = Cheval::find($request->id_cheval);
        $veterinaire = Veterinaire::find($request->id_vet);


        //on ajoute dans la BD les valeurs prisent du formulaire
        SoinVet::create([
            'id_vet' => $veterinaire->id_vet, 
            'date_soin' => $request->date_soin,
            'nature_soin' => $request->nature_soin,
            'id_cheval' => $cheval->id_cheval,
        ]);

        return redirect()->route('soins.index');

    }


    /**
     * modifier
     *
     * methode qui va afficher le formulaire pour modifier un soin dans la BD
     * @param  mixed $id_soin
     * return --> passe les informations dans la vue soins.modifier
     */
    public function modifier($id_soin)
    {
        $soin = SoinVet::findOrFail($id_soin); //recuperation de  l'id_soin s'il existe

        //on recupere tous les veterinaires et chevaux pour les listes déroulantes
        $veterinaires = Veterinaire::all();
        $chevaux = Cheval::all();

        return view('soins.modifier', compact('soin', 'veterinaires', 'chevaux'));
    }


    /**
     * mettreAJour
     *
     * methode qui va maj les infos d'un soin dans la BD
     * @param  mixed $request
     * @param  mixed $id_soin
     * @return void --> retourne a la page des soins generales (soins.index)
     */
    public function mettreAJour(Request $request, $id_soin)
    {

        //check des valeurs
        $request->validate([
            'id_vet' => 'required|exists:veterinaire,id_vet|string',
            'id_cheval' => 'required|exists:cheval,id_cheval',
            'nature_soin' => 'required',
            'date_soin' => 'required|date',
        ]);

        $soin = SoinVet::findOrFail($id_soin);//recuperation de  l'id_soin s'il existe

        // recuperation des autres id necessaire pour la modification dans la BD, s'ils existent
        $veterinaire = Veterinaire::findOrFail($request->id_vet);
        $cheval = Cheval::findOrFail($request->id_cheval);

        //on met a jour les informations du soin
        $soin->update([
            'id_vet' => $veterinaire->id_vet,
            'id_cheval' => $cheval->id_cheval,
            'date_soin' => $request->date_soin,
            'nature_soin' => $request->nature_soin,
        ]);

        return redirect()->route('soins.index');
    }



        
    /**
     * supprimer
     *
     * fonction de suppression d'un soin dans la BD
     * @param  mixed $id_soin
     * @return void
     */
    public function supprimer($id_soin)
    {

        $soin = SoinVet::findOrFail($id_soin);
        $soin->delete();

        return redirect()->route('soins.index');
    }
}


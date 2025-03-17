<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{    
    /**
     * index
     *
     * affichage de la page : resources/views/home.blade.php
     * return --> passe dans la vue home
     */
    public function index()
    {
        return view('home'); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Conhecimentos;
use App\Uteis;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function showHome(Request $request)
    {
        $uteis = new Uteis();
        $conhecimento = new Conhecimentos();


        $motoristas = $conhecimento->buscaMotoristas();
        $arrayMotoristas = $conhecimento->montaArrayMotoristas($motoristas);

        $placas = $conhecimento->buscaPlacas();
        $arrayPlacas = $conhecimento->montaArrayPlacas($placas);



        return view('principal', compact('arrayMotoristas', 'arrayPlacas'));
    }


}

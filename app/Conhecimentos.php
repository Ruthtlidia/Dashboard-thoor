<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conhecimentos extends Model
{
    protected $table = 'conhecimentos';

    function buscaMotoristas()
    {
        $motorista = Conhecimentos::select('motorista')->distinct()->get('motorista');
        return $motorista;
    }

    function buscaPlacas()
    {
        $placas = Conhecimentos::select('placa')->distinct()->get('placa');
        return $placas;
    }

    function montaArrayMotoristas($motoristas)
    {
        $arrayMotoristas = array();
        $cont = 0;
        foreach($motoristas as $motorista){
            $arrayMotoristas[$cont]['motorista'] = $motorista->motorista;
            $cont++;
        }
        return $arrayMotoristas;
    }

    function montaArrayPlacas($placas)
    {
        $arrayPlacas = array();
        $cont = 0;
        foreach($placas as $placa){
            $arrayPlacas[$cont]['placa'] = $placa->placa;
            $cont++;
        }
        return $arrayPlacas;
    }


}

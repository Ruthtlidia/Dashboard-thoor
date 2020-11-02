<?php

namespace App\Http\Controllers;

use App\Conhecimentos;
use App\Uteis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function App\print_rpre;

class ControllerFiltro extends Controller
{

    function filtrar(Request $request){
        $uteis = new Uteis();

        $conhecimento = new Conhecimentos();

        $motoristas = $request->motorista;
        $placas = $request->placa;
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        if($placas){
            //DB::enableQueryLog(); // Enable query log
            /**
             * Monta array com os valores dos carregamentos
             */
            $cont = 0;
            $contador = 0;
            for($p = 0; $p <= count($placas) - 1; $p++){
                $total = Conhecimentos::select(DB::raw("SUM(valor_frete) as total"))->where('placa', '=', $placas[$p])->whereDate('data_emissao', '>=' ,$dataInicial )->whereDate('data_emissao', '<=' ,$dataFinal)->get();

                if($total[0]['total'] <> NULL){
                    $arrayMotora[$cont] = $total[0]['total'];
                    $cont++;

                    $arrayPlacasResult[$contador] = $placas[$p];
                    $contador++;
                }

            }

            //$quries = DB::getQueryLog();

            // Your Eloquent query executed by using get()


            //dd($quries); exit;

            /**
             * Monta array com os momes motoristas
             */
            $arrayMotoristas = array();
            $cont = 0;
            for($i = 0; $i <= count($arrayPlacasResult) -1; $i++){
                $motoristas = Conhecimentos::select('motorista', 'placa')->distinct()->where('placa', '=', $arrayPlacasResult[$i])->whereDate('data_emissao', '>=' ,$dataInicial)->whereDate('data_emissao', '<=' ,$dataFinal)->get('motorista', 'placa');

                    if(count($motoristas) > 1){
                        for($a = 0; $a <= count($motoristas)-1; $a++){
                            $arrayMotoristas[$cont][0] = $arrayPlacasResult[$i];
                            $nome = explode(' ', $motoristas[$a]['motorista']);
                            $arrayMotoristas[$cont][$a +1] = $nome[0] . ' ' . $nome[1];
                            $arrayMotoristas[$cont][$a +2] = 'R$ ' .  number_format($arrayMotora[$i], 2, ',', '.');
                        }
                        $cont++;
                    }else{
                        $l = 0;
                        $arrayMotoristas[$cont][0] = $arrayPlacasResult[$i];
                        $nome = explode(' ', $motoristas[0]['motorista']);
                        $arrayMotoristas[$cont][$l+1] = $nome[0] . ' ' . $nome[1];
                        $arrayMotoristas[$cont][$l+2] = 'R$ ' . number_format($arrayMotora[$i], 2, ',', '.');
                        $cont++;
                    }


            }
            /***
             * Seta na sessão os valores do filtro para o ajax do grafico acessar pela function teste ps mudar noma da function
             */
            Session::put('motoristas', $arrayMotoristas);
            Session::put('total', $arrayMotora);


            /**
             * Código referente a pesqueisa pelo motora
             *
             */
            // $motoristasPlacas = Conhecimento::select('F_PLACA_VEICULO')->distinct()->where('F_RAZAOSOCIAL_PESSOAM', '=', $motoristas[0])->get('F_PLACA_VEICULO');

            // $arrayPlacas = array();
            // $cont = 0;
            // foreach($motoristasPlacas as $motoristaPlaca){
            //     $arrayPlacas[$cont]['placa'] = $motoristaPlaca->F_PLACA_VEICULO;
            //     $cont++;
            // }
            // $array = array();
            // $cont = 0;
            // for($i = 0; $i <= count($arrayPlacas)-1; $i++){
            //     $resultes = Conhecimento::select(DB::raw("SUM(F_VLR_NF) as total, F_PLACA_VEICULO"))->where([['F_RAZAOSOCIAL_PESSOAM', '=', $motoristas[0]], ['F_PLACA_VEICULO', '=', $arrayPlacas[$i]['placa']]])->groupBy('F_PLACA_VEICULO')->get();

            //      $array[$cont]['total'] = $resultes[0]['total'];
            //      $array[$cont]['placa'] = $resultes[0]['F_PLACA_VEICULO'];
            //      $array[$cont]['motorista'] = $motoristas[0];
            //      $cont++;
            // }
            // $uteis->print_rpre($array);

            //$session = 0;
            //$uteis->print_rpre($arrayPlacas[0]['placa']);
            //$uteis->print_rpre($placas);
            //$uteis->print_rpre($total);
            // $uteis->print_rpre(Session::get('motoristas'));
            // $uteis->print_rpre(Session::get('total'));
            // $uteis->print_rpre($dataInicial);

            $motoristas = $conhecimento->buscaMotoristas();
            $arrayMotoristas = $conhecimento->montaArrayMotoristas($motoristas);

            $placas = $conhecimento->buscaPlacas();
            $arrayPlacas = $conhecimento->montaArrayPlacas($placas);


            return view('principal', compact('arrayMotoristas', 'arrayPlacas'));
        }
        // if($motoristas){

        //     $cont = 0;
        //     $contador = 0;
        //     for($p = 0; $p <= count($motoristas) - 1; $p++){
        //         $total = Conhecimentos::select(DB::raw("SUM(nota_valor) as total"))->where('motorista', '=', $motoristas[$p])->whereDate('data_emissao', '>=' ,$dataInicial )->whereDate('data_emissao', '<=' ,$dataFinal)->get();

        //         if($total[0]['total'] <> NULL){
        //             $arrayMotora[$cont] = $total[0]['total'];
        //             $cont++;

        //             $arrayMotoristaResult[$contador] = $motoristas[$p];
        //             $contador++;
        //         }

        //     }









        //     $arrayMotoristas = array();
        //     $cont = 0;
        //     for($i = 0; $i <= count($arrayMotoristaResult) -1; $i++){
        //         $motoristas = Conhecimentos::select('placa')->distinct()->where('motorista', '=', $arrayMotoristaResult[$i])->whereDate('data_emissao', '>=' ,$dataInicial)->whereDate('data_emissao', '<=' ,$dataFinal)->get('placa');






        //             if(count($motoristas) >= 1){
        //                 for($a = 0; $a <= count($motoristas)-1; $a++){
        //                     $arrayMotoristas[$cont][0] = $arrayMotoristaResult[$i];
        //                     //print_rpre($motoristas[$a]['placa']);exit;
        //                     $nome = $motoristas[$a]['placa'];
        //                     $arrayMotoristas[$cont][$a +1] = $nome;
        //                     $arrayMotoristas[$cont][$a +2] = 'R$ ' .  number_format($arrayMotora[$i], 2, ',', '.');
        //                 }
        //                 $cont++;
        //             }else{
        //                 $l = 0;
        //                 $arrayMotoristas[$cont][0] = $arrayMotoristaResult[$i];

        //                 $nome = explode(' ', $motoristas[0]['motorista']);
        //                 $arrayMotoristas[$cont][$l+1] = $nome[0] . ' ' . $nome[1];
        //                 $arrayMotoristas[$cont][$l+2] = 'R$ ' . number_format($arrayMotora[$i], 2, ',', '.');
        //                 $cont++;
        //             }


        //     }



        //     Session::put('motoristas', $arrayMotoristas);
        //     Session::put('total', $arrayMotora);


        //     $motoristas = $conhecimento->buscaMotoristas();
        //     $arrayMotoristas = $conhecimento->montaArrayMotoristas($motoristas);

        //     $placas = $conhecimento->buscaPlacas();
        //     $arrayPlacas = $conhecimento->montaArrayPlacas($placas);


        //     return view('principal', compact('arrayMotoristas', 'arrayPlacas'));

        // }


    }

    function teste()
    {
        //$teste = 'entro e vvoltrou';

        // $teste = array("Daniel Gomes", "João Pereira", "Lucas Dornelas", "Samara Albernaz", "Israel Tome", "Teste Albernaz", "Beluga");
        // $valores = array(1000.50, 100.00, 2000, 300.00, 400.00, 500.00, 600.00);
        $teste = Session::get('motoristas');
        $valores = Session::get('total');

        $retorno = [
                'teste' => $teste,
                'valores' =>$valores,
            ];
        return $retorno;
    }
}

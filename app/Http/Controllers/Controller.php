<?php

namespace App\Http\Controllers;

use App\Conhecimentos;
use App\Uteis;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function App\print_rpre;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function showHome(Request $request)
    {
        $uteis = new Uteis();
        $conhecimento = new Conhecimentos();


        $data_incioa = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_fimb = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
        $DataInicial = date('Y-m-d',$data_incioa);
        $DataFinal = date('Y-m-d',$data_fimb);


        $total = Conhecimentos::select(DB::raw("SUM(valor_frete) as faturamento"))
                                ->whereDate('data_emissao', '>=' ,$DataInicial )
                                ->whereDate('data_emissao', '<=' ,$DataFinal)
                                ->get();

        $arrayFaturamentoMensal = 'R$ ' . number_format($total[0]->faturamento, 2, ',', '.');
        Session::put('faturamento_mensal', $arrayFaturamentoMensal);



        $ano = date('Y-m-d');
        $ano = explode('-', $ano);
        $comecoAno = $ano[0] . '-01' . '-01';
        $dataAtual = date('Y-m-d');



        $totalFaturamentoAnual = Conhecimentos::select(DB::raw("SUM(valor_frete) as faturamento_anual"))
                                            ->whereDate('data_emissao', '>=' ,$comecoAno )
                                            ->whereDate('data_emissao', '<=' ,$dataAtual)
                                            ->get();

        $arrayFaturamentoAnual = 'R$ ' . number_format($totalFaturamentoAnual[0]->faturamento_anual, 2, ',', '.');
        Session::put('faturamento_anual', $arrayFaturamentoAnual);




        $data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
        $DataInicial = date('Y-m-d',$data_incio);
        $DataFinal = date('Y-m-d',$data_fim);


        $totalCarregamentomensal = Conhecimentos::select(DB::raw("SUM(nota_volume) as carregamento_mensal"))
                                    ->whereDate('data_emissao', '>=' ,$DataInicial )
                                    ->whereDate('data_emissao', '<=' ,$DataFinal)
                                    ->get();

        $arrayCarregamentoMensal = 'R$ ' . number_format($totalCarregamentomensal[0]->carregamento_mensal, 2, ',', '.');
        Session::put('carregamento_mensal', $arrayCarregamentoMensal);




        $motoristas = $conhecimento->buscaMotoristas();
        $arrayMotoristas = $conhecimento->montaArrayMotoristas($motoristas);

        $placas = $conhecimento->buscaPlacas();
        $arrayPlacas = $conhecimento->montaArrayPlacas($placas);



        return view('principal', compact('arrayMotoristas', 'arrayPlacas'));
    }


}

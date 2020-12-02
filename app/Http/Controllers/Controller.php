<?php

namespace App\Http\Controllers;

use App\Conhecimentos;
use App\Filtro;
use App\Uteis;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function App\print_rpre;
use function App\comecoMesAtual;
use function App\finalMesAtual;
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


        // /** Quando abrir busca filtro salvo no banco e mostra */
        $filtros = new Filtro();
        $filtros = Filtro::find(1);

        if(Session::get('motoristas') == '' && Session::get('total') == ''){
            if($filtros['tipo_filtro'] == 2){
                Session::put('motoristas', unserialize($filtros['motorista']));
                Session::put('total', unserialize($filtros['total']));
                Session::put('faturamento_frota_motorista', unserialize($filtros['faturamento_frota']));
                Session::put('total_receita_faturamento', unserialize($filtros['total_receita']));
            }
            if($filtros['tipo_filtro'] == 1){
                Session::put('motoristas', unserialize($filtros['motorista']));
                Session::put('total', unserialize($filtros['total']));
                Session::put('total_receita_faturamento', unserialize($filtros['faturamento_frota']));
                Session::put('faturamento_frota', unserialize($filtros['total_receita']));
            }
        }

        //print_rpre($this->desempenhoAnoAnteriorAtual());exit;
        Session::put('declinio', $this->desempenhoAnoAnteriorAtual());

       $this->resultadoDistribuidoras();

        return view('principal', compact('arrayMotoristas', 'arrayPlacas'));
    }


    public function desempenhoAnoAnteriorAtual(){

        $anoAtual = date('Y');
        $anoPassado = $anoAtual - 1;

        $inicialDia = '01';
        $finalDia = '02';

        $mes = '01';
        $mes += 1;

        for($i = 1; $i <= 12; $i++){

            $dataAtualInicio = '"' . $anoAtual . '-' . ($i > 9 ? '' : '0') . $i . '-' .'01' . '"' ;
            $dataAtualFinal = '"' . $anoAtual . '-' . ($i > 9 ? '' : '0') . ($i + 1) . '-' . '01' . '"' ;


            $dataAnteriorInicio = '"' . $anoPassado . '-' . ($i > 9 ? '' : '0') . $i . '-' .'01' . '"' ;
            if($i == 12){
                $indice = 11;
                $dataAnteriorFinal = '"' . $anoPassado . '-' . ($i > 9 ? '' : '0') . ($indice + 1) . '-' . '01' . '"' ;
            }else{
                $dataAnteriorFinal = '"' . $anoPassado . '-' . ($i > 9 ? '' : '0') . ($i + 1) . '-' . '01' . '"' ;
            }


            //$dataPassada = '"' . $anoPassado . '-' . '0' . $i . '-' . $inicialDia . '"' ;

            $totalCarregamentoMesAnoAtual = Conhecimentos::select(DB::raw("SUM(valor_frete) as carregamento_mensal"))
                                                            ->whereDate('data_emissao', '>=' ,json_decode($dataAtualInicio))
                                                            ->whereDate('data_emissao', '<=' ,json_decode($dataAtualFinal))
                                                            ->get();

            $totalCarregamentoMesAnoPassado = Conhecimentos::select(DB::raw("SUM(valor_frete) as carregamento_mensal"))
                                                            ->whereDate('data_emissao', '>=' ,json_decode($dataAnteriorInicio))
                                                            ->whereDate('data_emissao', '<=' ,json_decode($dataAnteriorFinal))
                                                            ->get();

             //print_rpre($dataAnteriorFinal);
            // print_rpre($totalCarregamentoMesAnoPassado[0]->carregamento_mensal);

            $desempenho[$i]['mes_anterior'] = $this->retornoMesAno($i);
            $desempenho[$i]['valor_mes_anterior'] = $totalCarregamentoMesAnoPassado[0]->carregamento_mensal;


            $desempenho[$i]['mes_atual'] = $this->retornoMesAno($i);
            $desempenho[$i]['valor_mes_atual'] = $totalCarregamentoMesAnoAtual[0]->carregamento_mensal;

            $desempenho[$i]['total_meses'] = $totalCarregamentoMesAnoPassado[0]->carregamento_mensal - $totalCarregamentoMesAnoAtual[0]->carregamento_mensal;

            if($totalCarregamentoMesAnoPassado[0]->carregamento_mensal > 0){
                $desempenho[$i]['percentual'] =  ($totalCarregamentoMesAnoPassado[0]->carregamento_mensal - $totalCarregamentoMesAnoAtual[0]->carregamento_mensal) / $totalCarregamentoMesAnoPassado[0]->carregamento_mensal;
            }

        }

        $totalMesAnoPassado = 0;
        for($i = 1; $i < count($desempenho); $i++){
            $totalMesAnoPassado += $desempenho[$i]['valor_mes_anterior'];
        }
        Session::put('totalMesAnoPassado', $totalMesAnoPassado);

        $totalMesAnoAtual = 0;
        for($i = 1; $i < count($desempenho); $i++){
            $totalMesAnoAtual += $desempenho[$i]['valor_mes_atual'];
        }
        Session::put('totalMesAnoAtual', $totalMesAnoAtual);

        $totalGeralCrescimentoDeclinio = 0;
        for($i = 1; $i < count($desempenho); $i++){
            $totalGeralCrescimentoDeclinio += $desempenho[$i]['total_meses'];
        }
        Session::put('totalGeralCrescimentoDeclinio', $totalGeralCrescimentoDeclinio);

        $totalMediaPercentual = 0;
        for($i = 1; $i < count($desempenho); $i++){
            $totalMediaPercentual += isset($desempenho[$i]['percentual']);
        }
        $totalMediaPercentual = $totalMediaPercentual / 12;

        Session::put('totalMediaPercentual', $totalMediaPercentual);


        return $desempenho;
    }

    public function resultadoDistribuidoras(){

        $tomadores = $this->tomadores();

        $totalFaturamentoMes = $this->totalMesVenda();

        $informacoesTabela = array();

        for($i = 0; $i < count($tomadores); $i++){
            $total = Conhecimentos::select(DB::raw("SUM(valor_frete) as total"))
                                    ->where('tomador', '=', $tomadores[$i])
                                    ->whereDate('data_emissao', '>=' , comecoMesAtual())
                                    ->whereDate('data_emissao', '<=' , finalMesAtual())
                                    ->get();

            $informacoesTabela[$i]['tomador'] =  $tomadores[$i]['tomador'];
            $informacoesTabela[$i]['total_faturado_mes'] =  number_format($total[0]['total'], 2, ',', '.');
            $percentual = $total[0]['total'] / $totalFaturamentoMes * 100;
            $informacoesTabela[$i]['percentual'] =  number_format($percentual, 2, ',', '.');


        }
        Session::put('informacoesTabela', $informacoesTabela);
        Session::put('totalFaturamentoMes', number_format($totalFaturamentoMes, 2, ',', '.'));
    }


    public function totalMesVenda(){



        $faturamentoTotal = Conhecimentos::select(DB::raw("SUM(valor_frete) as total"))
                                                ->whereDate('data_emissao', '>=' ,comecoMesAtual())
                                                ->whereDate('data_emissao', '<=' ,finalMesAtual())
                                                ->get();
        return $faturamentoTotal[0]['total'];
    }

    public function tomadores(){


        $tomadores = Conhecimentos::select('tomador')
                                        ->distinct()
                                        ->whereDate('data_emissao', '>=' ,comecoMesAtual())
                                        ->whereDate('data_emissao', '<=' ,finalMesAtual())
                                        ->get('tomador');

        $todosTomadores = array();
        $i = 0;
        foreach($tomadores as $value){
            $todosTomadores[$i]['tomador'] = $value['tomador'];
            $i++;
        }

        return $todosTomadores;
    }


    public function retornoMesAno($i){
        switch($i){
            case 1:
                return 'Janeiro';
            break;
            case 2:
                return 'Fevereiro';
            break;
            case 3:
                return 'Março';
            break;
            case 4:
                return 'Abril';
            break;
            case 5:
                return 'Maio';
            break;
            case 6:
                return 'Junho';
            break;
            case 7:
                return 'Julho';
            break;
            case 8:
                return 'Agosto';
            break;
            case 9:
                return 'Setembro';
            break;
            case 10:
                return 'Outubro';
            break;
            case 11:
                return 'Novembro';
            break;
            case 12:
                return 'Dezembro';
            break;

        }
    }


}

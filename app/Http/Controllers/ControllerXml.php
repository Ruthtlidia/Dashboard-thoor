<?php

namespace App\Http\Controllers;

use App\Conhecimentos;
use Illuminate\Http\Request;
use App\Uteis;
use Illuminate\Support\Facades\DB;
use function App\print_rpre;

class ControllerXml extends Controller
{
    public function salvarXml(Request $request){
        $uteis = new Uteis();

        $files = $request->file('arquivo');
        $fp = fopen($files, "r");

        $arquivo = array();
        $i = 0;
        while(!feof($fp)){
            if($linha = fgets($fp)){
                if($linha != ''){
                    $arquivo[$i]['linha'] = $linha;
                    $i++;
                }
            }
        }

        $arquivoFormatado = array();
        $contador = 0;
        for($i = 0; $i < count($arquivo); $i++){
            $linhaExplodida = explode(';', $arquivo[$i]['linha']);
            if(count($linhaExplodida) > 1){
                $arquivoFormatado[$contador] = $linhaExplodida;
                $contador++;
            }

        }
        for($i = 0; $i < count($arquivoFormatado); $i++){

            $existeCte = Conhecimentos::where('numero_cte', '=', $arquivoFormatado[$i][0])->get();

            if(!isset($existeCte[0]->numero_cte)){
                $conhecimentos = new Conhecimentos();
                $conhecimentos->numero_cte = $arquivoFormatado[$i][0];
                $conhecimentos->nota_fiscal = $arquivoFormatado[$i][1];
                $conhecimentos->nota_valor = $arquivoFormatado[$i][2];
                $conhecimentos->nota_volume = $arquivoFormatado[$i][3];
                $conhecimentos->nota_peso = $arquivoFormatado[$i][4];
                $conhecimentos->valor_frete = $arquivoFormatado[$i][5];
                $conhecimentos->data_emissao = $arquivoFormatado[$i][6];
                $conhecimentos->tomador = $arquivoFormatado[$i][7];
                $conhecimentos->remetente = $arquivoFormatado[$i][8];
                $conhecimentos->destinatario = $arquivoFormatado[$i][9];
                $conhecimentos->motorista = $arquivoFormatado[$i][10];
                $conhecimentos->proprietario = $arquivoFormatado[$i][11];
                $conhecimentos->cidade_origem = $arquivoFormatado[$i][12];
                $conhecimentos->cidade_destino = $arquivoFormatado[$i][13];
                $conhecimentos->situacao = $arquivoFormatado[$i][14];
                $conhecimentos->tipo_cte = $arquivoFormatado[$i][15];
                $conhecimentos->mercadoria = $arquivoFormatado[$i][16];
                $conhecimentos->placa = (isset($arquivoFormatado[$i][17]) ? trim($arquivoFormatado[$i][17]) : '');
                $conhecimentos->save();
            }
        }

        $retorno = [
            'situacao' => 'success',
            'msg' => 'Importação bem sucedida!',
        ];

        return $retorno;

    }

    function deletarTudo(Request $request){

        $flight = Conhecimentos::select()->delete();

        return view('importarXml');
    }

}

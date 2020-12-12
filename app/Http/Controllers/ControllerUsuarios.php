<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Usuarios;
use App\User;
use App\Uteis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function App\print_rpre;

class ControllerUsuarios extends Controller
{
    public function show(Request $request)
    {
        $listaUsuarios = new Usuarios();
        $listaUsuarios = Usuarios::All();

        return view('usuarios', compact('listaUsuarios'));

    }


    public function create(Request $request)
    {
        //$usuario = new Usuarios();
        $usuario = new User();

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $second_password = $request->second_password;
        $nivel_acesso = $request->nivel_acesso;

        $buscarEmail = $this->buscaEmailExiste($email);

        if(isset($buscarEmail[0]['email']) == ''){


            if($this->verificaPasswords($password, $second_password) == true){

                $usuario->name = $name;
                $usuario->email = $email;
                $usuario->password = Hash::make($password);
                $usuario->nivel_acesso = $nivel_acesso;
                $usuario->save();

                $resposta = [
                    'situacao' => 'success',
                    'msg' => 'Usuário cadastrado com sucesso!'
                ];
                return $resposta;

            }else{
                $resposta = [
                    'situacao' => 'warning',
                    'msg' => 'As senhas não conferem!'
                ];
                return $resposta;
            }

        }else{
            $resposta = [
                'situacao' => 'warning',
                'msg' => 'Já existe uma conta com esse email!'
            ];
            return $resposta;
        }
    }

    function buscaEmailExiste($email)
    {
        //$emailUsuario = new Usuarios();
        $usuario = new User();
        $emailUsuario = Usuarios::where('email', '=', $email)->get();

        return $emailUsuario;
    }

    function verificaPasswords($password, $second_password)
    {
        if($password == $second_password){
            return true ;
        }else{
            return false;
        }
    }

    function delete(Request $request){

        //$deletarUsuario = new Usuarios();
        $deletarUsuario = new User();
        $deletarUsuario = Usuarios::find($request->id);

        $deletarUsuario->delete();

        $resposta = [
            'situacao' => 'success',
            'msg' => 'Usuário removido com sucesso!'
        ];
        return $resposta;
    }

    function showEdit(Request $request){

        //$editarUsuario = new Usuarios();
        $editarUsuario = new User();
        $editarUsuario = Usuarios::find($request->id);

        Session::put('id', $editarUsuario['id']);
        Session::put('name', $editarUsuario['name']);
        Session::put('email', $editarUsuario['email']);
        Session::put('nivel_acesso', $editarUsuario['nivel_acesso']);

        $resposta = [
            'situacao' => 'success',
            'msg' => 'Usuário removido com sucesso!'
        ];
        return $resposta;
    }

    function edit(Request $request){

        $editarUsuario = new Usuarios();
        $editarUsuario = Usuarios::find($request->id);


        if($this->verificaPasswords($request->password, $request->second_password) == true){

            $buscarEmail = $this->buscaEmailExiste($request->email);

            if(isset($buscarEmail[0]['id'])){
                $id = $buscarEmail[0]['id'];
            }else{
                $id =$request->id;
            }
            if($id == $request->id){
                $editarUsuario->name = $request->name;
                $editarUsuario->email = $request->email;
                $editarUsuario->password = Hash::make($request->password);
                $editarUsuario->nivel_acesso = $request->nivel_acesso;
                $editarUsuario->save();

                Session::flush('name');
                Session::flush('email');
                Session::flush('nivel_acesso');

                $resposta = [
                    'situacao' => 'success',
                    'msg' => 'Usuário editado com sucesso!'
                ];
                return $resposta;
            }else{
                $resposta = [
                    'situacao' => 'warning',
                    'msg' => 'Já existe uma conta com esse email!'
                ];
                return $resposta;
            }


        }else{
            $resposta = [
                'situacao' => 'warning',
                'msg' => 'Senhas não conferem!'
            ];
            return $resposta;
        }




    }
}

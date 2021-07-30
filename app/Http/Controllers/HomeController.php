<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonagemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Personagens;
use App\Models\Ocupacao;

class HomeController extends Controller
{  
    public function __construct(){
        // Instancia a classe que trata os Personagens:
        $this->personagens = new Personagens;
        $this->ocupacao    = new Ocupacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personagens = $this->personagens->select('id', 'nome', 'img', 'status', 'aniversario')->orderBy('nome')->get();
        foreach($personagens as $i=>$per){
            $ocupacao = $this->ocupacao->select('ocupacao')->where('idPersonagem','=',$per['id'])->get();
            $ocupacao_array = array();
            foreach($ocupacao as $ocu){
                $ocupacao_array[] = $ocu['ocupacao'];
            }
            $ocupacao_line = implode(' | ', $ocupacao_array);
            $personagens[$i]['ocupacao'] = $ocupacao_line;
        }
        return view('home',compact('personagens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $api = collect(Http::get('https://www.breakingbadapi.com/api/characters')->json());
        if(count($api)>0){
            $this->personagens::where('id','>','0')->delete();
            foreach($api as $dados){
                $insert_personagem = array(
                    'nome'=>$dados['name'], 'img'=>$dados['img'], 
                    'status'=>$dados['status'], 'aniversario'=>dataDB($dados['birthday'])
                );
                $id_personagem = $this->personagens::create($insert_personagem)->id;
    
                foreach($dados['occupation'] as $ocupacao){
                    $insert_ocupacao = array('idPersonagem'=>$id_personagem, 'ocupacao'=>$ocupacao);
                    $this->ocupacao::create($insert_ocupacao);
                }
            }  
            $msg = 'Dados Alimentado com sucesso.';
            $cor = 'success';
        }else{
            $msg = 'Erro ao alimentar dados.';
            $cor = 'danger';
        }

        return redirect('/home')->with(['msg'=>$msg, 'cor'=>$cor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personagem = $this->personagens->select('id', 'nome', 'img', 'status', 'aniversario')->where('id','=',$id)->first();
        $ocupacao   = $this->ocupacao->select('ocupacao')->where('idPersonagem','=',$id)->get();
        return view('editar',compact('personagem', 'ocupacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonagemRequest $request, $id)
    {
        if($request->_token){
            $validado = 1;
            if($request->aniversario){
                $validado = validateDate($request->aniversario);
            }
            if($validado == 1){
                $update_personagem = array('status'=>$request->status, 'aniversario'=>$request->aniversario);
                $this->personagens->where('id','=',$id)->update($update_personagem);

                // Atualiza Ocupações:
                $this->ocupacao::where('idPersonagem','=',$id)->delete();
                foreach($request->ocupacao as $ocupacao){
                    if(!empty($ocupacao)){
                        $insert_ocupacao = array('idPersonagem'=>$id, 'ocupacao'=>$ocupacao);
                        $this->ocupacao::create($insert_ocupacao);
                    }
                }

                $msg = "Personagem editado com sucesso!";
                $cor = 'success';
            }else{
                $msg = "Erro ao editar personagem!";
                $cor = 'success';
            }
        }
        return redirect('/home'.'/'.$id.'/edit')->with(['msg'=>$msg, 'cor'=>$cor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->personagens::where('id','=',$id)->delete();
        $msg = 'Personagem apagado com sucesso.';
        $cor = 'success';
        return redirect('/home')->with(['msg'=>$msg, 'cor'=>$cor]);
    }
}

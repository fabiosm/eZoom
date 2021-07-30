@extends('template.template')
@section('conteudo')
    <script>
        function confirmar(){
            var r = confirm('ATENÇÃO! Ao alimentar os dados irá apagar todos os registros atuais.\nTem certeza que deseja continuar com a alimentação dos dados?')
            if(r){
                location.href="{{url('home/create')}}"
            }
        }

        function abrir_img(img){
            varWindow = window.open(img, 'popup',"width=350, height=255, top=100, left=110, scrollbars=no ");
        }

        function confirmar_delete(){
            var r = confirm('Tem certeza que deseja apagar esse personagem?')
            if(r){
               $("#form_delete").submit();
            }            
        }
    </script>
  
    @if(session('msg')) 
        <div class="row">
            <div class="col">
                <br/>
                <div class="alert alert-{{session('cor')}} alert-dismissible fade show" role="alert">    
                    <strong>{!! session('msg') !!}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>	
            </div>
        </div>
    @endif
 
    <div class="row">
        <div class="col-4 p-3">
            <div class="card">
                <div class="card-header">
                    <b>Alimentar dados com personagens de Breaking Bad</b>
                </div>
                <div class="card-body">
                    <a href="javascript:return false;" onClick="confirmar()" class="btn btn-success">Alimentar dados</a>
                </div>
            </div>                       
        </div>
    </div>
    
@if(count($personagens) > 0)
    <div class="row">
        <div class="col p-3">
            <div class="card">
                <div class="card-header">
                    <b>Personagens - Breaking Bad</b>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Imagem</th>
                                <th>Status</th>
                                <th>Aniversário</th>
                                <th>Ocupação</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($personagens as $per)
                            <tr>
                                <td>{{$per['nome']}}</td>
                                <td>
                                    <button onClick="abrir_img('{{$per['img']}}')" class="btn btn-outline-success" alt="{{$per['nome']}}" title="{{$per['nome']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        </svg>
                                    </button>
                                </td>
                                <td>{{$per['status']}}</td>
                                <td>{{ $per['aniversario'] ? date('d/m/Y', strtotime($per['aniversario'])) : '-'}}</td>
                                <td>{{$per['ocupacao']}}</td>
                                <td>
                                    <a href="{{url('/home'.'/'.$per['id'].'/edit')}}" class="btn btn-sm btn-warning">Editar</a>
                                    <button onClick="confirmar_delete();" class="btn btn-sm btn-danger">
                                        Excluir
                                    </button>         
                                    <form action="{{route('home.destroy',$per['id'])}}" method="post" id="form_delete">
                                        @method('DELETE')
                                        @csrf                                  
                                    </form>                                               
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>                       
        </div>
    </div>
@endif
@stop
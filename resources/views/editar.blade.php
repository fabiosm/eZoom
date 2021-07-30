@extends('template.template')
@section('conteudo')
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
                    <b>Personagen - {{$personagem->nome}}</b>
                </div>
                <form action="{{route('home.update', $personagem->id)}}" method="post">
                    @method('PATCH')
                    @csrf         
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <input type="text" class="form-control" id="status" 
                            name="status" value="{{$personagem->status}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="aniversario" class="form-label">Aniversário:</label>
                            <input type="date" class="form-control" id="aniversario" 
                            name="aniversario" value="{{$personagem->aniversario}}">
                        </div>
                        <div class="mb-3">
                            <label for="ocupacao" class="form-label">Ocupações (max. 5):</label>
                        @for($i=0; $i<5; $i++)
                            <input type="text" class="form-control" name="ocupacao[]" 
                            value="{{isset($ocupacao[$i]) ? $ocupacao[$i]->ocupacao : ''}}">
                            <br/>
                        @endfor                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-9">                   
                                <input type="submit" class="btn btn-warning" value="Editar">
                            </div>                    
                            <div class="col-3">
                                <a href="{{url('/home')}}" class="btn btn-info">Voltar</a>
                            </div>   
                        </div>     
                    </div>
                </form>
            </div>                       
        </div>
        <div class="col-4 p-3">      
            <img src="{{$personagem->img}}" class="img-thumbnail rounded" alt="{{$personagem->nome}}">          
        </div>
    </div>
@stop
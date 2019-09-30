@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Compras</div>
        <div class="card-body">     
       
            <form method="POST" action="{{url($data['url'])}}">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label>Selecione o cleinte</label>
                        <select name="compra[cliente_id]" class="form-control">
                        @foreach($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Data</b></label>
                            <input type="date" value="{{old('compra.data', '')}}" name="compra[data]"
                                class="form-control data">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6">

                        <label>Selecione o Item</label>
                        <select class="form-control" name="produto_id"> 
                        @foreach($produtos as $produto)
                        <option value="{{$produto->id}}">{{$produto->nome}}</option>
                        @endforeach
                        </select>

                    </div>

                    <div class="col-2">

                        <label>Quantidade</label>
                        <input type="number" name="quantidade" class="form-control" placeholder="Exp 4">

                    </div>  

                </div>
                
                <input type="submit" value="Salvar" class="btn btn-success mt-3">
            </form>
            </div>
    </div>
</div>
@stop
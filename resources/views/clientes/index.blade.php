@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Clientes</div>
        <div class="card-body">
            <div class="row pb-3 pl-3">
                <a class="btn btn-success" href="{{url('clientes/create')}}">Criar Clientes</a>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th colspan='3'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nome}}</td>
                                <td><a href="{{url('clientes/'.$cliente->id.'/edit')}}" class="btn btn-warning">Editar</td>
                                <td>
                                    <form action="{{url('clientes/'.$cliente->id)}}" method="POST">
                                        {{method_field('DELETE')}}
                                        {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="Desativar"/>
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
@stop
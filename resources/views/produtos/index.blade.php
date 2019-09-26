@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Produtos</div>
        <div class="card-body">
            <div class="row pb-3 pl-3">
                <a class="btn btn-success" href="{{url('produtos/create')}}">Criar Produtos</a>
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
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td><a href="{{url('produtos/'.$produto->id.'/edit')}}" class="btn btn-warning">Editar</td>
                                <td>
                                    <form action="{{url('produtos/'.$produto->id)}}" method="POST">
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
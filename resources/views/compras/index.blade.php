@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Compras</div>
        <div class="card-body">     
            <div class="row pb-3 pl-3">
                <a class="btn btn-success" href="{{url('compras/create')}}">Ir as compras</a>
            </div>
            <div class="row">
                <table class="table text-center table-striped">
                    <thead>
                        <tr>
                            <th><h5>ID</h5></th>
                            <th><h5>NOME</h5></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($compras as  $compra)
                        <tr>
                            <td>{{$compra->id}}</td>
                            <td>{{$compra->Clientes()->first()->nome}}</td>
                        </tr>
                            
                            <br>

                            {{$compra->Produtos()}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
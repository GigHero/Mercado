<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cliente};
use App\Http\Requests\ClienteRequest;
use DB;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        
        $data = [
            'cliente' => '',
            'url' => 'clientes',
            'method' => 'POST',
        ];

        return view('clientes.form', compact('data'));
    }
    /*
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
        DB::beginTransaction();
        try {

            $cliente = Cliente::create([
                'nome' => $request['cliente']['nome']
            ]);
            DB::commit();
            return redirect('clientes')->with('success', 'Cliente cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect('clientes')->with('error', 'Erro no servidor! Cliente não cadastrado!');
        }
   }

   public function edit($id)
   {
       $cliente = Cliente::findOrFail($id);
       $data = [
           'cliente' => $cliente,
           'url' => 'clientes/'.$id,
           'method' => 'PUT',
       ];
       return view('clientes.form', compact('data'));
   }
   
   public function update(Request $request, $id)
   {
       $cliente = Cliente::findOrFail($id);

       DB::beginTransaction();
        try {

            $cliente->update([
                'nome' => $request['cliente']['nome']
            ]);

            DB::commit();
            return redirect('clientes')->with('success', 'Cliente cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect('clientes')->with('error', 'Erro no servidor! Cliente não cadastrado!');
        }
   }

   public function destroy($id)
   {
       $cliente = Cliente::withTrashed()->findOrFail($id);
       if($cliente->trashed()) {
           $cliente->restore();
           return redirect('clientes')->with('success', 'Cliente ativado com sucesso!');
       } else {
           $cliente->delete();
           return redirect('clientes')->with('success', 'Cliente desativado com sucesso!');
       }
   }
}

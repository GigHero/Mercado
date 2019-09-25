<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cliente};
use App\Http\Requests\ClienteRequest;
use DB;

class ClienteController extends Controller
{
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
            return redirect('/')->with('success', 'Cliente cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect('/')->with('error', 'Erro no servidor! Cliente não cadastrado!');
        }
   }
}

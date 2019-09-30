<?php

namespace App\Http\Controllers;
use App\{Produto,Compra,Cliente};
use Illuminate\Http\Request;
use DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $compras = Compra::all();

        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'url' => 'compras',
            'method' => 'POST',
        ];

        $clientes = Cliente::get();
        $produtos = Produto::get();
        return view('compras.form', compact('produtos','clientes','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        DB::beginTransaction();
        try {

            $produto = Produto::findOrFail($request->produto_id);
             
            $compras = Compra::create([
                'data' => $request['compra']['data'],
                'cliente_id' => $request['compra']['cliente_id']
            ]);

            $compras->Produtos()->attach($produto,array('quantidade'=>$request->quantidade));

            DB::commit();
            return view('compras.index')->with('success', 'Produto cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect('compras.index')->with('error', 'Erro no servidor! Produto não cadastrado!');
        }
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

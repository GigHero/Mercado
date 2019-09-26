<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Produto};
use App\Http\Requests\ProdutoRequest;
use DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::get();

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'produto' => '',
            'url' => 'produtos',
            'method' => 'POST',
        ];

        return view('produtos.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $produto = Produto::create([
                'nome' => $request['produto']['nome'],
                'valor' => $request['produto']['valor']
            ]);
            DB::commit();
            return redirect('produtos')->with('success', 'Produto cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect('produtos')->with('error', 'Erro no servidor! Produto não cadastrado!');
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
        $produto = Produto::findOrFail($id);
        $data = [
            'produto' => $produto,
            'url' => 'produtos/'.$id,
            'method' => 'PUT',
        ];
        return view('produtos.form', compact('data'));
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
        $produto = Produto::findOrFail($id);
 
        DB::beginTransaction();
         try {
 
             $produto->update([
                 'nome' => $request['produto']['nome'],
                 'valor' => $request['produto']['valor']
             ]);
 
             DB::commit();
             return redirect('produtos')->with('success', 'Produto cadastrado com sucesso!');
         }
         catch(\Exception $e) {
             DB::rollback();
             return redirect('produtos')->with('error', 'Erro no servidor! Produto não cadastrado!');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::withTrashed()->findOrFail($id);
        if($produto->trashed()) {
            $produto->restore();
            return redirect('produtos')->with('success', 'Produto ativado com sucesso!');
        } else {
            $produto->delete();
            return redirect('produtos')->with('success', 'Produto desativado com sucesso!');
        }
    }
}

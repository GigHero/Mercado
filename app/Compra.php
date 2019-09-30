<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;
    
    protected $table = 'compra';

    protected $fillable = ['data', 'cliente_id'];

    //Relacionamentos
    public function Produtos() {
        return $this->belongsToMany('App\Produto', 'produto_has_compra');
    }
    
    public function Clientes() {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}

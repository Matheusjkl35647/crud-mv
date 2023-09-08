<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class veiculos extends Model
{
    use HasFactory;
    protected $table = 'veiculos';
    protected $primaryKey = 'id';
    protected $fillable = ['categoria_id', 'placa', 'marca', 'modelo', 'descricao', 'anexo', 'custo_aluguel'];
    public $timestamps = true;
}

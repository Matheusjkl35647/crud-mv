<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pessoas extends Model
{
    use HasFactory;
    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'cpf', 'dataNascimento', 'email', 'tpPessoa', 'nvHierarquia'];
    public $timestamps = true;
}

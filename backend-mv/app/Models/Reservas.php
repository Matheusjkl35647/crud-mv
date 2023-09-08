<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $primaryKey = 'id';
    protected $fillable = ['clinte_id', 'veiculo_id', 'data_reserva_de', 'data_reserva_ate', 'reserva_ativa'];
    public $timestamps = true;
}

<?php
/************************************************************
* Nome: Matheus J. Santos                                   *
* Código: API de rotas                                      *
* CRUD-MV: Full Stack                                       *
************************************************************/

use Illuminate\Support\Facades\Route;

//Usuário
Route::post('/usuario/login', ['App\Http\Controllers\UsuarioController'::class, 'login'])->name('usuario.login');
Route::get('/usuario/index', ['App\Http\Controllers\UsuarioController'::class, 'index'])->name('usuario.index');
Route::post('/usuario/incluir', ['App\Http\Controllers\UsuarioController'::class, 'incluir'])->name('usuario.incluir');
Route::get('/usuario/trazUsuario/{id}',  'App\Http\Controllers\UsuarioController@trazUsuario');
Route::put('/usuario/editar/{id}', 'App\Http\Controllers\UsuarioController@editar');
Route::delete('/usuario/excluir/{id}', 'App\Http\Controllers\UsuarioController@excluir');

//Pessoa
Route::get('/pessoa/index', ['App\Http\Controllers\PessoaController'::class, 'index'])->name('pessoa.index');
Route::get('/pessoa/trazPessoa/{id}',  'App\Http\Controllers\PessoaController@trazPessoa');
Route::get('/pessoa/trazPessoaTipo/{cond}',  'App\Http\Controllers\PessoaController@trazPessoaTipo');
Route::get('/pessoa/trazPessoaCliente',  'App\Http\Controllers\PessoaController@trazPessoaCliente');
Route::post('/pessoa/incluir', ['App\Http\Controllers\PessoaController'::class, 'incluir'])->name('pessoa.incluir');
Route::put('/pessoa/editar/{id}', 'App\Http\Controllers\PessoaController@editar');
Route::delete('/pessoa/excluir/{id}', 'App\Http\Controllers\PessoaController@excluir');

// Categoria
Route::get('/categoria/index', ['App\Http\Controllers\CategoriaController'::class, 'index'])->name('categoria.index');
Route::post('/categoria/incluir', ['App\Http\Controllers\CategoriaController'::class, 'incluir'])->name('categoria.incluir');
Route::delete('/categoria/excluir/{id}', 'App\Http\Controllers\CategoriaController@excluir');

// Veículo
Route::get('/veiculo/index', ['App\Http\Controllers\VeiculoController'::class, 'index'])->name('veiculo.index');
Route::post('/veiculo/incluir', ['App\Http\Controllers\VeiculoController'::class, 'incluir'])->name('veiculo.incluir');
Route::post('/veiculo/uploadImagem ', ['App\Http\Controllers\VeiculoController@uploadImagem']);
Route::get('/veiculo/trazVeiculo/{id}',  'App\Http\Controllers\VeiculoController@trazVeiculo');
Route::put('/veiculo/editar/{id}', 'App\Http\Controllers\VeiculoController@editar');
Route::delete('/veiculo/excluir/{id}', 'App\Http\Controllers\VeiculoController@excluir');


// Reserva
Route::get('/reserva/index', ['App\Http\Controllers\ReservaController'::class, 'index'])->name('reserva.index');
Route::post('/reserva/incluir', ['App\Http\Controllers\ReservaController'::class, 'incluir'])->name('reserva.incluir');
Route::patch('/reserva/cancelar/{id}', 'App\Http\Controllers\ReservaController@cancelar');

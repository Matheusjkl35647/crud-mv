<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('usuarios')->count() === 0) {
            // Como a tabela Usuários é dependente da tabela Pessoas, precisamos primeiro criar
            // um cadastro de pessoa e depois gerar um usuário
            DB::table('pessoas')->insertGetId([
                'nome' => 'Matheus J Santos',
                'cpf' => '42485809852',
                'email' => 'matheusjhonathan445@gmail.com',
                'tpPessoa' => 'F', 
                'nvHierarquia' => 1, 
                'dataNascimento' => '2001-03-18'
            ]);

        
            DB::table('usuarios')->insert([
                'nome' => 'admin',
                'tipo' => 'F',
                'email' => 'matheusjhonathan445@gmail.com',
                'pessoa_id' => '1',
                'senha' => Hash::make('admin'),
            ]);
        }
    }
}
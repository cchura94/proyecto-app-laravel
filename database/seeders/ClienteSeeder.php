<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clie = new Cliente;
        $clie->nombres = "Sin Cliente";
        $clie->apellidos = "Sin Datos";
        $clie->ci_nit = "0";
        $clie->save();
    }
}

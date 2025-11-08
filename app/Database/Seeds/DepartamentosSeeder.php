<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    public function run()
    {
        /**
         * llena la tabla
         */
        $data = [
            [
               'nombre' => 'Almacen',
            ],
            [
                'nombre' => 'Contablidad',
            ],
            [
                'nombre' => 'Finanzas',
            ],
            [
                'nombre' => 'Recursos Humanos',
            ],
            [
                'nombre' => 'Sistemas',
            ],
        ];
        $this->db->table('departamentos')->insertBatch($data);
    }
}
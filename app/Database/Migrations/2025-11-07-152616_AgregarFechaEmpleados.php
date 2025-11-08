<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarFechaEmpleados extends Migration
{
    public function up()
    {
        $this->forge->addColumn('empleados', [
            'created_at' => [
                'type' => 'DATETIME',
                'after' => 'id_departamento',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'after' => 'created_at',
            ],
        ]);
    }

    public function down()
    {
        /*
        Nueva manera a partir de codeignither 4.2
        elimina ambas, es mas eficiente y es buena practica
        */
        $this->forge->dropColumn('empleados', ['created_at', 'updated_at']);
        /*Se usa para eliminar fila independiente*/
        // $this->forge->dropColumn('empleados', 'created_at');
        // $this->forge->dropColumn('empleados', 'updated_at');

    
    }
}

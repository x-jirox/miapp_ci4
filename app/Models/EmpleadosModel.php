<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table            = 'empleados';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['clave', 'nombre', 'fecha_nacimiento', 'telefono', 'email', 'id_departamento'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //consultas personalizadas
    public function empleadosDepartamento(){
        return $this->select('empleados.*, departamentos.nombre AS departamento')
        ->join('departamentos', 'empleados.id_departamento = departamentos.id')
        ->findAll();
    }

}

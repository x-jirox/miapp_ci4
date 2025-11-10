<?php

namespace App\Controllers;

use App\Models\DepartamentosModel;
use App\Models\EmpleadosModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;

class Empleados extends BaseController
{

    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
/**
 * -------------------------------------------------------------
 * 📌 Muestra la lista de empleados registrados
 * -------------------------------------------------------------
 * Método: index()
 * Tipo de ruta: GET /empleados
 *
 * Este método se ejecuta cuando el usuario ingresa a la página
 * principal del módulo de empleados.
 *
 * 🔹 Flujo general:
 * 1️⃣ Crea una instancia del modelo EmpleadosModel.
 * 2️⃣ Obtiene todos los registros existentes en la tabla empleados.
 * 3️⃣ Envía esos datos a la vista 'empleados/index' para mostrarlos.
 *
 * ✅ Buenas prácticas:
 * - Este método nunca debe modificar datos, solo mostrarlos.
 * - Si el listado crece mucho, considera usar paginación con:
 *     $empleadosModel->paginate(10);
 * - Usa vistas separadas para mantener el código del controlador limpio.
 *
 * 🚀 Relación con rutas RESTful:
 * `$routes->resource('empleados')` crea automáticamente esta ruta GET /empleados
 * y la asocia a este método `index()`.
 */
public function index()
{
    // 🔹 Crear una instancia del modelo de empleados
    $empleadosModel = new EmpleadosModel();

    // 🔹 Obtener todos los registros desde la base de datos
    //    (usa findAll(), aunque también podrías usar paginate())
    $data['empleados'] = $empleadosModel->findAll();

    // 🔹 Cargar la vista 'empleados/index' y pasarle los datos
    return view('empleados/index', $data);
}


    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
/**
 * -------------------------------------------------------------
 * 📌 Muestra el formulario para crear un nuevo empleado
 * -------------------------------------------------------------
 * Método: new()
 * Tipo de ruta: GET /empleados/new
 *
 * Este método se ejecuta cuando el usuario solicita la página
 * para registrar un nuevo empleado.
 *
 * 1️⃣ Obtiene la lista de departamentos desde la base de datos,
 *     ya que el formulario necesita mostrarlos en un <select>.
 * 2️⃣ Envía esos datos a la vista 'empleados/nuevo'.
 *
 * ✅ Buenas prácticas:
 * - Nunca se hace lógica de guardado aquí (solo mostrar formulario).
 * - Se usa 'findAll()' del modelo porque solo se necesitan los datos.
 */
public function new()
{
    // Crear una instancia del modelo de Departamentos
    $departamentosModel = new DepartamentosModel();

    // Obtener todos los departamentos (para el combo en la vista)
    $data['departamentos'] = $departamentosModel->findAll();

    // Cargar la vista del formulario y enviarle los departamentos
    return view('empleados/nuevo', $data);
}

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */


/*
 * -------------------------------------------------------------
 * 📌 Procesa el formulario y guarda un nuevo empleado en BD
 * -------------------------------------------------------------
 * Método: create()
 * Tipo de ruta: POST /empleados
 *
 * Este método se ejecuta cuando el usuario envía el formulario
 * del empleado nuevo.
 *
 * 🔹 Flujo general:
 * 1️⃣ Define las reglas de validación.
 * 2️⃣ Valida los datos del formulario.
 * 3️⃣ Si hay errores → regresa al formulario con mensajes flash.
 * 4️⃣ Si todo está correcto → inserta el nuevo empleado.
 * 5️⃣ Redirige a la lista de empleados.
 *
 * ✅ Buenas prácticas:
 * - Usar $this->validate() para seguridad y limpieza de datos.
 * - Usar redirect()->back()->withInput() para mantener valores
 *   en el formulario si falla la validación.
 * - Insertar solo campos esperados usando getPost([array]).
 * - Evitar lógica HTML aquí: todo va en la vista.
 */
public function create()
{
    // 🔹 Reglas de validación
    $reglas = [
        'clave' => 'required|min_length[5]|max_length[10]|is_unique[empleados.clave]',
        'nombre' => 'required',
        'fecha_nacimiento' => 'required|valid_date',
        'telefono' => 'required',
        'email' => 'valid_email',
        'departamento' => 'required|is_not_unique[departamentos.id]'
    ];

    // 🔹 Si la validación falla
    if (!$this->validate($reglas)) {
        // Redirigir de nuevo al formulario con los errores y los datos ingresados
        return redirect()->back()
            ->withInput()
            ->with('error', $this->validator->listErrors());
    }

    // 🔹 Obtener los datos enviados del formulario (solo los necesarios)
    $post = $this->request->getPost([
        'clave',
        'nombre',
        'fecha_nacimiento',
        'telefono',
        'email',
        'departamento'
    ]);

    // 🔹 Crear una instancia del modelo de empleados
    $empleadosModel = new EmpleadosModel();

    // 🔹 Insertar el nuevo registro en la base de datos
    $empleadosModel->insert([
        'clave' => trim($post['clave']),
        'nombre' => trim($post['nombre']),
        'fecha_nacimiento' => $post['fecha_nacimiento'],
        'telefono' => $post['telefono'],
        'email' => $post['email'],
        'id_departamento' => $post['departamento']
    ]);

    // 🔹 Redirigir al listado de empleados (ruta principal)
    return redirect()->to('empleados');
}

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}

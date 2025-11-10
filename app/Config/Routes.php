<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * -------------------------------------------------------------
 * 📌 Definición de rutas para el controlador Empleados
 * -------------------------------------------------------------
 * En CodeIgniter 4 puedes definir rutas manualmente o usar 
 * `$routes->resource()` para generar automáticamente todas 
 * las rutas RESTful (CRUD) de un recurso.
 *
 * ✅ Usa `$routes->resource()` cuando tu controlador siga el
 *    patrón CRUD clásico o estés creando una API REST.
 *
 * ❌ Usa rutas manuales (`$routes->get`, `$routes->post`, etc.)
 *    cuando necesites endpoints personalizados, como /login o /export.
 */

// 🔹 Ejemplo de rutas manuales (comentadas porque `resource()` ya las genera)
// $routes->get('/empleados', 'Empleados::index');   // Listar empleados
// $routes->get('/empleados/new', 'Empleados::new'); // Mostrar formulario nuevo empleado

/**
 * 🔹 Ruta RESTful automática:
 * Genera todas las rutas básicas del CRUD para el controlador Empleados.
 * 
 * Por defecto creará rutas como:
 *   GET    /empleados             → Empleados::index
 *   GET    /empleados/new         → Empleados::new
 *   POST   /empleados             → Empleados::create
 *   GET    /empleados/(:num)/edit → Empleados::edit/$1
 *   PUT    /empleados/(:num)      → Empleados::update/$1
 *   DELETE /empleados/(:num)      → Empleados::delete/$1
 *
 * Parámetros:
 * - 'placeholder' => '(:num)'
 *     → obliga a que el ID del empleado sea numérico.
 *
 * - 'except' => 'show'
 *     → excluye la ruta GET /empleados/(:num) → Empleados::show($id)
 *       (por ejemplo, si no necesitas mostrar un solo registro).
 */
$routes->resource('empleados', [
    'placeholder' => '(:num)',
    'except' => 'show'
]);
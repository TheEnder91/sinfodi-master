<?php

use App\Http\Controllers\Admin\PermissionsController;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesAController;
use App\Http\Controllers\Estimulos\LineamientosController;
use App\Http\Controllers\Estimulos\ObjetivosController;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Permisos para el catalogo de roles */
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['index']], ['slug' => 'Listar roles', 'description' => 'A user can list roles.']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['create']], ['slug' => 'Crear rol', 'description' => 'A user can create rol.']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['show']], ['slug' => 'Ver rol', 'description' => 'A user can see role.']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['edit']], ['slug' => 'Editar rol', 'description' => 'A user can edit role.']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['destroy']], ['slug' => 'Eliminar rol', 'description' => 'A user can delete role.']);
        /** Permisos para el catalogo de usuarios */
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['index']], ['slug' => 'Listar usuarios', 'description' => 'A user can list users.']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']], ['slug' => 'Ver usuario', 'description' => 'A user can see user.']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']], ['slug' => 'Editar usuario', 'description' => 'A user can edit user.']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['destroy']], ['slug' => 'Eliminar usaurio', 'description' => 'A user can delete user.']);
        /** Permisos para el catalogo de permisos */
        Permission::updateOrCreate(['name' => PermissionsController::PERMISSIONS['index']], ['slug' => 'Listar permisos', 'description' => 'A user can list permissions.']);
        /** Permisos para el catalogo de objetivos */
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['index']], ['slug' => 'Listar objetivos', 'description' => 'A user can list objectives']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['create']], ['slug' => 'Crear objetivo', 'description' => 'A user can create objective']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['show']], ['slug' => 'Ver objetivo', 'description' => 'A user can see objective']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['edit']], ['slug' => 'Editar objetivo', 'description' => 'A user can edit objective']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['delete']], ['slug' => 'Eliminar objetivo', 'description' => 'A user can delete objective']);
        /** Permiso para ver los lineamientos de estimulos... */
        Permission::updateOrCreate(['name' => LineamientosController::PERMISSIONS['index']], ['slug' => 'Ver lineamientos(PDF)', 'description' => 'A user can see guidelines(PDF)']);
        /** Permisos para el catalogo de criterios */
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['index']], ['slug' => 'Listar Actividades A', 'description' => 'A user can list activities A']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['create']], ['slug' => 'Crear Acividad A', 'description' => 'A user can create activity A']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['show']], ['slug' => 'Ver Acividad A', 'description' => 'A user can see activity A']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['edit']], ['slug' => 'Editar Acividad A', 'description' => 'A user can edit activity A']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['delete']], ['slug' => 'Eliminar Acividad A', 'description' => 'A user can delete activity A']);
    }
}

<?php

use App\Http\Controllers\Admin\PermissionsController;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;

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
    }
}

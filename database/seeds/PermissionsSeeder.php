<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Estimulos\ObjetivosController;
use App\Http\Controllers\Estimulos\LineamientosController;
use App\Http\Controllers\Estimulos\Factor2\MetasController;
use App\Http\Controllers\Estimulos\Factor2\ImpactosController;
use App\Http\Controllers\Estimulos\Factor3\DesempeñoController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesAController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesBController;
use App\Http\Controllers\Estimulos\Evaluaciones\DirectoresController;
use App\Http\Controllers\Estimulos\Factor1\ResponsabilidadesController;
use App\Http\Controllers\Estimulos\Evaluaciones\CoordinadoresController;
use App\Http\Controllers\Estimulos\Evaluaciones\PersonalApoyoController;
use App\Http\Controllers\Estimulos\Evaluaciones\SubdirectoresController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\DifusionDivulgacionController;

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
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['index']], ['slug' => 'Listar roles', 'description' => 'A user can list roles.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['create']], ['slug' => 'Crear rol', 'description' => 'A user can create rol.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['show']], ['slug' => 'Ver rol', 'description' => 'A user can see role.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['edit']], ['slug' => 'Editar rol', 'description' => 'A user can edit role.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['destroy']], ['slug' => 'Eliminar rol', 'description' => 'A user can delete role.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        /** Permisos para el catalogo de usuarios */
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['index']], ['slug' => 'Listar usuarios', 'description' => 'A user can list users.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']], ['slug' => 'Ver usuario', 'description' => 'A user can see user.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']], ['slug' => 'Editar usuario', 'description' => 'A user can edit user.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['destroy']], ['slug' => 'Eliminar usaurio', 'description' => 'A user can delete user.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        /** Permisos para el catalogo de permisos */
        Permission::updateOrCreate(['name' => PermissionsController::PERMISSIONS['index']], ['slug' => 'Listar permisos', 'description' => 'A user can list permissions.', 'id_categoria' => 1, 'categoria' => 'Panel de control']);
        /** Permisos para el catalogo de objetivos */
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['index']], ['slug' => 'Listar objetivos', 'description' => 'A user can list objectives', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['create']], ['slug' => 'Crear objetivo', 'description' => 'A user can create objective', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['show']], ['slug' => 'Ver objetivo', 'description' => 'A user can see objective', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['edit']], ['slug' => 'Editar objetivo', 'description' => 'A user can edit objective', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ObjetivosController::PERMISSIONS['delete']], ['slug' => 'Eliminar objetivo', 'description' => 'A user can delete objective', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permiso para ver los lineamientos de estimulos... */
        Permission::updateOrCreate(['name' => LineamientosController::PERMISSIONS['index']], ['slug' => 'Ver lineamientos(PDF)', 'description' => 'A user can see guidelines(PDF)', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de criterios */
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['index']], ['slug' => 'Listar Actividades A', 'description' => 'A user can list activities A', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['create']], ['slug' => 'Crear Acividad A', 'description' => 'A user can create activity A', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['show']], ['slug' => 'Ver Acividad A', 'description' => 'A user can see activity A', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['edit']], ['slug' => 'Editar Acividad A', 'description' => 'A user can edit activity A', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesAController::PERMISSIONS['delete']], ['slug' => 'Eliminar Acividad A', 'description' => 'A user can delete activity A', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesBController::PERMISSIONS['index']], ['slug' => 'Listar Actividades B', 'description' => 'A user can list activities B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesBController::PERMISSIONS['create']], ['slug' => 'Crear Acividad B', 'description' => 'A user can create activity B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesBController::PERMISSIONS['show']], ['slug' => 'Ver Acividad B', 'description' => 'A user can see activity B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesBController::PERMISSIONS['edit']], ['slug' => 'Editar Acividad B', 'description' => 'A user can edit activity B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ActividadesBController::PERMISSIONS['delete']], ['slug' => 'Eliminar Acividad B', 'description' => 'A user can delete activity B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de responsabildades */
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['index']], ['slug' => 'Listar responsabilidades', 'description' => 'A user can list responsibilities']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['create']], ['slug' => 'Crear responsabilidad', 'description' => 'A user can create responsibility']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['show']], ['slug' => 'Ver responsabilidad', 'description' => 'A user can see responsibility']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['edit']], ['slug' => 'Editar responsabilidad', 'description' => 'A user can edit responsibility']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['delete']], ['slug' => 'Eliminar responsabilidad', 'description' => 'A user can delete responsibility']);
        /** Permisos para el catalogo de metas */
        Permission::updateOrCreate(['name' => MetasController::PERMISSIONS['index']], ['slug' => 'Listar metas', 'description' => 'A user can list goals', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => MetasController::PERMISSIONS['create']], ['slug' => 'Crear meta', 'description' => 'A user can create goal', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => MetasController::PERMISSIONS['show']], ['slug' => 'Ver meta', 'description' => 'A user can see goal', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => MetasController::PERMISSIONS['edit']], ['slug' => 'Editar meta', 'description' => 'A user can edit goal', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => MetasController::PERMISSIONS['delete']], ['slug' => 'Eliminar meta', 'description' => 'A user can delete goal', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de nivel de impacto */
        Permission::updateOrCreate(['name' => ImpactosController::PERMISSIONS['index']], ['slug' => 'Listar nivel de impacto', 'description' => 'A user can list impact level', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ImpactosController::PERMISSIONS['create']], ['slug' => 'Crear nivel de impacto', 'description' => 'A user can create impact level', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ImpactosController::PERMISSIONS['show']], ['slug' => 'Ver nivel de impacto', 'description' => 'A user can see impact level', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ImpactosController::PERMISSIONS['edit']], ['slug' => 'Editar nivel de impacto', 'description' => 'A user can edit impact level', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ImpactosController::PERMISSIONS['delete']], ['slug' => 'Eliminar nivel de impacto', 'description' => 'A user can delete impact level', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de nivel de impacto */
        Permission::updateOrCreate(['name' => DesempeñoController::PERMISSIONS['index']], ['slug' => 'Listar desempeños', 'description' => 'A user can list performances', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => DesempeñoController::PERMISSIONS['create']], ['slug' => 'Crear desempeño', 'description' => 'A user can create performance', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => DesempeñoController::PERMISSIONS['show']], ['slug' => 'Ver desempeño', 'description' => 'A user can see performance', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => DesempeñoController::PERMISSIONS['edit']], ['slug' => 'Editar desempeño', 'description' => 'A user can edit performance', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => DesempeñoController::PERMISSIONS['delete']], ['slug' => 'Eliminar desempeño', 'description' => 'A user can delete performance', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el listado de directores */
        Permission::updateOrCreate(['name' => DirectoresController::PERMISSIONS['index']], ['slug' => 'Listar directores', 'description' => 'A user can list directors', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el listado de subdirectores */
        Permission::updateOrCreate(['name' => SubdirectoresController::PERMISSIONS['index']], ['slug' => 'Listar subdirectores', 'description' => 'A user can list deputy directors', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el listado de coordinadores */
        Permission::updateOrCreate(['name' => CoordinadoresController::PERMISSIONS['index']], ['slug' => 'Listar coordinadores', 'description' => 'A user can list coordinators', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el listado de personal de apoyo */
        Permission::updateOrCreate(['name' => PersonalApoyoController::PERMISSIONS['index']], ['slug' => 'Listar personal de apoyo', 'description' => 'A user can list support staff', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion General... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Difusion y Divulgacion', 'description' => 'A user can list general direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => DifusionDivulgacionController::PERMISSIONS['update']], ['slug' => 'Editar Eval. D. Gral->Difusion y Divulgacion', 'description' => 'A user can edit eval. general direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
    }
}
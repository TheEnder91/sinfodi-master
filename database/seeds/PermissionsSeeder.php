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
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\PosgradoDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\PosgradoDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\PosgradoDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\FormacionRHDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\FormacionRHDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\ColaboracionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\AcreditacionesController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\ColaboracionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\FormacionRHDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\InvestigacionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\TransferenciaDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\InvestigacionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\TransferenciaDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\ColaboracionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\AcreditacionesDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\SostenibilidadDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\InvestigacionBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\TransferenciaBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\InvestigacionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\TransferenciaDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\PosgradoDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\PosgradoDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\AcreditacionesDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\SostenibilidadDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\DifusionDivulgacionController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\FormacionRHDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\FormacionRHDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\ColaboracionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\ColaboracionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\DifusionDivulgacionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\InvestigacionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\TransferenciaDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\InvestigacionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\TransferenciaDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\DifusionDivulgacionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\AcreditacionesDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\SostenibilidadDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\AcreditacionesDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\SostenibilidadDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\DifusionDivulgacionDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\DifusionDivulgacionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\DifusionDivulgacionDAController;

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
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['index']], ['slug' => 'Listar responsabilidades', 'description' => 'A user can list responsibilities', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['create']], ['slug' => 'Crear responsabilidad', 'description' => 'A user can create responsibility', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['show']], ['slug' => 'Ver responsabilidad', 'description' => 'A user can see responsibility', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['edit']], ['slug' => 'Editar responsabilidad', 'description' => 'A user can edit responsibility', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ResponsabilidadesController::PERMISSIONS['delete']], ['slug' => 'Eliminar responsabilidad', 'description' => 'A user can delete responsibility', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
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
        Permission::updateOrCreate(['name' => PosgradoDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Posgrado', 'description' => 'A user can list general direction->Postgraduate', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Investigación cientifica', 'description' => 'A user can list general direction->Scientific investigation', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostentabilidadDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Sostentatibilidad economica', 'description' => 'A user can list general direction->economic sustainability', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Transferencia de conocimiento', 'description' => 'A user can list general direction->knowledge transfer', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => FormacionRHDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Formación recursos humanos', 'description' => 'A user can list general direction->Training of human resources', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ColaboracionDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Colaboración institucional', 'description' => 'A user can list general direction->Institutional collaboration', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => AcreditacionesController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Acreditaciones', 'description' => 'A user can list general direction->accreditations', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionBDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Investigación cientifica B', 'description' => 'A user can list general direction->Scientific investigation B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostentabilidadBDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Sostentatibilidad economica B', 'description' => 'A user can list general direction->economic sustainability B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaBDGController::PERMISSIONS['index']], ['slug' => 'Listar D. Gral->Transferencia de conocimiento B', 'description' => 'A user can list general direction->>knowledge transfer B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion de administracion... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Difusion y Divulgacion', 'description' => 'A user can list administration direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => PosgradoDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Posgrado', 'description' => 'A user can list administration direction->Postgraduate', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Investigación cientifica', 'description' => 'A user can list administration direction->Scientific investigation', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Sostentatibilidad economica', 'description' => 'A user can list administration direction->economic sustainability', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Transferencia de conocimiento', 'description' => 'A user can list administration direction->knowledge transfer', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => FormacionRHDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Formación recursos humanos', 'description' => 'A user can list administration direction->Training of human resources', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ColaboracionDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Colaboración institucional', 'description' => 'A user can list administration direction->Institutional collaboration', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => AcreditacionesDAController::PERMISSIONS['index']], ['slug' => 'Listar D. Admin->Acreditaciones', 'description' => 'A user can list administration direction->accreditations', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDAController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Admin->Investigación cientifica B', 'description' => 'A user can list administration direction->Scientific investigation B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDAController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Admin->Sostentatibilidad economica B', 'description' => 'A user can list administration direction->economic sustainability B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDAController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Admin->Transferencia de conocimiento B', 'description' => 'A user can list administration direction->>knowledge transfer B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion de posgrado... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Difusion y Divulgacion', 'description' => 'A user can list postgraduate direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => PosgradoDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Posgrado', 'description' => 'A user can list postgraduate direction->Postgraduate', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Investigación cientifica', 'description' => 'A user can list postgraduate direction->Scientific investigation', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Sostentatibilidad economica', 'description' => 'A user can list postgraduate direction->economic sustainability', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Transferencia de conocimiento', 'description' => 'A user can list postgraduate direction->knowledge transfer', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => FormacionRHDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Formación recursos humanos', 'description' => 'A user can list postgraduate direction->Training of human resources', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ColaboracionDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Colaboración institucional', 'description' => 'A user can list postgraduate direction->Institutional collaboration', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => AcreditacionesDPController::PERMISSIONS['index']], ['slug' => 'Listar D. Posgrado->Acreditaciones', 'description' => 'A user can list postgraduate direction->accreditations', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDPController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Posgrado->Investigación cientifica B', 'description' => 'A user can list postgraduate direction->Scientific investigation B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDPController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Posgrado->Sostentatibilidad economica B', 'description' => 'A user can list postgraduate direction->economic sustainability B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDPController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Posgrado->Transferencia de conocimiento B', 'description' => 'A user can list postgraduate direction->>knowledge transfer B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion de ciencia... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Difusion y Divulgacion', 'description' => 'A user can list science direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => PosgradoDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Posgrado', 'description' => 'A user can list science direction->Postgraduate', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Investigación cientifica', 'description' => 'A user can list science direction->Scientific investigation', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Sostentatibilidad economica', 'description' => 'A user can list science direction->economic sustainability', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Transferencia de conocimiento', 'description' => 'A user can list science direction->knowledge transfer', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => FormacionRHDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Formación recursos humanos', 'description' => 'A user can list science direction->Training of human resources', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ColaboracionDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Colaboración institucional', 'description' => 'A user can list science direction->Institutional collaboration', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => AcreditacionesDCController::PERMISSIONS['index']], ['slug' => 'Listar D. Ciencia->Acreditaciones', 'description' => 'A user can list science direction->accreditations', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDCController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Ciencia->Investigación cientifica B', 'description' => 'A user can list science direction->Scientific investigation B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDCController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Ciencia->Sostentatibilidad economica B', 'description' => 'A user can list science direction->economic sustainability B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDCController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Ciencia->Transferencia de conocimiento B', 'description' => 'A user can list science direction->>knowledge transfer B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion de servicios tecnologicos... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Difusion y Divulgacion', 'description' => 'A user can list technological services direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => PosgradoDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Posgrado', 'description' => 'A user can list technological services direction->Postgraduate', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Investigación cientifica', 'description' => 'A user can list technological services direction->Scientific investigation', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Sostentatibilidad economica', 'description' => 'A user can list technological services direction->economic sustainability', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Transferencia de conocimiento', 'description' => 'A user can list technological services direction->knowledge transfer', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => FormacionRHDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Formación recursos humanos', 'description' => 'A user can list technological services direction->Training of human resources', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => ColaboracionDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Colaboración institucional', 'description' => 'A user can list technological services direction->Institutional collaboration', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => AcreditacionesDSTController::PERMISSIONS['index']], ['slug' => 'Listar D. Serv. Tec.->Acreditaciones', 'description' => 'A user can list technological services direction->accreditations', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => InvestigacionDSTController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Serv. Tec.->Investigación cientifica B', 'description' => 'A user can list technological services direction->Scientific investigation B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => SostenibilidadDSTController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Serv. Tec.->Sostentatibilidad economica B', 'description' => 'A user can list technological services direction->economic sustainability B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        Permission::updateOrCreate(['name' => TransferenciaDSTController::PERMISSIONS['indexB']], ['slug' => 'Listar D. Serv. Tec.->Transferencia de conocimiento B', 'description' => 'A user can list technological services direction->>knowledge transfer B', 'id_categoria' => 2, 'categoria' => 'Estimulos']);
        /** Permisos para el catalogo de evaluaciones de la Direccion de proyectos tecnologicos... */
        Permission::updateOrCreate(['name' => DifusionDivulgacionDPTController::PERMISSIONS['index']], ['slug' => 'Listar D. Proy. Tec.->Difusion y Divulgacion', 'description' => 'A user can list technological projects direction->diffusion and dissemination', 'id_categoria' => 2, 'categoria' => 'Estimulos']);

    }
}

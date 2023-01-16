<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'admin-role-index',
        'create' => 'admin-role-create',
        'show' => 'admin-role-show',
        'edit' => 'admin-role-edit',
        'destroy' => 'admin-role-destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('panelControl.roles.index', [
            'rows' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $permissions = Permission::get();
        $permissionsCat = Permission::select('id_categoria', 'categoria')->distinct()->get();
        $permissionsPanelControl = Permission::where('id_categoria', 1)->get();
        $permissionsEstimulos = Permission::where('id_categoria', 2)->get();
        return view('panelControl.roles.create', compact(['permissionsCat', 'permissionsPanelControl', 'permissionsEstimulos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->get('permission'));
        $data['response'] = true;
        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissionsCat = Permission::select('id_categoria', 'categoria')->distinct()->get();
        $permissions = Permission::get();

        $permission_role = [];
        foreach($role->permissions as $permission){
            $permission_role[] = $permission->id;
        }

        return view('panelControl.roles.show', compact('permissions', 'role', 'permission_role', 'permissionsCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();
        $role->permissions()->sync($request->permission);
        $data['response'] = true;
        return $this->response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        $data['response'] = true;
        return $this->response($data);
    }
}

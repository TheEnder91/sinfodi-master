<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'admin-user-index',
        'show' => 'admin-user-show',
        'edit' => 'admin-user-edit',
        'destroy' => 'admin-user-destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('panelControl/users/index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        $role_user = [];
        foreach($user->roles as $role){
            $role_user[] = $role->id;
        }

        return view('panelControl/users/show', [
            'row' => $user,
            'roles' => $roles,
            'role_user' => $role_user,
        ]);
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
        $user = User::findOrFail($id);
        $user->fill($request->all())->save();
        $user->syncPermissions($id);
        $user->syncRoles($request->role);

        $data['response'] = true;
        return $this->response($data);
    }
}

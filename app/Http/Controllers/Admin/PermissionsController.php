<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    const PERMISSIONS = [
        'index' => 'admin-permission-index',
    ];

    public function index(){
        $permissions = Permission::all();
        return view('panelControl.permission.index', [
            'rows' => $permissions,
        ]);
    }
}

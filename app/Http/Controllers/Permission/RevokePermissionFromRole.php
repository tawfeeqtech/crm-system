<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RevokePermissionFromRole extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);
        return back();
    }
}

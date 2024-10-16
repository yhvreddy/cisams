<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Enums\AccountStatus;
use App\Enums\Roles;
use App\Enums\Permissions;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Traits\HandlesCustomExceptions;

class RolesPermissionsController extends Controller
{
    use HandlesCustomExceptions;

    protected Role $role;
    protected Permission $permission;

    public function __construct(
        Role $_role,
        Permission $_permission
    ){
        $this->role = $_role;
        $this->permission = $_permission;
    }

    //Roles
    public function indexRoles() {}

    public function createRoles() {}

    public function storeRoles() {}

    public function editRoles() {}

    public function updateRoles() {}

    public function deleteRoles() {}

    //Permissions
    public function indexPermissions() {}

    public function createPermissions() {}

    public function storePermissions() {}

    public function editPermissions() {}

    public function updatePermissions() {}

    public function deletePermissions() {}
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\AccountStatus;
use App\Enums\Roles as RolesEnum;
use App\Enums\Permissions;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $create = Permission::create(['name' => Permissions::CREATE->value]);
        $read = Permission::create(['name' => Permissions::READ->value]);
        $edit = Permission::create(['name' => Permissions::EDIT->value]);
        $delete = Permission::create(['name' => Permissions::DELETE->value]);

        $superAdminRole = app(Role::class)->findOrCreate(RolesEnum::SUPERADMIN->value, 'web');
        $superAdminRole->givePermissionTo(Permission::all());

        $create->assignRole($superAdminRole);
        $read->assignRole($superAdminRole);
        $edit->assignRole($superAdminRole);
        $delete->assignRole($superAdminRole);

        // Create manager role and give all permissions
        $managerRole = app(Role::class)->findOrCreate(RolesEnum::MANAGER->value, 'web');
        $managerRole->givePermissionTo(Permission::all());

        $create->assignRole($managerRole);
        $read->assignRole($managerRole);
        $edit->assignRole($managerRole);
        $delete->assignRole($managerRole);

        // Create Special Branch role and give specific permissions
        $specialBranchRole = app(Role::class)->findOrCreate(RolesEnum::SPECIALBRANCH->value, 'web');
        $specialBranchRole->givePermissionTo(Permission::all());

        $create->assignRole($specialBranchRole);
        $read->assignRole($specialBranchRole);
        $edit->assignRole($specialBranchRole);
        $delete->assignRole($specialBranchRole);


        //User create
        $superAdmin = User::where('email', 'superadmin@cisams.dev')->first();
        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'SuperAdmin',
                'email' => 'superadmin@cisams.dev',
                'username' => 'superadmin',
                'mobile' => 9876543210,
                'password' => Hash::make('admin@123!'),
                'status' => AccountStatus::ACTIVATE,
                'role_id'=> $superAdminRole->id
            ]);

            $superAdmin->assignRole($superAdminRole);
        }

        $manager = User::where('email', 'manager@cisams.dev')->first();
        if (!$manager) {
            $manager = User::create([
                'name' => 'Manager',
                'email' => 'manager@cisams.dev',
                'username' => 'manager',
                'mobile' => 9876543211,
                'password' => Hash::make('admin@123!'),
                'status' => AccountStatus::ACTIVATE,
                'role_id'=> $managerRole->id
            ]);

            $manager->assignRole($managerRole);
        }

        $specialBranch = User::where('email', 'sb@cisams.dev')->first();
        if (!$specialBranch) {
            $specialBranch = User::create([
                'name' => 'Special Branch',
                'email' => 'sb@cisams.dev',
                'username' => 'specialbranch',
                'mobile' => 9876543211,
                'password' => Hash::make('admin@123!'),
                'status' => AccountStatus::ACTIVATE,
                'role_id'=> $specialBranchRole->id
            ]);

            $specialBranch->assignRole($specialBranchRole);
        }
    }
}

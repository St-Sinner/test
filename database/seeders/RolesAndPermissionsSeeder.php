<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = User::where('email', 'admin@example.com')->firstOrFail();
        $manager = User::where('email', 'manager@example.com')->firstOrFail();
        $user = User::where('email', 'user@example.com')->firstOrFail();

        $permissionsUser = [];
        $permissionsManager = array_merge($permissionsUser, [
            'use-admin-panel',
        ]);
        $permissionsAdmin = array_merge($permissionsManager, [
            'use-crud',
        ]);

        $permissionsByRole = [
            'admin' => $permissionsAdmin,
            'manager' => $permissionsManager,
            'user' => $permissionsUser
        ];
        /* Admin */
        foreach ($permissionsAdmin as $permission) {
            Permission::create(['name' => $permission]);
            $admin->givePermissionTo($permission);
        }
        /* Manager */
        foreach ($permissionsManager as $permission) {
            $manager->givePermissionTo($permission);
        }
        /* User */
        foreach ($permissionsUser as $permission) {
            $user->givePermissionTo($permission);
        }

        foreach ($permissionsByRole as $role => $permissions) {
            $model = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                $model->givePermissionTo($permission);
            }
        }

        $admin->assignRole('admin');
    }
}

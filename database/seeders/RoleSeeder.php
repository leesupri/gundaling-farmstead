<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // "Admin" is Shield's super_admin role (config/filament-shield.php) — bypasses all
        // permission checks via a Gate::before hook, so it needs no permissions assigned.
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        $managerActions = ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'DeleteAny', 'Reorder', 'Replicate'];

        $manager = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $manager->syncPermissions($this->permissionsFor([
            'MenuCategory' => $managerActions,
            'MenuItem' => $managerActions,
            'Page' => $managerActions,
            'Promo' => $managerActions,
            'Reservation' => $managerActions,
        ]));

        $staff = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'web']);
        $staff->syncPermissions($this->permissionsFor([
            'Reservation' => ['ViewAny', 'View', 'Create', 'Update'],
            'MenuItem' => ['ViewAny', 'View', 'Update'],
            'MenuCategory' => ['ViewAny', 'View'],
            'Promo' => ['ViewAny', 'View'],
        ]));
    }

    /**
     * @param  array<string, array<int, string>>  $entityActions
     * @return array<int, Permission>
     */
    private function permissionsFor(array $entityActions): array
    {
        $names = [];

        foreach ($entityActions as $entity => $actions) {
            foreach ($actions as $action) {
                $names[] = "{$action}:{$entity}";
            }
        }

        return Permission::whereIn('name', $names)->get()->all();
    }
}

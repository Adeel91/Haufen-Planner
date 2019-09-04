<?php

use App\User;
use App\Status;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);
        $employeeRole = Role::create(['name' => 'employee']);

        $clientDefaultPermissions = config('pms.default.rolepermissions.client');
        $employeeDefaultPermissions = config('pms.default.rolepermissions.employee');

        foreach (config('pms.default.permissions') as $permission) {
            $p = Permission::create(['name' => $permission]);

            if (in_array($p->name, $clientDefaultPermissions)) {
                $clientRole->givePermissionTo($p->name);
            }

            if (in_array($p->name, $employeeDefaultPermissions)) {
                $employeeRole->givePermissionTo($p->name);
            }
        }

        $admin = User::create([
                                'name'  => 'Admin',
                                'email' => 'admin@pms.com',
                                'password' => 'admin'
                            ]);
        
        $admin->assignRole('admin');

        Auth::login($admin);

        foreach (config('pms.default.statuses')  as $status) {
            Status::create([
                'title' => $status,
                'slug' => str_slug($status)
            ]);
        }
    }
}

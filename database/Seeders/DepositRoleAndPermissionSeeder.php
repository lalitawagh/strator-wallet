<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kanexy\Cms\Enums\Role as EnumsRole;
use Kanexy\LedgerFoundation\Http\Enums\Permission as EnumsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DepositRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $EXCHANGE_RATE_VIEW = Permission::create(['name' => EnumsPermission::EXCHANGE_RATE_VIEW]);
        $EXCHANGE_RATE_CREATE = Permission::create(['name' => EnumsPermission::EXCHANGE_RATE_CREATE]);
        $EXCHANGE_RATE_EDIT = Permission::create(['name' => EnumsPermission::EXCHANGE_RATE_EDIT]);
        $EXCHANGE_RATE_DELETE = Permission::create(['name' => EnumsPermission::EXCHANGE_RATE_DELETE]);

        $SUPER_ADMIN = Role::where(['name' => EnumsRole::SUPER_ADMIN])->first();
        $SUPER_ADMIN->givePermissionTo(Permission::all());
    }
}

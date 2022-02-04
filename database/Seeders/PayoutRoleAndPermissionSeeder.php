<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kanexy\LedgerFoundation\Http\Enums\Permission as EnumsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PayoutRoleAndPermissionSeeder extends Seeder
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

        $PAYOUT_VIEW = Permission::create(['name' => EnumsPermission::PAYOUT_VIEW]);
        $PAYOUT_CREATE = Permission::create(['name' => EnumsPermission::PAYOUT_CREATE]);
        $PAYOUT_SHOW = Permission::create(['name' => EnumsPermission::PAYOUT_SHOW]);

        $SUPER_ADMIN = Role::where(['name' => \Kanexy\Cms\Enums\Role::SUPER_ADMIN])->first();
        $SUPER_ADMIN->givePermissionTo(Permission::all());
    }
}

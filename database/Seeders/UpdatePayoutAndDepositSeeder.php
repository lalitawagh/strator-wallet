<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kanexy\Cms\Enums\Role as EnumsRole;
use Kanexy\LedgerFoundation\Enums\Permission as EnumsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdatePayoutAndDepositSeeder extends Seeder
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

        $DEPOSIT_VIEW = Permission::create(['name' => EnumsPermission::DEPOSIT_VIEW]);
        $DEPOSIT_CREATE = Permission::create(['name' => EnumsPermission::DEPOSIT_CREATE]);
        $DEPOSIT_SHOW = Permission::create(['name' => EnumsPermission::DEPOSIT_SHOW]);

        $PAYOUT_VIEW = Permission::create(['name' => EnumsPermission::PAYOUT_VIEW]);
        $PAYOUT_CREATE = Permission::create(['name' => EnumsPermission::PAYOUT_CREATE]);
        $PAYOUT_SHOW = Permission::create(['name' => EnumsPermission::PAYOUT_SHOW]);

        $SUPER_ADMIN = Role::where(['name' => EnumsRole::SUPER_ADMIN])->first();
        $SUPER_ADMIN->givePermissionTo(Permission::all());
    }
}
